<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'starts_at',
        'ends_at',
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function arena(): BelongsTo
    {
        return $this->belongsTo(Arena::class);
    }
}
