<?php

namespace App\Enums\Carousel;

use App\Contracts\Enums\ColorAbleContract;
use App\Traits\Enums\ColorableTrait;
use App\Traits\Enums\ValuesFormatTrait;

enum State: int implements ColorAbleContract
{
    use ColorableTrait, ValuesFormatTrait;

    case INACTIVE = 0;
    case ACTIVE = 1;

    public static function colors(): array
    {
        return [
            self::INACTIVE->value => 'light-danger',
            self::ACTIVE->value => 'light-success',
        ];
    }
    public function label():string
    {
        return __('labels.enum.carousel.state.'.$this->value);
    }
}
