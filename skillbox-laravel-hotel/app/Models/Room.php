<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    use HasFactory;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'poster_url',
        'floor_area',
        'type',
        'price'
    ];

    public function scopeFreeAt(Builder $query, mixed $startDate, mixed $endDate): void
    {
        $query->whereDoesntHave('bookings', function (Builder $query) use ($startDate, $endDate) {
            $query
                ->where('started_at', '<=', $startDate)
                ->where('finished_at', '>=', $endDate)
            ;
        });
    }

    public function scopeSearchBy(Builder $query, string $searchParameter): void
    {
        $search = '%' . $searchParameter . '%';

        $query->where(function (Builder $query) use ($search) {
            $query
                ->orWhere('name', 'like', $search)
                ->orWhere('description', 'like', $search)
                ->orWhere('type', 'like', $search)
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

        $query->orderBy($field, $order);
    }

    public function scopeFilterBy(Builder $query, mixed $minPriceParameter, mixed $maxPriceParameter): void
    {
        if (is_numeric($minPriceParameter)) {
            $minPrice = floatVal($minPriceParameter);

            $query->having('price', '>', $minPrice);
        }

        if (is_numeric($maxPriceParameter)) {
            $maxPrice = floatVal($maxPriceParameter);

            $query->having('price', '<', $maxPrice);
        }
    }


    /**
     * @return BelongsTo<Hotel, Room>
     */
    public function hotel(): BelongsTo
    {
        return $this->belongsTo(Hotel::class);
    }

    /**
     * @return BelongsToMany<Facility>
     */
    public function facilities(): BelongsToMany
    {
        return $this->belongsToMany(Facility::class)
                    ->withTimestamps();
    }

    /**
     * @return HasMany<Booking>
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
