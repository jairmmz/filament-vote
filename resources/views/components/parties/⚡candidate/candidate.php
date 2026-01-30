<?php

use App\Models\Candidate;
use Illuminate\View\View;
use Livewire\Component;

new class extends Component
{
    public Candidate $candidate;

    public function mount(Candidate $candidate): void
    {
        $this->candidate = $candidate->load(['politicalParty', 'poll']);
    }

    public function render(): View
    {
        return $this->view()
            ->title($this->candidate->name . ' - ' . config('app.name'));
    }
};
