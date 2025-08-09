<?php

namespace App\Actions;

use App\Models\Arena;
use App\Models\Booking;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

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

    public function userBookings()
    {

        $bookings = QueryBuilder::for(Booking::class)
            ->with('field.arena')
            ->allowedFilters([
                AllowedFilter::exact('user.id'),
            ]);

        return $bookings->paginate();
    }
}
