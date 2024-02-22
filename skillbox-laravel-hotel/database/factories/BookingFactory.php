<?php

namespace Database\Factories;

use App\Models\Room;
use App\Models\User;
use DateTimeImmutable;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDelta = rand(0, 30);
        $startedAt = new DateTimeImmutable($startDelta . ' days');
        $endDelta = $startDelta + rand(1, 30);
        $endedAt = new DateTimeImmutable($endDelta . ' days');

        return [
            'price' => fake()->randomFloat(0, 1000, 60000),
            'user_id' => fake()->randomElement(User::pluck('id')),
            'room_id' => fake()->randomElement(Room::pluck('id')),
            'started_at' => $startedAt,
            'finished_at' => $endedAt,
            'verified_at' => fake()->dateTime,
        ];
    }
}
