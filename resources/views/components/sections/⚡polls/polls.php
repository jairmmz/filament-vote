<?php

use App\Models\Poll;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

new class extends Component
{
    public Collection $polls;

    public function mount(): void
    {
        $this->polls = Poll::where('status', 'activo')
            ->where('starts_at', '<=', now())
            ->where('ends_at', '>', now())
            ->whereHas('candidates')
            ->withCount('votes')
            ->with(['category'])
            ->orderBy('votes_count', 'desc')
            ->latest()
            ->take(4)
            ->get();
        }
};
