<?php

use App\Models\Candidate;
use App\Models\Category;
use App\Models\Poll;
use App\Models\User;
use App\Models\Vote;
use Livewire\Component;

new class extends Component
{
    public array $stats = [];

    public $categories;

    public function mount(): void
    {
        $this->categories = Category::where('is_active', true)
            ->whereHas('activePolls')
            ->withCount('activePolls')
            ->orderBy('id', 'asc')
            ->take(12)
            ->get();
    }
};
