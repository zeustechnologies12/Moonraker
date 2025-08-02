<?php

namespace App\Actions;

use App\Models\Arena;
use Lorisleiva\Actions\Concerns\AsAction;

class GetBookingsAction
{
    use AsAction;

    public function handle(Arena $arena)
    {
        $bookings = $arena->fields()
            ->with(['bookings.user', 'bookings.field.sport'])
            ->get()
            ->pluck('bookings')
            ->flatten()
            ->sortByDesc('starts_at')
            ->values();

        return response()->json([
            'arena' => $arena->name,
            'bookings' => $bookings,
        ]);
    }
}
