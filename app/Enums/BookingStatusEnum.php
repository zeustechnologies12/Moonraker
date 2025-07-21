<?php

namespace App\Enums;

enum BookingStatusEnum
{
    case Pending = 'pending';
    case Approved = 'approved';
    case Rejected = 'rejected';
    case Cancelled = 'cancelled';
}
