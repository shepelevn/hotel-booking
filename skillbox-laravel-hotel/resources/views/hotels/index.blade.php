<x-app-layout>
    <div class="py-14 px-4 md:px-6 2xl:px-20 2xl:container 2xl:mx-auto">

        <x-form-validation-errors />

        <x-forms.hotels />

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($hotels as $hotel)
                <x-hotels.hotel-card :hotel="$hotel"></x-hotels.hotel-card>
            @endforeach
        </div>
        <div class="mt-3">
            {{ $hotels->links() }}
        </div>
    </div>
</x-app-layout>
