<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Hotel;
use App\Models\Room;
use App\Services\BookingService;
use DateTimeImmutable;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index(): View
    {
        $hotels = Hotel::all();

        return view('hotels.index', compact('hotels'));
    }

    public function show(Request $request, Hotel $hotel, BookingService $bookingService): View
    {
        if ($request->has(['start_date', 'end_date'])) {
            $datesData = $request->validate([
                'start_date' => 'required|date|after:yesterday',
                'end_date' => 'required|date|after:start_date',
            ]);

            $rooms = Room::where('hotel_id', $hotel->id)
                ->whereDoesntHave('bookings', function (Builder $query) use ($datesData) {
                    $query
                        ->where('started_at', '<=', $datesData['start_date'])
                        ->where('finished_at', '>=', $datesData['end_date'])
                    ;
                })->get();

            $totalDays = $bookingService->getDays(
                new DateTimeImmutable($datesData['start_date']),
                new DateTimeImmutable($datesData['end_date']),
            );
        } else {
            $rooms = [];
            $totalDays = 0;
        }

        return view('hotels.show', compact('hotel', 'rooms', 'totalDays'));
    }
}
