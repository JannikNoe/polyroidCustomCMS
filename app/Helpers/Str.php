<?php

namespace App\Helpers;

use http\Exception;

class Str {
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

    public static function token(): string
    {
        return bin2hex(random_bytes(16));
    }
}