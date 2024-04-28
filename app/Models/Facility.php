<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Facility extends Model
{
    use HasFactory;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    /**
     * @return BelongsToMany<Hotel>
     */
    public function hotels(): BelongsToMany
    {
        return $this->belongsToMany(Hotel::class)
            ->withTimestamps();
    }

    /**
     * @return BelongsToMany<Room>
     */
    public function rooms(): BelongsToMany
    {
        return $this->belongsToMany(Room::class)
            ->withTimestamps();
    }
}
