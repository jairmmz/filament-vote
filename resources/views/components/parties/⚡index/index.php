<?php

use App\Models\PoliticalParty;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

new #[Title('Partidos Políticos - Sistema Encuestas Electorales 2026')] class extends Component
{
    use WithPagination, WithoutUrlPagination;

    #[Computed]
    public function politicalParties()
    {
        return PoliticalParty::active()
            ->orderBy('name')
            ->paginate(6);
    }
};
