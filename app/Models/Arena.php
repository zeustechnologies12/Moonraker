<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Arena extends Model
{
    use HasFactory;

    /**
     * Model Relationships
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }
    public function users():BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function bookings():HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
