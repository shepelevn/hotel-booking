<option value="{{ $value }}" {{ request()->input('sort') === $value ? 'selected' : ''}}>
    {{ $text }}
</option>
