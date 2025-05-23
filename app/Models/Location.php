<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Location extends Model
{
    use HasFactory;
    /**
     * Model Relationships
     */

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}
