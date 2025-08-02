<?php

namespace App\Actions;

use App\Enums\BookingStatusEnum;
use App\Models\Arena;
use App\Models\Field;
use Carbon\Carbon;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateBookingAction
{
    use AsAction;

    public function handle($field_id)
    {
        $field = Field::find($field_id) ?? null;
        $user = auth()->user();

        if ($response = $this->validateExistingBookings($field, $user)) {
            return $response;
        }
        return $this->createNewBooking($field, $user);

    }

    public function validateExistingBookings($field, $user)
    {
        return $user->bookings()
            ->whereFieldId($field->id)
            ->whereStatus(BookingStatusEnum::Pending)
            ->exists()
            ? response()->json([
                'message' => 'You already have a pending booking for this arena.',
            ], 409) : null
        ;
    }

    public function createNewBooking($field, $user)
    {
        $booking = $user->bookings()->make([
            'starts_at' => Carbon::now(),
            'ends_at' => Carbon::now()->addHours(2),
            'status' => BookingStatusEnum::Pending,
        ]);
        $booking->field()->associate($field);
        $booking->save();
        return response()->json([
            'message' => "Booking Created Successfully for $user->username",
            'booking_details' => $booking,
        ], 201);
    }
}
