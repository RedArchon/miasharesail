<?php

namespace App\Providers;

use App\Models\TodoItem;
use App\Models\TodoList;
use App\Policies\TodoItemPolicy;
use App\Policies\TodoListPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        TodoItem::class => TodoItemPolicy::class,
        TodoList::class => TodoListPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

    }
}
