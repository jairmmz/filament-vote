<?php

use App\Models\Candidate;
use Livewire\Component;

new class extends Component
{
    public Candidate $candidate;

    public function mount(Candidate $candidate): void
    {
        $this->candidate = $candidate->load(['politicalParty', 'poll']);
    }
};
