<?php

namespace App\Models;

use App\Helpers\Str;
use Exception;

class FileStorage {
    private array $file;
    private string $extension;
    private string $currentLocation;
    private string $generatedName;

    // Ein Konstruktor, der die $file-Eigenschaft setzt und die anderen drei Eigenschaften mit Informationen aus dem hochgeladenen Datei-Array initialisiert
    public function __construct(array $file)
    {
        $this->file = $file;
        $this->extension = strtolower(pathinfo($this->file['name'], PATHINFO_EXTENSION));
        $this->currentLocation = $this->file['tmp_name'];
        $this->generatedName = Str::token() . '.' . $this->extension;
    }

    // Eine Getter-Methode, die den generierten Namen der hochgeladenen Datei zurückgibt
    public function getGeneratedName(): string
    {
        return $this->generatedName;
    }

    // Eine Methode, die die hochgeladene Datei in einem bestimmten Ordner speichert.
    public function saveIn(string $folder): void
    {
        $destination = "{$folder}/{$this->generatedName}";

        if (!move_uploaded_file($this->currentLocation, $destination)) {
            throw new Exception('We encountered an error uploading the file.');
        }
    }
    // Eine statische Methode, die eine Datei anhand ihres Pfades löscht
    public static function delete(string $path): bool
    {
        return unlink(ltrim($path, DIRECTORY_SEPARATOR));
    }
}