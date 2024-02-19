<?php

namespace App\Policies;

use App\Models\Booking;
use App\Models\User;

class BookingPolicy
{
    public function view(User $user, Booking $booking): bool
    {
        return $user->id === $booking->user_id || $user->hasRole('admin');
    }

    public function delete(User $user, Booking $booking): bool
    {
        return $user->id === $booking->user_id || $user->hasRole('admin');
    }

    public function browse(User $user): bool
    {
        return $user->hasRole('admin');
    }

    public function add(User $user): bool
    {
        return $user->hasRole('admin');
    }

    public function edit(User $user): bool
    {
        return $user->hasRole('admin');
    }

    public function read(User $user): bool
    {
        return $user->hasRole('admin');
    }
}
