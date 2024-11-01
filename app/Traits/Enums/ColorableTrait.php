<?php

namespace app\Traits\Enums;

trait ColorableTrait
{
    public function getColor(): string
    {
        return self::color($this);
    }

    public static function color($key): string
    {
        $key = $key instanceof self ? $key->value : $key;

        return self::colors()[$key] ?? 'primary';
    }


}
