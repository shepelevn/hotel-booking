@php
    $startDate = request()->get('start_date', \Carbon\Carbon::now()->format('Y-m-d'));
    $endDate = request()->get('end_date', \Carbon\Carbon::now()->addDay()->format('Y-m-d'));
@endphp

<x-app-layout>
    <div class="py-14 px-4 md:px-6 2xl:px-20 2xl:container 2xl:mx-auto">
        <div class="flex flex-wrap mb-12">
            <div class="w-full flex justify-start md:w-1/3 mb-8 md:mb-0">
                <img class="h-full rounded-l-sm" src="{{ asset($hotel->poster_url) }}" alt="Room Image">
            </div>
            <div class="w-full md:w-2/3 px-4">
                <div class="text-2xl font-bold">{{ $hotel->name }}</div>
                <div class="flex items-center">
                    {{ $hotel->address }}
                </div>
                <div>{{ $hotel->description }}</div>
            </div>
        </div>
        <div class="flex flex-col">
            <div class="text-2xl text-center md:text-start font-bold">Забронировать комнату</div>

            <x-form-validation-errors />

            <x-forms.rooms :startDate="$startDate" :endDate="$endDate" />

            @if (Request::get('start_date') && Request::get('end_date'))
                @if (count($rooms) > 0)
                    <div class="flex flex-col w-full lg:w-4/5">
                        @foreach($rooms as $room)
                            <x-rooms.room-list-item :room="$room" :totalDays="$totalDays" class="mb-4"/>
                        @endforeach
                        <div class="mt-3">
                            {{ $rooms->links() }}
                        </div>
                    </div>
                @else
                    <div>
                        {{ __('No rooms found') }}
                    </div>
                @endif
            @endif
        </div>
    </div>
</x-app-layout>
