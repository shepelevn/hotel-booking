<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\Room;
use DateTimeImmutable;

class BookingService
{
    /**
     * @param array<string, string> $bookingData
     */
    public function createBookingFromDatesAndRoom(array $bookingData): Booking
    {
        $startedAtDate = new DateTimeImmutable($bookingData['started_at']);
        $finishedAtDate = new DateTimeImmutable($bookingData['finished_at']);
        $days = self::getDays($startedAtDate, $finishedAtDate);

        $room = Room::findOrFail(intval($bookingData['room_id']));

        $bookingData['price'] = $room->price * $days;

        return Booking::create($bookingData);
    }

    public static function getDays(DateTimeImmutable $startedAt, DateTimeImmutable $finishedAt): int
    {
        return intval($finishedAt->diff($startedAt)->format('%a'));
    }
}
