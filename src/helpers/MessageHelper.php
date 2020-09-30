<?php

namespace src\helpers;

use core\Session;

class MessageHelper
{
    public static function flashMessage(string $status, $message): void
    {
        Session::set('FLASH_MSG', $message);
        Session::set('FLASH_STATUS', $status);
    }

    public static function catchMessage(): ?array
    {
        $tempMessage = [
            'message' => Session::get('FLASH_MSG'),
            'status' => Session::get('FLASH_STATUS'),
        ] ?? null;

        if (!empty(Session::get('FLASH_MSG'))) {
            Session::delete('FLASH_MSG');
            Session::delete('FLASH_STATUS');
        }

        return $tempMessage;
    }
}
