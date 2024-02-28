<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->delete();
        DB::statement("ALTER TABLE `users` AUTO_INCREMENT = 1");

        User::factory(50)->create();

        User::factory()->create([
            'name' => 'Обычный пользователь',
            'email' => 'user@example.com',
        ]);

        User::factory()->create([
            'name' => 'Администратор',
            'email' => 'admin@example.com',
            'role_id' => 1,
        ]);
    }
}
