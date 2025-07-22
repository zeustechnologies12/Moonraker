<?php

namespace App\Actions;

use App\Enums\BookingStatusEnum;
use App\Models\Arena;
use Carbon\Carbon;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateBookingAction
{
    use AsAction;

    public function handle($arena_id)
    {
        $arena = Arena::find($arena_id) ?? null;
        $user = auth()->user();

        if ($response = $this->validateExistingBookings($arena, $user)) {
            return $response;
        }
        return $this->createNewBooking($arena, $user);

    }

    public function validateExistingBookings($arena, $user)
    {
        return $user->bookings()
            ->whereArenaId($arena->id)
            ->whereStatus(BookingStatusEnum::Pending)
            ->exists()
            ? response()->json([
                'message' => 'You already have a pending booking for this arena.',
            ], 409) : null
        ;
    }

    public function createNewBooking($arena, $user)
    {
        $booking = $user->bookings()->make([
            'starts_at' => Carbon::now(),
            'ends_at' => Carbon::now()->addHours(2),
            'status' => BookingStatusEnum::Pending,
        ]);
        $booking->arena()->associate($arena);
        $booking->save();
        return response()->json([
            'message' => "Booking Created Successfully for $user->username",
            'booking_details' => $booking,
        ], 201);
    }
}
