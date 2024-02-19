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
    public function index(Request $request): View
    {
        $queryData = $request->validate([
            'search' => 'string|nullable',
            'sort' => 'string|nullable|in:room_name,price,days,started_at,created_at,verified_at',
            'order' => 'string|nullable|in:asc,desc',
            'min_price_filter' => 'integer|min:0|nullable',
            'max_price_filter' => 'integer|min:0|nullable',
        ]);

        $user = auth()->user();

        if (is_null($user)) {
            throw new LogicException('Authenticated user not found');
        }

        $bookings = $user->bookings()
            ->searchBy($queryData['search'] ?? '')
            ->sortedBy($queryData['sort'] ?? 'created_at', $queryData['order'] ?? 'asc')
            ->filterBy($queryData['min_price_filter'] ?? '', $queryData['max_price_filter'] ?? '')
             ->get();

        return view('bookings.index', compact('bookings'));
    }

    public function show(Booking $booking): View
    {
        $this->authorize('view', $booking);

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
            session()->flash('danger-flash', __('Room booking failed'));

            throw ValidationException::withMessages(['room_id' => 'Номер занят на данные даты']);
        }

        $bookingService->createBookingFromDatesAndRoom($bookingData);

        session()->flash('success-flash', __('Room booked successfuly'));

        return Redirect::route('bookings.index', [], 303);
    }

    public function verify(Booking $booking, Request $request): RedirectResponse
    {
        if (! $request->hasValidSignature()) {
            session()->flash('danger-flash', __('Booking confirmation failed. Wrong link signature.'));

            abort(401);
        }

        $booking->verified_at = now();

        $booking->save();

        session()->flash('success-flash', __('Booking verified'));

        return Redirect::route('bookings.index');
    }

    public function destroy(Booking $booking): RedirectResponse
    {
        $this->authorize('delete', $booking);

        $booking->delete();

        session()->flash('success-flash', __('Booking removed'));

        return Redirect::route('bookings.index', [], 303);
    }
}
