<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\Room;
use App\Models\User;
use DateTimeImmutable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class BookingTest extends TestCase
{
    use RefreshDatabase;

    protected bool $seed = true;

    public function test_bookings_index_route(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('bookings.index'));

        $response->assertOk();
    }

    public function test_bookings_index_route_authorization(): void
    {
        $response = $this->get(route('bookings.index'));

        $response->assertStatus(302);
    }

    public function test_bookings_show_route(): void
    {
        $user = User::factory()->create();
        $booking = Booking::factory()->createQuietly(['user_id' => $user->id]);

        $response = $this
            ->actingAs($user)
            ->get(route('bookings.show', ['booking' => $booking]))
        ;

        $response->assertOk();
    }

    public function test_bookings_show_route_authorization(): void
    {
        $user = User::factory()->create();
        $booking = Booking::factory()->createQuietly(['user_id' => $user->id]);

        $response = $this
            ->get(route('bookings.show', ['booking' => $booking]))
        ;

        $response->assertStatus(302);
    }

    public function test_bookings_show_reject_for_other_users(): void
    {
        $user = User::factory()->create();
        $booking = Booking::factory()->createQuietly(['user_id' => $user->id]);

        $otherUser = User::factory()->create();

        $response = $this
            ->actingAs($otherUser)
            ->get(route('bookings.show', ['booking' => $booking]))
        ;

        $response->assertStatus(403);
    }

    public function test_booking_store(): void
    {
        $user = User::factory()->create();
        $room = Room::factory()->create();

        $startedAt = (new DateTimeImmutable('1 day'))->format('Y-m-d');
        $finishedAt = (new DateTimeImmutable('8 days'))->format('Y-m-d');

        $response = $this
            ->actingAs($user)
            ->post(
                route('bookings.store'),
                ['started_at' => $startedAt, 'finished_at' => $finishedAt, 'room_id' => $room->id]
            );

        $response->assertStatus(303);

        $this->assertDatabaseHas(
            'bookings',
            ['started_at' => $startedAt, 'finished_at' => $finishedAt, 'room_id' => $room->id]
        );
    }

    public function test_booking_store_can_not_have_finished_at_be_less_or_equal_to_started_at(): void
    {
        $user = User::factory()->create();
        $room = Room::factory()->create();

        $startedAt = (new DateTimeImmutable())->format('Y-m-d');
        $finishedAt = (new DateTimeImmutable())->format('Y-m-d');

        $response = $this
            ->actingAs($user)
            ->post(
                route('bookings.store'),
                ['started_at' => $startedAt, 'finished_at' => $finishedAt, 'room_id' => $room->id]
            );

        $response->assertStatus(302);

        $response->assertSessionHasErrors(['finished_at']);
    }

    public function test_booking_store_can_not_have_yesterday_date(): void
    {
        $user = User::factory()->create();
        $room = Room::factory()->create();

        $startedAt = (new DateTimeImmutable('-1 day'))->format('Y-m-d');
        $finishedAt = (new DateTimeImmutable())->format('Y-m-d');

        $response = $this
            ->actingAs($user)
            ->post(
                route('bookings.store'),
                ['started_at' => $startedAt, 'finished_at' => $finishedAt, 'room_id' => $room->id]
            );

        $response->assertStatus(302);

        $response->assertSessionHasErrors(['started_at']);
    }

    public function test_booking_store_can_not_book_more_than_60_days(): void
    {
        $user = User::factory()->create();
        $room = Room::factory()->create();

        $startedAt = (new DateTimeImmutable())->format('Y-m-d');

        $finishedAt = (new DateTimeImmutable('61 days'))->format('Y-m-d');

        $response = $this
            ->actingAs($user)
            ->post(
                route('bookings.store'),
                ['started_at' => $startedAt, 'finished_at' => $finishedAt, 'room_id' => $room->id]
            );

        $response->assertStatus(302);

        $response->assertSessionHasErrors(['finished_at']);
    }

    public function test_booking_store_can_book_60_days(): void
    {
        $user = User::factory()->create();
        $room = Room::factory()->create();

        $startedAt = (new DateTimeImmutable())->format('Y-m-d');

        $finishedAt = (new DateTimeImmutable('60 days'))->format('Y-m-d');

        $response = $this
            ->actingAs($user)
            ->post(
                route('bookings.store'),
                ['started_at' => $startedAt, 'finished_at' => $finishedAt, 'room_id' => $room->id]
            );

        $response->assertStatus(303);

        $this->assertDatabaseHas(
            'bookings',
            ['started_at' => $startedAt, 'finished_at' => $finishedAt, 'room_id' => $room->id]
        );
    }

    public function test_booking_store_can_not_book_already_booked_date(): void
    {
        $user = User::factory()->create();
        $room = Room::factory()->create();

        $startedAt = (new DateTimeImmutable())->format('Y-m-d');
        $finishedAt = (new DateTimeImmutable('7 days'))->format('Y-m-d');

        Booking::factory()->createQuietly([
            'room_id' => $room->id,
            'started_at' => new DateTimeImmutable(),
            'finished_at' => new DateTimeImmutable('7 days')
        ]);

        $response = $this
            ->actingAs($user)
            ->post(
                route('bookings.store'),
                ['started_at' => $startedAt, 'finished_at' => $finishedAt, 'room_id' => $room->id]
            );

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['room_id']);

        $startedAt = (new DateTimeImmutable('2 days'))->format('Y-m-d');

        $response = $this
            ->actingAs($user)
            ->post(
                route('bookings.store'),
                ['started_at' => $startedAt, 'finished_at' => $finishedAt, 'room_id' => $room->id]
            );

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['room_id']);

        $finishedAt = (new DateTimeImmutable('5 days'))->format('Y-m-d');

        $response = $this
            ->actingAs($user)
            ->post(
                route('bookings.store'),
                ['started_at' => $startedAt, 'finished_at' => $finishedAt, 'room_id' => $room->id]
            );

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['room_id']);
    }

    public function test_booking_store_can_book_at_finished_date(): void
    {
        $user = User::factory()->create();
        $room = Room::factory()->create();

        $startedAt = (new DateTimeImmutable())->format('Y-m-d');
        $finishedAt = (new DateTimeImmutable('7 days'))->format('Y-m-d');

        Booking::factory()->createQuietly([
            'room_id' => $room->id,
            'started_at' => new DateTimeImmutable(),
            'finished_at' => new DateTimeImmutable('7 days')
        ]);

        $startedAt = (new DateTimeImmutable('7 days'))->format('Y-m-d');
        $finishedAt = (new DateTimeImmutable('10 days'))->format('Y-m-d');

        $response = $this
            ->actingAs($user)
            ->post(
                route('bookings.store'),
                ['started_at' => $startedAt, 'finished_at' => $finishedAt, 'room_id' => $room->id]
            );

        $response->assertStatus(303);

        $this->assertDatabaseHas(
            'bookings',
            ['started_at' => $startedAt, 'finished_at' => $finishedAt, 'room_id' => $room->id]
        );
    }

    public function test_booking_store_can_not_book_non_existing_room(): void
    {
        $user = User::factory()->create();
        $room = Room::factory()->create();

        $roomId = $room->id;

        $room->delete();

        $startedAt = (new DateTimeImmutable())->format('Y-m-d');

        $finishedAt = (new DateTimeImmutable('7 days'))->format('Y-m-d');

        $response = $this
            ->actingAs($user)
            ->post(
                route('bookings.store'),
                ['started_at' => $startedAt, 'finished_at' => $finishedAt, 'room_id' => $roomId]
            );

        $response->assertStatus(302);

        $response->assertSessionHasErrors(['room_id']);
    }

    public function test_bookings_post_authorization(): void
    {
        $room = Room::factory()->create();

        $startedAt = (new DateTimeImmutable())->format('Y-m-d');

        $finishedAt = (new DateTimeImmutable('7 days'))->format('Y-m-d');

        $response = $this
            ->post(
                route('bookings.store'),
                ['started_at' => $startedAt, 'finished_at' => $finishedAt, 'room_id' => $room->id]
            );

        $response->assertStatus(302);
    }

    public function test_booking_deletion(): void
    {
        $user = User::factory()->create();
        $booking = Booking::factory()->createQuietly(['user_id' => $user->id]);

        $response = $this
            ->actingAs($user)
            ->delete(route('bookings.destroy', ['booking' => $booking]))
        ;

        $response->assertStatus(303);

        $this->assertDatabaseMissing('bookings', ['id' => $booking->id]);
    }

    public function test_booking_deletion_authorization(): void
    {
        $user = User::factory()->create();
        $booking = Booking::factory()->createQuietly(['user_id' => $user->id]);

        $response = $this
            ->delete(route('bookings.destroy', ['booking' => $booking]))
        ;

        $response->assertStatus(302);

        $this->assertDatabaseHas('bookings', ['id' => $booking->id]);
    }

    public function test_booking_is_not_verified_after_creation(): void
    {
        $user = User::factory()->create();
        $room = Room::factory()->create();

        $startedAt = (new DateTimeImmutable())->format('Y-m-d');

        $finishedAt = (new DateTimeImmutable('7 days'))->format('Y-m-d');

        $response = $this
            ->actingAs($user)
            ->post(
                route('bookings.store'),
                ['started_at' => $startedAt, 'finished_at' => $finishedAt, 'room_id' => $room->id]
            );

        $response->assertStatus(303);

        $this->assertDatabaseHas(
            'bookings',
            ['started_at' => $startedAt, 'finished_at' => $finishedAt, 'room_id' => $room->id, 'verified_at' => null]
        );
    }

    public function test_booking_can_be_verified(): void
    {
        $user = User::factory()->create();
        $booking = Booking::factory()->createQuietly(['verified_at' => null, 'user_id' => $user->id]);

        $link = URL::temporarySignedRoute('bookings.verify', now()->addHours(12), ['booking' => $booking]);

        $this->actingAs($user)
            ->get($link);

        $this->assertDatabaseMissing('bookings', ['id' => $booking->id, 'verified_at' => null]);
    }

    public function test_booking_can_not_be_verified_with_wrong_hash(): void
    {
        $user = User::factory()->create();
        $booking = Booking::factory()->createQuietly(['verified_at' => null, 'user_id' => $user->id]);

        $this->actingAs($user)
            ->get(route('bookings.verify', ['booking' => $booking]));

        $this->assertDatabaseHas('bookings', ['id' => $booking->id, 'verified_at' => null]);
    }
}
