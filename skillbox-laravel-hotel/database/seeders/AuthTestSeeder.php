<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AuthTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(VoyagerDatabaseSeeder::class);
        $this->call(UserSeeder::class);
    }
}
