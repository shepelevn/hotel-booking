<?php

namespace App\Observers;

use App\Mail\BookingVerificationMail;
use App\Models\Booking;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use LogicException;

class BookingObserver
{
    public function created(Booking $booking): void
    {
        $user = auth()->user();

        if (is_null($user)) {
            throw new LogicException('Authenticated user not found');
        }

        $link = URL::temporarySignedRoute('bookings.verify', now()->addHours(12), ['booking' => $booking]);

        Mail::to($user->email)->send(new BookingVerificationMail($user, $booking, $link));
    }
}
