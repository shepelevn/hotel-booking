<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class () extends Migration {
    public function up(): void
    {
        DB::statement('
            CREATE VIEW `hotel_prices` AS
            SELECT 
                h.id AS hotel_id,
                MIN(r.price) AS min_price
            FROM `hotels` AS h
            LEFT JOIN `rooms` AS r 
            ON r.hotel_id = h.id
            GROUP BY h.id;
        ');
    }

    public function down(): void
    {
        DB::statement('
            DROP VIEW `hotel_prices`;
        ');
    }
};
