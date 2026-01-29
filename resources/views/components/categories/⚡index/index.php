<?php

use App\Models\Category;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

new #[Title('Categorías - Sistema Encuestas Electorales 2026')] class extends Component
{
    use WithPagination, WithoutUrlPagination;

    public string $search = '';

    #[Computed]
    public function categories()
    {
        return Category::active()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', "%{$this->search}%");
            })
            ->whereHas('activePolls')
            ->withCount('activePolls')
            ->orderBy('id', 'asc')
            ->paginate(10);
    }
};
