<?php

namespace Tests\Feature;

use App\Models\Hotel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HotelTest extends TestCase
{
    use RefreshDatabase;

    protected bool $seed = true;

    public function test_hotels_index_route(): void
    {
        $response = $this->get(route('hotels.index'));

        $response->assertOk();
    }

    public function test_hotels_show_route(): void
    {
        $hotel = Hotel::factory()->create();

        $response = $this->get(route('hotels.show', ['hotel' => $hotel]));

        $response->assertOk();
    }
}
