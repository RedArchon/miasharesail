<?php

namespace Database\Factories;

use App\Models\TodoItem;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TodoList>
 */
class TodoListFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape(['title' => "string", 'description' => "string"])] public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->sentence($this->faker->numberBetween(1, 4))
        ];
    }

    public function withUser(?User $user = null): TodoListFactory
    {
        return $this->state(['user_id' => $user ?: User::factory()->create()]);
    }
}
