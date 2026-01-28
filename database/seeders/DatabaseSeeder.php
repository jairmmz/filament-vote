<?php

namespace Database\Seeders;

use App\Models\Candidate;
use App\Models\Category;
use App\Models\PoliticalParty;
use App\Models\Poll;
use App\Models\User;
use App\Models\Vote;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            RolesPermissionSeeder::class,
        ]);

        Category::factory(30)->create();
        PoliticalParty::factory(30)->create();
        Poll::factory(30)->create();
        Candidate::factory(15)->create();
        Vote::factory(3)->create();
    }
}
