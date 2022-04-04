<?php

namespace App\Observers;

use App\Models\TodoList;
use Illuminate\Support\Facades\Auth;

class TodoListObserver
{
    /**
     * Handle the TodoList "creating" event.
     *
     * @param  \App\Models\TodoList  $todoList
     * @return void
     */
    public function creating(TodoList $todoList)
    {
        if(Auth::user())
        $todoList->user_id = Auth::id();
    }

    /**
     * Handle the TodoList "created" event.
     *
     * @param  \App\Models\TodoList  $todoList
     * @return void
     */
    public function created(TodoList $todoList)
    {
        //
    }

    /**
     * Handle the TodoList "updated" event.
     *
     * @param  \App\Models\TodoList  $todoList
     * @return void
     */
    public function updated(TodoList $todoList)
    {
        //
    }

    /**
     * Handle the TodoList "deleted" event.
     *
     * @param  \App\Models\TodoList  $todoList
     * @return void
     */
    public function deleted(TodoList $todoList)
    {
        $todoList->items()
            ->each(function ($item){
               $item->delete();
            });
    }

    /**
     * Handle the TodoList "restored" event.
     *
     * @param  \App\Models\TodoList  $todoList
     * @return void
     */
    public function restored(TodoList $todoList)
    {
        //
    }

    /**
     * Handle the TodoList "force deleted" event.
     *
     * @param  \App\Models\TodoList  $todoList
     * @return void
     */
    public function forceDeleted(TodoList $todoList)
    {
        //
    }
}
