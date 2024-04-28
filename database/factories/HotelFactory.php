<?php

namespace Database\Factories;

use App\Models\Facility;
use App\Models\Hotel;
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
        '10.jpg',
    ];

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $posterUrl = 'hotels/' . fake()->randomElement(self::IMAGE_URLS);

        return [
            'name' => fake()->words(rand(1, 3), true),
            'description' => fake()->paragraph,
            'poster_url' => $posterUrl,
            'address' => fake()->address,
        ];
    }

    public function configure(): self
    {
        return $this->afterCreating(function (Hotel $hotel) {
            $facilities = Facility::all();

            $hotel->facilities()->saveMany(
                $facilities->random(rand(0, 10))
            );
        });
    }
}
