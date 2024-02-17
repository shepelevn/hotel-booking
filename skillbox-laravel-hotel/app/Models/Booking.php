<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

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
