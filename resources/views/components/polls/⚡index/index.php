<?php

use App\Models\Poll;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

new #[Title('Encuestas - Sistema Encuestas Electorales 2026')] class extends Component
{
    use WithPagination, WithoutUrlPagination;

    public string $search = '';

    #[Computed]
    public function polls()
    {
        return Poll::actives()
            ->when($this->search, function ($query) {
                $query->where('title', 'like', "%{$this->search}%");
            })
            ->whereHas('candidates')
            ->withCount('votes')
            ->with(['category'])
            ->orderBy('votes_count', 'desc')
            ->latest()
            ->paginate(6);
    }
};
