<?php

namespace Database\Factories;

use App\Models\User;
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
        return [
            'price' => fake()->randomFloat(0, 1000, 60000),
            'user_id' => fake()->randomElement(User::pluck('id')),
            'verified_at' => fake()->dateTime,
        ];
    }
}
