<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Room;
use App\Services\BookingService;
use DateTimeImmutable;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index(Request $request): View
    {
        $queryData = $request->validate([
            'search' => 'string|nullable',
            'sort' => 'string|nullable|in:name,price',
            'order' => 'string|nullable|in:asc,desc',
            'min_price_filter' => 'integer|min:0|nullable',
            'max_price_filter' => 'integer|min:0|nullable',
        ]);

        $hotelsQuery = Hotel::withMinPrice()
            ->searchBy($queryData['search'] ?? '')
            ->sortedBy($queryData['sort'] ?? 'name', $queryData['order'] ?? 'asc')
            ->filterBy($queryData['min_price_filter'] ?? '', $queryData['max_price_filter'] ?? '')
        ;

        $hotels = $hotelsQuery->get();

        return view('hotels.index', compact('hotels'));
    }

    public function show(Request $request, Hotel $hotel, BookingService $bookingService): View
    {
        if ($request->has(['start_date', 'end_date'])) {
            $queryData = $request->validate([
                'start_date' => 'required|date|after:yesterday',
                'end_date' => 'required|date|after:start_date',
                'search' => 'string|nullable',
                'sort' => 'string|nullable|in:name,price,floor_area',
                'order' => 'string|nullable|in:asc,desc',
                'min_price_filter' => 'integer|min:0|nullable',
                'max_price_filter' => 'integer|min:0|nullable',
            ]);

            $rooms = Room::where('hotel_id', $hotel->id)
                ->freeAt($queryData['start_date'], $queryData['end_date'])
                ->searchBy($queryData['search'] ?? '')
                ->sortedBy($queryData['sort'] ?? 'name', $queryData['order'] ?? 'asc')
                ->filterBy($queryData['min_price_filter'] ?? '', $queryData['max_price_filter'] ?? '')
                ->get();

            $totalDays = $bookingService->getDays(
                new DateTimeImmutable($queryData['start_date']),
                new DateTimeImmutable($queryData['end_date']),
            );
        } else {
            $rooms = [];
            $totalDays = 0;
        }

        return view('hotels.show', compact('hotel', 'rooms', 'totalDays'));
    }
}
