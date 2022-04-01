<?php

namespace Database\Seeders;

use App\Models\TodoItem;
use App\Models\TodoList;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TodoListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $list = TodoList::factory()
            ->withUser(User::whereEmail('user@miashare.test')->first())
            ->create();

        TodoItem::factory()
            ->for($list, 'list')
            ->count(7)
            ->create();
    }
}
