<form method="get" action="{{ url()->current() }}">
    <div class="flex flex-row flex-wrap gap-5 my-6">

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


        <x-input-label class="flex flex-wrap flex-row gap-x-3 gap-y-3 items-center" for="sort">{{ __('Sort by') }}:

            <x-select id="sort" name="sort">
                <x-select-option value="created_at" text="{{ __('Creation Date') }}" />
                <x-select-option value="price" text="{{ __('Price') }}" />
                <x-select-option value="room_name" text="{{ __('Room Name') }}" />
                <x-select-option value="days" text="{{ __('Days') }}" />
                <x-select-option value="started_at" text="{{ __('Starting Date') }}" />
                <x-select-option value="verified_at" text="{{ __('Verification Date') }}" />
            </x-select>

            <x-select id="order" name="order">
                <option value="asc" {{ request()->input('order') === 'asc' ? 'selected' : ''}}>{{ __('Ascending') }}</option>
                <option value="desc" {{ request()->input('order') === 'desc' ? 'selected' : ''}}>{{ __('Descending') }}</option>
            </x-select>

        </x-input-label>

        <div>
            <x-the-button type="submit" class=" h-full w-full">{{ __('Apply') }}</x-the-button>
        </div>
    </div>
</form>
