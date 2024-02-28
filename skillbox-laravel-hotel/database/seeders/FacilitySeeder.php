<?php

namespace Database\Seeders;

use App\Models\Facility;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('facilities')->delete();
        DB::statement("ALTER TABLE `facilities` AUTO_INCREMENT = 1");

        Facility::factory(10)->create();
    }
}
