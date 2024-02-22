<?php

namespace Tests\Feature;

use App\Models\Hotel;
use DateTimeImmutable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HotelShowValidationTest extends TestCase
{
    use RefreshDatabase;

    protected bool $seed = true;

    public function test_validation_show_can_not_enter_negative_minimal_price(): void
    {
        $hotel = Hotel::factory()->create();
        $startDate = (new DateTimeImmutable())->format('Y-m-d');
        $endDate = (new DateTimeImmutable('7 days'))->format('Y-m-d');

        $response = $this->get(
            route(
                'hotels.show',
                [
                    'hotel' => $hotel,
                    'min_price_filter' => rand(1, 100) * -1,
                    'start_date' => $startDate,
                    'end_date' => $endDate
                ]
            )
        );

        $response->assertSessionHasErrors(['min_price_filter']);
    }

    public function test_validation_show_can_not_enter_min_price_as_test(): void
    {
        $hotel = Hotel::factory()->create();
        $startDate = (new DateTimeImmutable())->format('Y-m-d');
        $endDate = (new DateTimeImmutable('7 days'))->format('Y-m-d');

        $response = $this->get(route(
            'hotels.show',
            [
                'hotel' => $hotel,
                'min_price_filter' => '10abc',
                'start_date' => $startDate,
                'end_date' => $endDate
            ]
        ));

        $response->assertSessionHasErrors(['min_price_filter']);
    }

    public function test_validation_show_can_not_enter_negative_maximum_price(): void
    {
        $hotel = Hotel::factory()->create();
        $startDate = (new DateTimeImmutable())->format('Y-m-d');
        $endDate = (new DateTimeImmutable('7 days'))->format('Y-m-d');

        $response = $this->get(route(
            'hotels.show',
            [
                'hotel' => $hotel,
                'max_price_filter' => rand(1, 100) * -1,
                'start_date' => $startDate,
                'end_date' => $endDate
            ]
        ));

        $response->assertSessionHasErrors(['max_price_filter']);
    }

    public function test_validation_show_can_not_enter_max_price_as_test(): void
    {
        $hotel = Hotel::factory()->create();
        $startDate = (new DateTimeImmutable())->format('Y-m-d');
        $endDate = (new DateTimeImmutable('7 days'))->format('Y-m-d');

        $response = $this->get(route(
            'hotels.show',
            [
                'hotel' => $hotel,
                'max_price_filter' => '10abc',
                'start_date' => $startDate,
                'end_date' => $endDate
            ]
        ));

        $response->assertSessionHasErrors(['max_price_filter']);
    }

    public function test_validation_show_can_not_select_wrong_sort_field(): void
    {
        $hotel = Hotel::factory()->create();
        $startDate = (new DateTimeImmutable())->format('Y-m-d');
        $endDate = (new DateTimeImmutable('7 days'))->format('Y-m-d');

        $response = $this->get(route(
            'hotels.show',
            [
                'hotel' => $hotel,
                'sort' => 'wrong_field',
                'start_date' => $startDate,
                'end_date' => $endDate
            ]
        ));

        $response->assertSessionHasErrors(['sort']);
    }

    public function test_validation_show_can_not_select_wrong_sort_order(): void
    {
        $hotel = Hotel::factory()->create();
        $startDate = (new DateTimeImmutable())->format('Y-m-d');
        $endDate = (new DateTimeImmutable('7 days'))->format('Y-m-d');

        $response = $this->get(route(
            'hotels.show',
            [
                'hotel' => $hotel,
                'order' => 'wrong_order',
                'start_date' => $startDate,
                'end_date' => $endDate
            ]
        ));

        $response->assertSessionHasErrors(['order']);
    }
}
