<?php

use App\Models\Poll;
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

    public function render(): View
    {
        return $this->view()
            ->title('Encuestas' . ' - ' . config('app.name'));
    }
};
