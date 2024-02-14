<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Обычный пользователь',
            'email' => 'user@example.com',
        ]);

        User::factory()->create([
            'name' => 'Администратор',
            'email' => 'admin@example.com',
            'roles' => [Role::User, Role::Admin],
        ]);
    }
}
