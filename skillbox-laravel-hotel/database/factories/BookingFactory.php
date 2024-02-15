<?php

namespace Database\Factories;

use DateTimeImmutable;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDelta = random_int(1, 60);
        $days = random_int(1, 30);
        $endDelta = $startDelta + $days;

        $startedAt = new DateTimeImmutable($startDelta . ' days');
        $finishedAt = new DateTimeImmutable($endDelta . ' days');

        /* TODO: Add price calculation */

        return [
            'started_at' => $startedAt,
            'finished_at' => $finishedAt,
            'days' => $days,
            'price' => fake()->randomFloat(0, 1000, 60000),
        ];
    }
}
