<?php

namespace src\helpers;

class DateHelper
{
    /**
     * Converts date format to database format.
     * @param string $date - Date in dd/mm/yyyy format.
     * @return string Returns the formatted date or an empty string if the format is invalid.
     */
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
