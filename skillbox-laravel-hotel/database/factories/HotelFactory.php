<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hotel>
 */
class HotelFactory extends Factory
{
    private const IMAGE_URLS = [
        '1.jpg',
        '2.jpg',
        '3.jpg',
        '4.jpg',
        '5.jpg',
        '6.jpg',
        '7.jpg',
        '8.jpg',
        '9.jpg',
    ];

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $posterUrl = 'images/hotels/' . self::IMAGE_URLS[array_rand(self::IMAGE_URLS)];

        return [
            'name' => fake()->words(random_int(1, 3), true),
            'description' => fake()->paragraph,
            'poster_url' => $posterUrl,
            'address' => fake()->address,
        ];
    }
}
