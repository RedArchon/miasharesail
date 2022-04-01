<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['name' => 'admin'],
            ['name' => 'user']
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }

        $userPermissions = [
            ['name' => 'todo-item view'],
            ['name' => 'todo-item update'],
            ['name' => 'todo-item create'],
            ['name' => 'todo-item delete'],

            ['name' => 'todo-list view'],
            ['name' => 'todo-list update'],
            ['name' => 'todo-list create'],
            ['name' => 'todo-list delete'],
        ];

        foreach ($userPermissions as $userPermission) {
            Permission::create($userPermission);
        }
    }
}
