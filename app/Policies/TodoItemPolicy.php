<?php

namespace App\Policies;

use App\Models\TodoItem;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TodoItemPolicy
{
    use HandlesAuthorization;

    public function view(User $user, TodoItem $todoItem)
    {
        if ($user->can('todo-item view')) {
            return true;
        }
        return $this->checkListOwnership($todoItem, $user);
    }

    public function update(User $user, TodoItem $todoItem): bool
    {
        if ($user->can('todo-item destroy')) {
            return true;
        }

        return $this->checkListOwnership($todoItem, $user);
    }

    public function delete(User $user, TodoItem $todoItem): bool
    {
        if ($user->can('todo-item destroy')) {
            return true;
        }

        return $this->checkListOwnership($todoItem, $user);
    }

    /**
     * @param TodoItem $todoItem
     * @param User $user
     * @return bool
     */
    private function checkListOwnership(TodoItem $todoItem, User $user): bool
    {
        return $todoItem
                ->list()
                ->first()
                ->user()
                ->first()
                ->id === $user->id;
    }
}
