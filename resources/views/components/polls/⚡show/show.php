<?php

use App\Models\Candidate;
use App\Models\Poll;
use App\Models\Vote;
use App\Support\SiteSettings;
use Flux\Flux;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Livewire\Component;

new class extends Component
{
    public ?Poll $poll;
    public int|string|null $selectedCandidate = null;
    public ?string $selectedCandidateName = null;
    public ?string $vote_type = null;
    public ?Vote $userVote = null;
    public ?string $clientFingerprint = null;

    public function mount(Poll $poll): void
    {
        abort_if(
            in_array($poll->status, ['borrador', 'archivado'], true),
            404
        );

        $this->poll = $poll->load([
            'category',
            'candidates.politicalParty',
            'candidates.votes',
            'votes'
        ]);

        $this->checkExistingVote();
    }

    protected function checkExistingVote(): void
    {
        $sessionId = session()->getId();
        $ipAddress = request()->ip();
        $userAgent = request()->userAgent();

        $this->userVote = Vote::where('poll_id', $this->poll->id)
            ->where(function ($query) use ($sessionId, $ipAddress, $userAgent) {
                $query->where('session_id', $sessionId)
                    ->orWhere('ip_address', $ipAddress)
                    ->orWhere(function ($q) use ($ipAddress, $userAgent) {
                        $q->where('ip_address', $ipAddress)
                            ->where('user_agent', $userAgent);
                    });
            })
            ->first();
    }

    public function selectedVote(int|string $candidate): void
    {
        if ($candidate === 'no sabe' || $candidate === 'ninguno') {
            $this->selectedCandidate = null;
            $this->vote_type = $candidate;
            $this->selectedCandidateName = ucfirst($candidate);
        } else {
            $candidateModel = Candidate::findOrFail($candidate);
            $this->selectedCandidate = $candidate;
            $this->vote_type = 'válido';
            $this->selectedCandidateName = $candidateModel->name;
        }

        Flux::modal('modal-vote')->show();
    }

    public function vote()
    {
        $key = 'vote:' . request()->ip() . ':poll:' . $this->poll->id;

        if (RateLimiter::tooManyAttempts($key, 10)) {
            $seconds = RateLimiter::availableIn($key);
            Flux::toast(
                "Demasiados intentos en esta encuesta. Espera {$seconds} segundos.",
                variant: 'danger'
            );
            return;
        }

        RateLimiter::hit($key, 60);

        if ($this->userVote) {
            Flux::toast('Ya has votado en esta encuesta.', variant: 'warning');
            return;
        }

        $this->validate([
            'selectedCandidate' => 'nullable|exists:candidates,id',
            'vote_type' => 'required|in:no sabe,ninguno,válido',
            'clientFingerprint' => 'required|string|min:32',
        ]);

        if ($this->vote_type === 'válido' && !$this->selectedCandidate) {
            Flux::toast('Debes seleccionar una opción para votar.', variant: 'warning');
            return;
        }

        $ipAddress = request()->ip();
        $userAgent = request()->userAgent();
        $sessionId = session()->getId();
        $fingerprint = $this->clientFingerprint;

        $compositeHash = hash(
            'sha256',
            $this->poll->id .
                $fingerprint .
                $ipAddress .
                $userAgent
        );

        $existingVote = Vote::where('poll_id', $this->poll->id)
            ->where(function ($query) use ($fingerprint, $compositeHash, $sessionId, $ipAddress, $userAgent) {
                $query->where('fingerprint', $fingerprint)
                    ->orWhere('composite_hash', $compositeHash)
                    ->orWhere('session_id', $sessionId)
                    ->orWhere('ip_address', $ipAddress)
                    ->orWhere(function ($q) use ($ipAddress, $userAgent) {
                        $q->where('ip_address', $ipAddress)
                            ->where('user_agent', $userAgent);
                    });
            })
            ->first();

        if ($existingVote) {
            $this->userVote = $existingVote;
            Flux::toast('Ya has votado en esta encuesta.', variant: 'warning');
            Flux::modal('modal-vote')->close();
            return;
        }

        try {
            $vote = Vote::create([
                'poll_id' => $this->poll->id,
                'candidate_id' => $this->selectedCandidate,
                'vote_type' => $this->vote_type,
                'ip_address' => $ipAddress,
                'user_agent' => $userAgent,
                'fingerprint' => $fingerprint,
                'session_id' => $sessionId,
            ]);

            $this->userVote = $vote;

            $this->poll = $this->poll->fresh([
                'category',
                'candidates.politicalParty',
                'candidates.votes',
                'votes'
            ]);

            $this->reset(['selectedCandidate', 'vote_type', 'clientFingerprint']);
            Flux::modal('modal-vote')->close();

            Flux::toast('¡Tu voto ha sido registrado exitosamente!', variant: 'success');
        } catch (\Exception $e) {
            Flux::toast('Error al registrar el voto. Por favor intenta nuevamente.', variant: 'danger');
        }
    }

    public function getTotalVotesProperty(): int
    {
        return $this->poll->votes()->count();
    }

    public function getKnowVotesProperty(): int
    {
        return $this->poll->votes()->where('vote_type', 'no sabe')->count();
    }

    public function getNoneVotesProperty(): int
    {
        return $this->poll->votes()->where('vote_type', 'ninguno')->count();
    }

    public function getValidVotesProperty(): int
    {
        return $this->poll->votes()->where('vote_type', 'válido')->count();
    }

    public function isVotedCandidate(int $candidateId): bool
    {
        return $this->userVote?->candidate_id === $candidateId;
    }

    public function isSpecialVote(string $type): bool
    {
        return $this->userVote?->vote_type === $type;
    }

    public function getIsPollClosedProperty(): bool
    {
        return $this->poll->ends_at && $this->poll->ends_at->isPast();
    }

    public function render(): View
    {
        return $this->view()
            ->layout('layouts::app', [
                'title' => $this->poll->title . ' - ' . SiteSettings::get('site_name', config('app.name')),
                'description' => $this->poll->description,
                'image' => $this->poll->image ? Storage::disk('polls')->url($this->poll->image) : null,
            ]);
    }
};
