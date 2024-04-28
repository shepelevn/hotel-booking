<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Database\Eloquent\Builder;

class Booking extends Model
{
    use HasFactory;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'started_at',
        'finished_at',
        'days',
        'price',
        'room_id',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'started_at' => 'date',
        'finished_at' => 'date',
        'verified_at' => 'date',
    ];

    public function scopeSearchBy(Builder $query, string $searchParameter): void
    {
        $search = '%' . $searchParameter . '%';

        $query->where(function (Builder $query) use ($search) {
            $query
                ->orWhere('bookings.id', 'like', $search)
                ->orWhereHas('room', function (Builder $query) use ($search) {
                    $query
                        ->where('name', 'like', $search)
                        ->orWhereHas('hotel', function (Builder $query) use ($search) {
                            $query->where('name', 'like', $search);
                        })
                    ;
                })
            ;
        });
    }

    public function scopeSortedBy(Builder $query, mixed $field, mixed $order): void
    {
        if (! is_string($field)) {
            $field = 'created_at';
        }

        if (! is_string($order)) {
            $order = 'asc';
        }

        switch ($field) {
            case 'room_name':
                $query
                    ->select('bookings.*')
                    ->leftJoin('rooms', 'bookings.room_id', '=', 'rooms.id')
                    ->orderBy('name', $order)
                ;
                break;
            default:
                $query->orderBy($field, $order);
        }
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

    protected static function booted()
    {
        static::creating(function ($product) {
            if (is_null($product->user_id)) {
                $product->user_id = Auth::id();
            }
        });
    }

    /**
     * @return BelongsTo<Room, Booking>
     */
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * @return BelongsTo<User, Booking>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
