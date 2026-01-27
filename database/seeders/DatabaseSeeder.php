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

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789'),
            'remember_token' => Str::random(10),
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'two_factor_confirmed_at' => null,
        ]);

        Category::factory(30)->create();
        PoliticalParty::factory(30)->create();
        Poll::factory(30)->create();
        Candidate::factory(15)->create();
        Vote::factory(3)->create();
    }
}
