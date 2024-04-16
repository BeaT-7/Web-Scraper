<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'link' => fake()->url(),
            'points' => fake() -> numberBetween(1-1000),
            'posted_at' => fake() -> name(),
            'score_id' => fake() -> name(),
            'is_deleted' => false
        ];
    }
}
