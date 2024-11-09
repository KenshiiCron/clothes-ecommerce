<?php

namespace App\Enums\Carousel;

use App\Contracts\Enums\ColorAbleContract;
use App\Traits\Enums\ColorableTrait;
use App\Traits\Enums\ValuesFormatTrait;

enum Type: int implements ColorAbleContract
{
    use ColorableTrait, ValuesFormatTrait;

    case NOTHING = 0;
    case PRODUCT = 1;
    case LINK = 2;

    public static function colors(): array
    {
        return [
            self::NOTHING->value => 'light-info',
            self::PRODUCT->value => 'light-info',
            self::LINK->value => 'light-info',
        ];
    }
    public function label():string
    {
        return __('labels.enum.carousel.type.'.$this->value);
    }
}
