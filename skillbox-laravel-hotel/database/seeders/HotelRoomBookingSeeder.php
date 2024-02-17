<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Hotel;
use App\Models\Room;
use DateTimeImmutable;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HotelRoomBookingSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('hotels')->delete();
        DB::statement("ALTER TABLE `hotels` AUTO_INCREMENT = 1");
        DB::statement("ALTER TABLE `facility_hotel` AUTO_INCREMENT = 1");

        DB::table('rooms')->delete();
        DB::statement("ALTER TABLE `rooms` AUTO_INCREMENT = 1");
        DB::statement("ALTER TABLE `facility_room` AUTO_INCREMENT = 1");

        Hotel::factory(10)->create()->each(function (Hotel $hotel) {
            Room::factory(rand(3, 10))->create(['hotel_id' => $hotel->id])->each(function (Room $room) {
                $bookingsCount = rand(0, 3);
                $startDelta = rand(1, 30);

                for ($i = 0; $i < $bookingsCount; $i++) {
                    $days = rand(1, 30);
                    $endDelta = $startDelta + $days;

                    $startedAt = (new DateTimeImmutable($startDelta . ' days'));
                    $finishedAt = (new DateTimeImmutable($endDelta . ' days'));

                    $price = $room->price * $days;

                    Booking::factory()
                        ->createQuietly([
                            'started_at' => $startedAt,
                            'finished_at' => $finishedAt,
                            'days' => $days,
                            'price' => $price,
                            'room_id' => $room->id,
                        ]);

                    $startDelta = $endDelta + rand(1, 30);
                }
            });
        });
    }
}
