<?php

namespace App\Enums\Order;

enum State: int
{
    case Pending = 0;
    case Validated = 1;
    case Canceled = 2;
    case Rejected = 3;

    public function label(): string
    {
        return match ($this) {
            self::Pending => 'Pending',
            self::Validated => 'Validated',
            self::Canceled => 'Canceled',
            self::Rejected => 'Rejected',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Pending => 'bg-warning text-white',
            self::Validated => 'bg-success text-white',
            self::Canceled, self::Rejected => 'bg-danger text-white',
        };
    }
}
