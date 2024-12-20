<?php

namespace app\enums;

use Yii;

enum Sex: string
{
    case Female = 'F';
    case Male = 'M';

    public static function getOptions(): array
    {
        $options = [];
        foreach (self::cases() as $case) {
            $options[$case->value] = Yii::t('app', $case->name);
        }
        return $options;
    }
}
