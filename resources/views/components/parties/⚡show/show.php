<?php

use App\Models\PoliticalParty;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

new class extends Component
{
    use WithPagination, WithoutUrlPagination;

    public ?PoliticalParty $politicalParty;

    public function mount(PoliticalParty $politicalParty): void
    {
        $this->politicalParty = $politicalParty;
    }

    #[Computed]
    public function candidates()
    {
        return $this->politicalParty?->candidates()->paginate(6);
    }
};
