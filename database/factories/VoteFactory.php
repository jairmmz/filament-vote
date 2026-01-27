<?php

namespace Database\Factories;

use App\Models\Candidate;
use App\Models\Poll;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vote>
 */
class VoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = fake()->randomElement(['válido', 'blanco', 'nulo']);

        return [
            'code' => strtoupper(fake()->unique()->bothify('????-#####')),
            'poll_id' => Poll::inRandomOrder()->value('id'),
            'user_id' => User::inRandomOrder()->value('id'),
            'candidate_id' => $type === 'válido'
                ? Candidate::inRandomOrder()->first()->id
                : null,
            'vote_type' => $type,
            'ip_address' => fake()->ipv4(),
            'user_agent' => fake()->userAgent(),
        ];
    }

    public function blank()
    {
        return $this->state(fn(array $attributes) => [
            'candidate_id' => null,
            'vote_type' => 'blanco',
        ]);
    }

    public function null()
    {
        return $this->state(fn(array $attributes) => [
            'candidate_id' => null,
            'vote_type' => 'nulo',
        ]);
    }
}
