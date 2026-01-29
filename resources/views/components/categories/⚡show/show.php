<?php

use App\Models\Category;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

new class extends Component
{
    use WithPagination, WithoutUrlPagination;

    public ?Category $category;

    public function mount(Category $category)
    {
        $this->category = $category;
    }

    #[Computed]
    public function polls()
    {
        return $this->category->activePolls()
            ->withCount(['votes', 'candidates'])
            ->orderBy('votes_count', 'desc')
            ->latest()
            ->paginate(5);
    }
};
