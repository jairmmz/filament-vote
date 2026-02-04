<?php

use App\Models\Candidate;
use App\Models\Poll;
use App\Models\SiteSetting;
use App\Models\Vote;
use App\Support\SiteSettings;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;
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
    public bool $isUserNotAuth = false;
    public bool $isUserNotEmailVerification = false;

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

        if (Auth::check()) {
            $this->userVote = Vote::where('poll_id', $poll->id)
                ->where('user_id', Auth::id())
                ->first();
        }
    }

    public function selectedVote(int|string $candidate): void
    {
        if ($candidate === 'no sabe' || $candidate === 'ninguno') {
            $this->selectedCandidate = null;
            $this->vote_type = $candidate;
            $this->selectedCandidateName = ucfirst($candidate);
        } else {
            $candidateModel = Candidate::findOr($candidate);
            $this->selectedCandidate = $candidate;
            $this->vote_type = 'válido';
            $this->selectedCandidateName = $candidateModel->name;
        }

        if (!Auth::check()) {
            $this->isUserNotAuth = true;
            $this->isUserNotEmailVerification = false;
        } elseif (!Auth::user()->hasVerifiedEmail()) {
            $this->isUserNotAuth = false;
            $this->isUserNotEmailVerification = true;
        } else {
            $this->isUserNotAuth = false;
            $this->isUserNotEmailVerification = false;
        }

        Flux::modal('modal-vote')->show();
    }

    public function vote()
    {
        abort_unless(Auth::check(), 403);
        abort_unless(Auth::user()->hasVerifiedEmail(), 403);

        if ($this->userVote) {
            Flux::toast('Ya has votado en esta encuesta.', variant: 'warning');
            return;
        }

        $this->validate([
            'selectedCandidate' => 'nullable|exists:candidates,id',
            'vote_type' => 'nullable|in:no sabe,ninguno,válido',
        ]);

        if (!$this->selectedCandidate && !$this->vote_type) {
            Flux::toast('Debes seleccionar una opción para votar.', variant: 'warning');
            return;
        }

        $vote = Vote::create([
            'poll_id' => $this->poll->id,
            'user_id' => Auth::id(),
            'candidate_id' => $this->selectedCandidate,
            'vote_type' => $this->vote_type,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        $this->userVote = $vote;

        $this->poll = $this->poll->fresh([
            'category',
            'candidates.politicalParty',
            'candidates.votes',
            'votes'
        ]);

        $this->reset(['selectedCandidate', 'vote_type']);
        Flux::modal('modal-vote')->close();

        Flux::toast('¡Tu voto ha sido registrado exitosamente!', variant: 'success');
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

    public function resendVerification(): void
    {
        if (Auth::check() && !Auth::user()->hasVerifiedEmail()) {
            Auth::user()->sendEmailVerificationNotification();
            Flux::modal('modal-vote')->close();
            Flux::toast('Te enviamos un correo de verificación a tu correo electrónico', variant: 'success');
        }
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
