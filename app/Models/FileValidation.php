<?php

namespace App\Models;
use Exception;


// Die Klasse ist dafür verantwortlich, die Regeln für das Hochladen von Dateien zu validieren
class FileValidation {

    private array $inputFiles;
    private array $rules;
    private array $errors = [];
    private array $allowedTypes = [
        'image' => [
            'jpg' => IMAGETYPE_JPEG,
            'jpeg' => IMAGETYPE_JPEG,
            'png' => IMAGETYPE_PNG,
            'webp' => IMAGETYPE_WEBP
        ]
    ];

    // Der Konstruktor erhält ein assoziatives Array, das alle Informationen über die hochgeladenen Dateien enthält.
    public function __construct(array $files) {
        $this->inputFiles = $files;
    }

    // Mit dieser Methode werden die Validierungsregeln festgelegt.
    public function setRules(array $rules): void {
        $this->rules = $rules;
    }

    // Diese Methode gibt true zurück, wenn es während der Validierung einen Fehler gibt, ansonsten gibt sie false zurück.
    public function fails(): bool {
        return !empty($this->errors);
    }

    public function getErrors(): array {
        return $this->errors;
    }

    // Diese Methode validiert jedes Feld anhand der definierten Regeln.
    public function validate(): void {

        foreach ($this->rules as $field => $fieldRules) {
            $fieldRules = explode('|', $fieldRules);

            if (!in_array('required' , $fieldRules) && !$this->fieldExists($field)) {
                continue;
            }

            $this->validateField($field, $fieldRules); //Mit dieser Methode wird ein bestimmtes Dateifeld anhand einer oder mehrerer Regeln validiert.
        }
    }

    // Mit dieser Methode wird ein bestimmtes Dateifeld anhand einer oder mehrerer Regeln validiert.
    private function validateField(string $field, array $fieldRules): void {
        foreach ($fieldRules as $fieldRule) {
            $ruleSegments = explode(':', $fieldRule);

            $fieldRule = $ruleSegments[0];
            $satisfier = $ruleSegments[1] ?? null;

            if (!method_exists(FileValidation::class, $fieldRule)) {
                continue;
            }

            try {
                $this->{$fieldRule}($field, $satisfier);
            } catch (Exception $e) {
                $this->errors[$field][] = $e->getMessage();
            }


        }
    }

    // Diese Methode prüft, ob ein bestimmtes Dateifeld vorhanden ist.
    private function fieldExists($field) {
        return isset($this->inputFiles[$field]) && $this->inputFiles[$field]['size'] > 0;
    }

    // Diese Methode prüft, ob das angegebene Dateifeld vorhanden ist.
    private function required($field): void {
        if (!$this->fieldExists($field)) {
            throw new Exception("The {$field} field must not be empty.");
        }
    }

    // Diese Methode prüft, ob das Dateifeld den angegebenen Dateityp aufweist. Es unterstützt nur die Typen "image" und "document".
    private function type($field, $satisfier): void {
        $allowedExtensions= array_keys($this->allowedTypes[$satisfier]);

        $extension = strtolower((pathinfo($this->inputFiles[$field]['name'], PATHINFO_EXTENSION)));

        if (!in_array($extension, $allowedExtensions)) {
            throw new Exception("The {$field} field must be a type of {$satisfier}");
        }

        if ($satisfier === 'image') {

            $currentLocation = $this->inputFiles[$field]['tmp_name'];
            $detectedMimeType = exif_imagetype($currentLocation);
            $allowedMimeType = $this->allowedTypes[$satisfier][$extension];

            if ($detectedMimeType !== $allowedMimeType) {
                throw new Exception("The {$field} field must be a type of {$satisfier}");
            }
        }
    }

    // Diese Methode prüft, ob das Dateifeld eine maximale Größe aufweist.
    private function maxsize($field, $satisfier): void {
        if ($this->inputFiles[$field]['size'] > (int)$satisfier) {
            throw new Exception("The {$field} field must not exceed {$satisfier} bytes.");
        }
    }
 }