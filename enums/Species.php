<?php

namespace app\enums;

use Yii;

enum Species: string
{
    case Canine = 'C';
    case Feline = 'F';

    public static function getOptions(): array
    {
        $options = [];
        foreach (self::cases() as $case) {
            $options[$case->value] = Yii::t('app', $case->name);
        }
        return $options;
    }
}
