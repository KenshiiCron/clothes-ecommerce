<?php

namespace app\Traits\Enums;

trait IconableTrait
{
    public function getIcon(): string
    {
        return self::icon($this);
    }

    public static function icon($key): string
    {
        $key = $key instanceof self ? $key->value : $key;

        return self::icons()[$key] ?? 'primary';
    }


}
