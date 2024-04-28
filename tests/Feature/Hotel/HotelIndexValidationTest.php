<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HotelIndexValidationTest extends TestCase
{
    use RefreshDatabase;

    protected bool $seed = true;

    public function test_can_not_enter_negative_minimal_price(): void
    {
        $response = $this->get(route('hotels.index', ['min_price_filter' => rand(1, 100) * -1]));

        $response->assertSessionHasErrors(['min_price_filter']);
    }

    public function test_can_not_enter_min_price_as_test(): void
    {
        $response = $this->get(route('hotels.index', ['min_price_filter' => '10abc']));

        $response->assertSessionHasErrors(['min_price_filter']);
    }

    public function test_can_not_enter_negative_maximum_price(): void
    {
        $response = $this->get(route('hotels.index', ['max_price_filter' => rand(1, 100) * -1]));

        $response->assertSessionHasErrors(['max_price_filter']);
    }

    public function test_can_not_enter_max_price_as_test(): void
    {
        $response = $this->get(route('hotels.index', ['max_price_filter' => '10abc']));

        $response->assertSessionHasErrors(['max_price_filter']);
    }

    public function test_can_not_select_wrong_sort_field(): void
    {
        $response = $this->get(route('hotels.index', ['sort' => 'wrong_field']));

        $response->assertSessionHasErrors(['sort']);
    }

    public function test_can_not_select_wrong_sort_order(): void
    {
        $response = $this->get(route('hotels.index', ['order' => 'wrong_order']));

        $response->assertSessionHasErrors(['order']);
    }
}
