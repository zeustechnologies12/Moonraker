<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
