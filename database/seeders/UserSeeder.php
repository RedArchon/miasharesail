<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->create([
                'name' => 'Admin',
                'email' => 'admin@miashare.test',
                'password' => bcrypt('Password2022!')
            ])
            ->assignRole('admin');

        User::factory()
            ->create([
                'name' => 'User',
                'email' => 'user@miashare.test',
                'password' => bcrypt('Password2022!')
            ])
            ->assignRole('user');
    }
}
