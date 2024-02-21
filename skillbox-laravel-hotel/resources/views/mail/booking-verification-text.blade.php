<x-mail.layout>
    <p>
        {{ __('Please verify your booking #:id for the hotel ":hotelName" room ":roomName" by following', ['id' => $booking->id, 'hotelName' => $booking->room->hotel->name, 'roomName' => $booking->room->name]) }} <a href="{{ $link }}">{{ __('this link') }}</a>
    </p>
</x-layout>
