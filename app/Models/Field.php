<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Field extends Model
{
    public function arena(): BelongsTo
    {
        return $this->belongsTo(Arena::class);
    }
}
