<?php

namespace App;

// repräsentiert eine HTTP-Anfrage an den Server
class Request {
    private array $pageParams;

    public function __construct(array $pageParams)
    {
        $this->pageParams = $pageParams;
    }

    public function getMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    // Der Parameter $kind gibt an, ob es sich um POST-, GET- oder Datei-Eingaben handelt
    // Die Methode sanitizeInput($input) filtert jede Eingabe, um unerwünschte Zeichen wie HTML-Tags oder Leerzeichen zu entfernen.
    public function getInput(string $kind = 'post'): array
    {
        $input = match($kind) {
            'post' => $this->sanitizeInput($_POST),
            'get' => $this->sanitizeInput($_GET),
            'file' => $_FILES,
            'page' => $this->pageParams,
        };

        return $input;
    }

    // alle HTML-Sonderzeichen in den Eingabewerten in ihre HTML-Entsprechungen konvertiert werden und alle
    // unnötigen Leerzeichen am Anfang und Ende der Eingabewerte entfernt werden.
    private function sanitizeInput(array $input): array
    {
        return array_map(function ($element) {
            return htmlspecialchars(trim($element));
        }, $input);
    }
}