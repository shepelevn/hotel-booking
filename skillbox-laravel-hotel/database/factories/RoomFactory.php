<?php

namespace Database\Factories;

use App\Models\Facility;
use App\Models\Hotel;
use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
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
        $posterUrl = 'images/rooms/' . fake()->randomElement(self::IMAGE_URLS);

        return [
            'name' => fake()->words(1, true),
            'description' => fake()->paragraph,
            'poster_url' => $posterUrl,
            'floor_area' => fake()->randomFloat(2, 20, 50),
            'type' => fake()->words(rand(1, 3), true),
            'price' => fake()->randomFloat(2, 1000, 10000),
            'hotel_id' => fake()->randomElement(Hotel::pluck('id')),
        ];
    }

    public function configure(): self
    {
        return $this->afterCreating(function (Room $room) {
            $facilities = Facility::all();

            $room->facilities()->saveMany(
                $facilities->random(rand(0, 10))
            );
        });
    }
}
