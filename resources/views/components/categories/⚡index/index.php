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

    public function render(): View
    {
        return $this->view()
            ->title('Categorías' . ' - ' . config('app.name'));
    }
};
