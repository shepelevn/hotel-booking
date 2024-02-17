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
        $days = intval($finishedAtDate->diff($startedAtDate)->format('%a'));

        $bookingData['days'] = $days;

        $room = Room::findOrFail(intval($bookingData['room_id']));

        $bookingData['price'] = $room->price * $days;

        return Booking::create($bookingData);
    }
}
