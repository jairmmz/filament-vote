<?php

use App\Models\Poll;
use App\Models\Vote;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

new class extends Component
{
    public ?Poll $poll;
    public ?int $selectedCandidate = null;
    public ?string $specialVote = null;
    public bool $hasVoted = false;

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

    public function updatedSelectedCandidate($value)
    {
        if ($value) {
            $this->specialVote = null;
        }
    }

    public function updatedSpecialVote($value)
    {
        if ($value) {
            $this->selectedCandidate = null;
        }
    }

    public function vote()
    {
        if (!Auth::check()) {
            $this->addError('auth', 'Debes iniciar sesión para votar.');
            return;
        }

        if ($this->hasVoted) {
            $this->addError('vote', 'Ya has votado en esta encuesta.');
            return;
        }

        $this->validate([
            'selectedCandidate' => 'nullable|exists:candidates,id',
            'specialVote' => 'nullable|in:blanco,nulo',
        ]);

        if (!$this->selectedCandidate && !$this->specialVote) {
            $this->addError('vote', 'Debes seleccionar una opción para votar.');
            return;
        }

        $voteType = 'válido';
        $candidateId = $this->selectedCandidate;

        if ($this->specialVote) {
            $voteType = $this->specialVote;
            $candidateId = null;
        }

        Vote::create([
            'poll_id' => $this->poll->id,
            'user_id' => Auth::id(),
            'candidate_id' => $candidateId,
            'vote_type' => $voteType,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        $this->hasVoted = true;
        $this->selectedCandidate = null;
        $this->specialVote = null;

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
};
