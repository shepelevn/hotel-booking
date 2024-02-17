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

            @if ($errors->any())
                <div class="text-red-500 pt-5">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="get" action="{{ url()->current() }}">
                <div class="flex my-6">
                    <div class="flex items-center mr-5">
                        <div class="relative">
                            <input name="start_date" min="{{ date('Y-m-d') }}" value="{{ $startDate }}"
                                                                               placeholder="Дата заезда" type="date"
                                                                                                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5">
                        </div>
                        <span class="mx-4 text-gray-500">по</span>
                        <div class="relative">
                            <input name="end_date" type="date" min="{{ date('Y-m-d') }}" value="{{ $endDate }}"
                                                                                         placeholder="Дата выезда"
                                                                                         class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5">
                        </div>
                    </div>
                    <div>
                        <x-the-button type="submit" class=" h-full w-full">Загрузить номера</x-the-button>
                    </div>
                </div>
            </form>
            @if (Request::get('start_date') && Request::get('end_date'))
                @if (count($rooms) > 0)
                    <div class="flex flex-col w-full lg:w-4/5">
                        @foreach($rooms as $room)
                            <x-rooms.room-list-item :room="$room" :totalDays="$totalDays" class="mb-4"/>
                        @endforeach
                    </div>
                @else
                    <div>
                        {{ __('There are no rooms that are free for selected interval') }}
                    </div>
                @endif
            @endif
        </div>
    </div>
</x-app-layout>
