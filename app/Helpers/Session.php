<?php

namespace App\Helpers;

class Session {
    public static function exists(string $key):bool{
        return isset($_SESSION[$key]);
    }

    public static function get(string $key): mixed{
        if (self::exists($key)) {
            return $_SESSION[$key];
        }

        return null;
    }

    public static function set(string $key, mixed $value): void{
        $_SESSION[$key] = $value;
    }

    public static function delete(string $key): void {
        unset($_SESSION[$key]);
    }

    // Setzt eine Session einmal, löscht sie wieder, wenn sie das nächste Mal aufgerufen wird
    public static function flash(string $key, string $message = null): ?string {
        if (self::exists($key)) {
            $message = self::get($key);
            self::delete($key);

            return $message;
        }

        self::set($key, $message);
        return null;
    }
}


