<?php

namespace App\Enums;

enum BookingStatusEnum: string
{
    case Pending = 'pending';
    case Approved = 'approved';
    case Rejected = 'rejected';
    case Cancelled = 'cancelled';

    public static function fromAction(string $action): ?self
    {
        return match (strtolower($action)) {
            'approve' => self::Approved,
            'reject' => self::Rejected,
            default => null,
        };
    }

    public static function allowedActions(): array
    {
        return ['approve', 'reject'];
    }
}
