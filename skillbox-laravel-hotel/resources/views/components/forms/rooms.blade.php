<form method="get" action="{{ url()->current() }}">
    <div class="flex flex-row flex-wrap gap-5 my-6">
        <div class="flex items-center">
            <div class="relative">
                <input name="start_date" min="{{ date('Y-m-d') }}" value="{{ $startDate }}"
                                                                   placeholder="Дата заезда" type="date"
                                                                                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5">
            </div>
            <span class="mx-4 font-medium text-gray-500">по</span>
            <div class="relative">
                <input name="end_date" type="date" min="{{ date('Y-m-d') }}" value="{{ $endDate }}"
                                                                             placeholder="Дата выезда"
                                                                             class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5">
            </div>
        </div>


        <x-input-label for="search">
            {{ __('Search') }}
            <x-input type="text" name="search" id="search" value="{{ request()->input('search') }}" />
        </x-input-label>

        <x-input-label class="flex flex-wrap items-center gap-3">
            {{ __('Price Filter') }}
            <x-input class="max-w-24 [appearance:textfield]" type="number" name="min_price_filter" id="min_price_filter" value="{{ request()->input('min_price_filter') }}" min="0" />
        </x-input-label>

        <x-input-label class="flex flex-wrap items-center gap-3">
            {{ __('to') }}
            <x-input class="max-w-24 [appearance:textfield]" type="number" name="max_price_filter" id="max_price_filter" value="{{ request()->input('max_price_filter') }}" min="0" />
        </x-input-label>


        <x-input-label class="flex flex-wrap flex-row gap-x-3 gap-y-3 items-center" for="sort">Sort by:

            <x-select id="sort" name="sort">
                <x-select-option value="name" text="Name" />
                <x-select-option value="price" text="Price" />
                <x-select-option value="floor_area" text="Floor Area" />
            </x-select>

            <x-select id="order" name="order">
                <option value="asc" {{ request()->input('order') === 'asc' ? 'selected' : ''}}>Ascending</option>
                <option value="desc" {{ request()->input('order') === 'desc' ? 'selected' : ''}}>Descending</option>
            </x-select>

        </x-input-label>

        <div>
            <x-the-button type="submit" class=" h-full w-full">Загрузить номера</x-the-button>
        </div>
    </div>
</form>
