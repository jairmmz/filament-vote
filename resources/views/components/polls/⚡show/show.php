<?php

use App\Models\Poll;
use App\Models\Vote;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;

new class extends Component
{
    public ?Poll $poll;
    public ?int $selectedCandidate = null;
    public ?string $vote_type = null;
    public bool $hasVoted = false;
    public bool $isUserNotAuth = false;

    public function mount(Poll $poll): void
    {
        $this->poll = $poll->load([
            'category',
            'candidates.politicalParty',
            'candidates.votes',
            'votes'
        ]);

        if (Auth::check()) {
            $this->hasVoted = Vote::where('poll_id', $poll->id)
                ->where('user_id', Auth::id())
                ->exists();
        }
    }

    public function selectedVote(string|int $candidate): void
    {
        if ($candidate === 'blanco' || $candidate === 'nulo') {
            $this->selectedCandidate = null;
            $this->vote_type = $candidate;
        } else {
            $this->selectedCandidate = $candidate;
            $this->vote_type = 'válido';
        }

        if (!Auth::check()) {
            $this->isUserNotAuth = true;
        }

        Flux::modal('modal-vote')->show();
    }

    public function vote()
    {
        if ($this->hasVoted) {
            $this->addError('vote', 'Ya has votado en esta encuesta.');
            return;
        }

        $this->validate([
            'selectedCandidate' => 'nullable|exists:candidates,id',
            'vote_type' => 'nullable|in:blanco,nulo',
        ]);

        if (!$this->selectedCandidate && !$this->vote_type) {
            $this->addError('vote', 'Debes seleccionar una opción para votar.');
            return;
        }

        Vote::create([
            'poll_id' => $this->poll->id,
            'user_id' => Auth::id(),
            'candidate_id' => $this->selectedCandidate,
            'vote_type' => $this->vote_type,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        $this->hasVoted = true;
        $this->selectedCandidate = null;
        $this->vote_type = null;
        $this->isUserNotAuth = false;

        Flux::modal('modal-vote')->close();
        $this->reset(['selectedCandidate', 'vote_type']);

        $this->poll->refresh();

        session()->flash('vote_success', '¡Tu voto ha sido registrado exitosamente!');
    }

    public function getTotalVotesProperty(): int
    {
        return $this->poll->votes()->count();
    }

    public function getBlankVotesProperty(): int
    {
        return $this->poll->votes()->where('vote_type', 'blanco')->count();
    }

    public function getNullVotesProperty(): int
    {
        return $this->poll->votes()->where('vote_type', 'nulo')->count();
    }

    public function getValidVotesProperty(): int
    {
        return $this->poll->votes()->where('vote_type', 'válido')->count();
    }

    public function render(): View
    {
        return $this->view()
            ->title($this->poll->title . ' - ' . config('app.name'));
    }
};
