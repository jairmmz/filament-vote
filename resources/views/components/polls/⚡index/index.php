<?php

use App\Models\Poll;
use App\Support\SiteSettings;
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
            ->withCount('votes')
            ->with(['category', 'candidates'])
            ->orderBy('votes_count', 'desc')
            ->latest()
            ->paginate(6);
    }

    public function render(): View
    {
        return $this->view()
            ->layout('layouts::app', [
                'title' => 'Encuestas' . ' - ' . SiteSettings::get('site_name', config('app.name')),
                'description' => 'Lista de encuestas disponibles donde podrás participar y conocer los resultados.',
            ]);
    }
};
