<?php

namespace App\Helpers;

use http\Exception;

class Str {

    // wandelt eine gegebene Zeichenfolge in eine URL-freundliche Zeichenfolge (Slug) um, indem sie alle Sonderzeichen entfernt,
    // die Buchstaben in Kleinbuchstaben umwandelt und Leerzeichen durch Bindestriche ersetzt
    public static function slug(string $string)
    {
        $disallowedCharacters = '/[^\-\s\pN\pL]+/';
        $spacesDuplicateHyphens = '/[\-\s]+/';

        $slug = mb_strtolower($string, 'UTF-8');
        $slug = preg_replace($disallowedCharacters, '', $slug);
        $slug = preg_replace($spacesDuplicateHyphens, '-', $slug);
        $slug = trim($slug, '-');

        return $slug;
    }

    // gibt einen zufällig generierten hexadezimalen String zurück
    public static function token(): string
    {
        return bin2hex(random_bytes(16));
    }

    // wandelt eine unterstrichgetrennte Zeichenfolge in eine camelCase-Zeichenfolge um,
    // indem sie alle Unterstriche entfernt und den ersten Buchstaben jedes Wortes in Großbuchstaben umwandelt
    public static function toCamelCase(string $subject): string {
        $words = explode('_', $subject);

        $words = array_map(function ($word) {
            return ucfirst($word);
        }, $words);

        $subject = lcfirst(implode('', $words));

        return $subject;
    }
}