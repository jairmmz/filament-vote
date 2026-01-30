<?php

use App\Models\PoliticalParty;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

new class extends Component
{
    use WithPagination, WithoutUrlPagination;

    public string $search = '';

    #[Computed]
    public function politicalParties()
    {
        return PoliticalParty::active()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', "%{$this->search}%");
            })
            ->orderBy('name')
            ->paginate(6);
    }

    public function render(): View
    {
        return $this->view()
            ->title('Partidos Políticos' . ' - ' . config('app.name'));
    }
};
