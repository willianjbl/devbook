<?php

namespace src\helpers;

class DateHelper
{
    /**
     * Converts date format to database format.
     * @param string $date - Date in dd/mm/yyyy format.
     * @return string Returns the formatted date or an empty string if the format is invalid.
     */
    public static function americanDateConvert(string $date): string
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

    public static function retornarIdade(string $date): ?int
    {
        try {
            $birthDate = new \DateTime($date);
            $currentDate = new \DateTime();
            return $birthDate->diff($currentDate)->y;
        } catch (\Throwable $e) {
            return null;
        }
    }
}
