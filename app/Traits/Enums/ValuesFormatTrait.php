<?php

namespace app\Traits\Enums;

trait ValuesFormatTrait
{
    public static function values(): array
    {
        return array_map(
            static fn(self $item) => $item->value,
            self::cases()
        );
    }

    public static function toString(string $separator=','): string
    {
        return implode($separator,self::values());
    }
}
