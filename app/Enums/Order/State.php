<?php

namespace App\Enums\Order;

use App\Contracts\Enums\ColorAbleContract;
use App\Traits\Enums\ColorableTrait;
use App\Traits\Enums\ValuesFormatTrait;

enum State: int implements ColorAbleContract
{
    use ColorableTrait, ValuesFormatTrait;

    case PENDING = 0;
    case CONFIRMED = 1;
    case CANCELLED = 2;

    public static function colors(): array
    {
        return [
            self::PENDING->value => 'light-info',
            self::CONFIRMED->value => 'light-success',
            self::CANCELLED->value => 'light-danger',
        ];
    }
    public function label():string
    {
        return __('labels.enum.order.state.'.$this->value);
    }
}
