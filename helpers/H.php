<?php

namespace app\helpers;

use Yii;

/*** Generic Helper Methods ***/

class H
{
    public static function date2obj(string $date, $mask = ''): \DateTime|null
    {
        if (empty($mask)) {
            $mask = self::getDateMask();
        }

        $dateTime = \DateTime::createFromFormat($mask, $date);

        return ($dateTime instanceof \DateTime) ? $dateTime : null;
    }

    public static function formatDate(\DateTime $dateTime): string
    {
        return $dateTime->format(self::getDateMask());
    }

    private static function getDateMask()
    {
        if (substr(Yii::$app->language, 0, 2) === 'en') {
            return 'm/d/Y';
        }

        return 'd/m/Y';
    }
}
