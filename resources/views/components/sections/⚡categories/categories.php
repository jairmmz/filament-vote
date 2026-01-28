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
            ->get();

        $this->stats = [
            'total_polls' => $this->categories->sum('active_polls_count'),
            'total_votes' => Vote::count(),
            'total_candidates' => Candidate::where('is_active', true)->count(),
            'active_users' => User::where('status', true)->count(),
        ];
    }

    public function selectedCategory(int $category_id)
    {
        dd($category_id);
    }
};
