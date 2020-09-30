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
                return $date;
            } else {
                return '';
            }
        } catch (\Throwable $e) {
            return '';
        }
    }
}
