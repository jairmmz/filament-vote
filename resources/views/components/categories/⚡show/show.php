<?php

use App\Models\Category;
use Illuminate\View\View;
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

    public function render(): View
    {
        return $this->view()
            ->title($this->category->name . ' - ' . config('app.name'));
    }
};
