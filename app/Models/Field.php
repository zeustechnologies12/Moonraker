<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Field extends Model
{
    public function arena(): BelongsTo
    {
        return $this->belongsTo(Arena::class);
    }

    public function bookings():HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function sport():BelongsTo
    {
        return $this->belongsTo(Sport::class);
    }
}
