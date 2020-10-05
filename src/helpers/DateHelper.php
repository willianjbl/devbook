<?php

namespace src\helpers;

class DateHelper
{
    public static function americanDateConvert(string $date)
    {
        try {
            $date = explode('/', $date);
            if (count($date) === 3) {
                $date = "{$date[2]}-{$date[1]}-{$date[0]}";
                if (strtotime($date)) {
                    return $date;
                }
            }
            return '';
        } catch (\Throwable $e) {
            return '';
        }
    }
}
