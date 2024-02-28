<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookingIndexValidationTest extends TestCase
{
    use RefreshDatabase;

    protected bool $seed = true;

    public function test_can_not_enter_negative_minimal_price(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->get(route('bookings.index', ['min_price_filter' => rand(1, 100) * -1]));

        $response->assertSessionHasErrors(['min_price_filter']);
    }

    public function test_can_not_enter_min_price_as_test(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->get(route('bookings.index', ['min_price_filter' => '10abc']));

        $response->assertSessionHasErrors(['min_price_filter']);
    }

    public function test_can_not_enter_negative_maximum_price(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->get(route('bookings.index', ['max_price_filter' => rand(1, 100) * -1]));

        $response->assertSessionHasErrors(['max_price_filter']);
    }

    public function test_can_not_enter_max_price_as_test(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->get(route('bookings.index', ['max_price_filter' => '10abc']));

        $response->assertSessionHasErrors(['max_price_filter']);
    }

    public function test_can_not_select_wrong_sort_field(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->get(route('bookings.index', ['sort' => 'wrong_field']));

        $response->assertSessionHasErrors(['sort']);
    }

    public function test_can_not_select_wrong_sort_order(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->get(route('bookings.index', ['order' => 'wrong_order']));

        $response->assertSessionHasErrors(['order']);
    }
}
