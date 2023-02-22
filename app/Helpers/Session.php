<?php

namespace App\Helpers;

// ermöglicht es, auf Session-Variablen zuzugreifen und sie zu verwalten, was wichtig ist, um die Benutzersitzungen in
// PHP zu implementieren und den Zustand der Anwendung zu speichern
class Session {
    // Diese function überprüft, ob eine Session-Variable mit dem angegebenen Schlüssel ($key) existiert.
    public static function exists(string $key):bool{
        return isset($_SESSION[$key]);
    }

    // Diese function gibt den Wert der Session-Variable mit dem angegebenen Schlüssel zurück,
    // wenn sie existiert, andernfalls wird null zurückgegeben.
    public static function get(string $key): mixed{
        if (self::exists($key)) {
            return $_SESSION[$key];
        }

        return null;
    }

    // Diese function setzt den Wert einer Session-Variable mit dem angegebenen Schlüssel auf den angegebenen Wert.
    public static function set(string $key, mixed $value): void{
        $_SESSION[$key] = $value;
    }
    // Diese function löscht die Session-Variable mit dem angegebenen Schlüssel.
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


