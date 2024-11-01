<?php

namespace app\Traits\Enums;

trait ArrayAbleTrait
{
    public static function toArray():array
    {
        $array = [];

        foreach (self::cases() as $case){
            $item = [
                'case'  => $case->name,
                'value' => $case->value,
                'label' => $case->value,
            ];
            if (method_exists($case,'label'))
            {
                $item['label'] = $case->label();
            }

            $array[] = $item;
        }

        return $array;
    }


}
