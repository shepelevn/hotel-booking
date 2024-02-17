<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use App\Services\BookingService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use LogicException;

class BookingController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();

        if (is_null($user)) {
            throw new LogicException('Authenticated user not found');
        }

        $bookings = $user->bookings()->orderBy('created_at', 'DESC')->get();

        return view('bookings.index', compact('bookings'));
    }

    public function show(Booking $booking): View
    {
        return view('bookings.show', compact('booking'));
    }

    public function store(Request $request, BookingService $bookingService): RedirectResponse
    {
        $bookingData = $this->validate($request, [
            'started_at' => 'required|date|after:yesterday',
            'finished_at' => 'required|date|after:start_date',
            'room_id' => 'required|integer|exists:rooms,id',
        ]);

        $room = Room::findOrFail(intval($bookingData['room_id']));

        $crossedBookingsCount = Booking::where('room_id', $room->id)
            ->where('started_at', '<=', $bookingData['started_at'])
            ->where('finished_at', '>=', $bookingData['finished_at'])
            ->count()
        ;

        if ($crossedBookingsCount > 0) {
            throw ValidationException::withMessages(['room_id' => 'Номер занят на данные даты']);
        }

        $booking = $bookingService->createBookingFromDatesAndRoom($bookingData);

        return Redirect::route('bookings.index', [], 303);
    }

    public function verify(Booking $booking, Request $request): RedirectResponse
    {
        if (! $request->hasValidSignature()) {
            abort(401);
        }

        $booking->verified_at = now();

        $booking->save();

        return Redirect::route('bookings.index');
    }

    public function destroy(Booking $booking): RedirectResponse
    {
        $booking->delete();

        return Redirect::route('bookings.index', [], 303);
    }
}
