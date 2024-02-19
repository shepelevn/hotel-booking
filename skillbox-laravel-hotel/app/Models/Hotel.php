<?php

namespace App\Models;

use App\Models\Filters\PriceBetweenFilter;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;
use Lacodix\LaravelModelFilter\Traits\HasFilters;

class Hotel extends Model
{
    use HasFactory;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'poster_url',
        'address',
    ];

    public function scopeWithMinPrice(Builder $query): void
    {
        $query
            ->leftJoin('hotel_prices', 'hotels.id', '=', 'hotel_prices.hotel_id')
            ->select('hotels.*')
            ->addSelect('min_price')
        ;
    }

    public function scopeSearchBy(Builder $query, string $searchParameter): void
    {
        $search = '%' . $searchParameter . '%';

        $query->where(function (Builder $query) use ($search) {
            $query
                ->orWhere('name', 'like', $search)
                ->orWhere('description', 'like', $search)
                ->orWhere('address', 'like', $search)
                ->orWhereHas('facilities', function (Builder $query) use ($search) {
                    $query->where('name', 'like', $search);
                })
            ;
        });
    }

    public function scopeSortedBy(Builder $query, mixed $field, mixed $order): void
    {
        if (! is_string($field)) {
            $field = 'name';
        }

        if (! is_string($order)) {
            $order = 'asc';
        }

        switch ($field) {
            case 'price':
                $query->orderBy('min_price', $order);
                break;
            default:
                $query->orderBy($field, $order);
        }
    }

    public function scopeFilterBy(Builder $query, mixed $minPriceParameter, mixed $maxPriceParameter): void
    {
        if (is_numeric($minPriceParameter)) {
            $minPrice = floatVal($minPriceParameter);

            $query->having('min_price', '>', $minPrice);
        }

        if (is_numeric($maxPriceParameter)) {
            $maxPrice = floatVal($maxPriceParameter);

            $query->having('min_price', '<', $maxPrice);
        }
    }

    /**
     * @return HasMany<Room>
     */
    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class);
    }

    /**
     * @return BelongsToMany<Facility>
     */
    public function facilities(): BelongsToMany
    {
        return $this->belongsToMany(Facility::class)
                    ->withTimestamps();
    }
}
