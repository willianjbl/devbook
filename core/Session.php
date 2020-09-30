<?php

namespace core;

class Session
{
    public static function start()
    {
        session_start();
    }

    public static function get(string $key): ?string
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
        return null;
    }

    public static function set(string $key, string $value): void
    {
        $_SESSION[$key] = $value;
    }

    public static function getAll()
    {
        return $_SESSION;
    }

    public static function delete(string $key): void
    {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    public static function destroy()
    {
        session_regenerate_id();
        session_destroy();
    }
}