<?php

namespace App\Actions;

use App\Enums\BookingStatusEnum;
use App\Models\Booking;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Lorisleiva\Actions\Concerns\AsAction;

class BookingAction
{
    use AsAction;

    public function handle(Booking $booking, $action)
    {
        $validator = Validator::make(['action' => $action], [
            'action' => ['required',  Rule::in(BookingStatusEnum::allowedActions())],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Invalid action',
                'errors' => $validator->errors(),
            ], 422);
        }
        $booking->status = BookingStatusEnum::fromAction($action);
        $booking->save();

        return response()->json([
            'message' => "Booking {$action}d successfully.",
            'booking' => $booking,
        ]);
    }
}
