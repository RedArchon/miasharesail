<?php

namespace Database\Factories;

use App\Models\TodoList;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TodoItem>
 */
class TodoItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'is_done' => $this->faker->boolean([25])
        ];
    }

//    public function withTodoList(?TodoList $todoList = null)
//    {
//        return $this->state(['list_id' => $todoList ?: TodoList::factory()->create()]);
//    }
}
