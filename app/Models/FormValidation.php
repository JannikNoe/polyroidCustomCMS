<?php

namespace App\Models;

use App\Models\Database;
use Exception;
use http\QueryString;

// validiert Eingabeformulare, indem sie das Eingabe-Array mit Regeln vergleicht
class FormValidation {

    private Database $db;
    private array $formInput;
    private array $rules;
    private array $errors = [];
    private array $messages = [];

    public function __construct(array $formInput, Database $db)
    {
        $this->db = $db;
        $this->formInput = $formInput;
    }

    // speichert die Regeln in $rules
    public function setRules(array $rules) : void
    {
        $this->rules = $rules;
    }

    // speichert benutzerdefinierte Fehlermeldungen in $messages
    public function setMessages(array $messages): void {
        $this->messages = $messages;
    }

    // validiert das Input-Array anhand der Regeln
    public function validate(): void
    {
        foreach ($this->rules as $field => $fieldRules) {
            $fieldRules = explode('|', $fieldRules);


            // wenn es das Feld nicht gibt, überspringen
            if (!in_array('required' , $fieldRules) && !$this->fieldExists($field)) {
                continue;
            }

            $this->validateField($field, $fieldRules);

        }
    }

    // gibt zurück, ob bei der Validierung Fehler aufgetreten sind
    public function fails() : bool {
        return !empty($this->errors);
    }

    // gibt ein Array von Fehlern zurück
    public function getErrors() : array {
        return $this->errors;
    }


    // validiert ein bestimmtes Feld anhand der festgelegten Regeln
    private function validateField(string $field, array $fieldRules)
    {
        // In der Zeile wird die usort Funktion aufgerufen, die das übergebene Array der Feldregeln sortiert
        usort($fieldRules, function ($firstRule, $secondRule) {
            if ($firstRule = 'required') {
                return -1;
            }

            return 1;
        });

        // In jeder Iteration wird der Inhalt der Regel analysiert, um die Regel zu identifizieren und den entsprechenden Methodennamen für die Ausführung zu finden.
        // Wenn die Regel nicht in der FormValidation Klasse vorhanden ist, wird die Iteration übersprungen.
        foreach ($fieldRules as $fieldRule) {
            $ruleSegments = explode(':', $fieldRule);
            $fieldRule = $ruleSegments[0];

            $satisfier = $ruleSegments[1] ?? null;

            if (!method_exists(FormValidation::class, $fieldRule)) {
                continue;
            }

            try {
                $this->{$fieldRule}($field, $satisfier);
            } catch (Exception $e) {

                $message = $this->messages["{$field}.{$fieldRule}"] ?? $e->getMessage();
                $this->errors[$field][] = $message;

                if ($fieldRule === 'required') {
                    break;
                }
            }
        }
    }

    // gibt zurück, ob das Feld existiert und nicht leer ist
    private function fieldExists(string $field): bool {
        return isset($this->formInput[$field])  && !empty($this->formInput[$field]);
    }

    // validiert, ob das Feld ausgefüllt wurde
    private function required(string $field) {

        if (!$this->fieldExists($field)) {
            throw new Exception("Das {$field} Feld ist leer.");
        }
    }

    // validiert, ob das Feld eine Mindestanzahl von Zeichen hat
    private function min(string $field, string $satisfier) {

        if (strlen($this->formInput[$field]) < (int) $satisfier) {
            throw new Exception("Das {$field} Feld muss mindestens {$satisfier} Zeichen haben.");
        }
    }

    // validiert, ob das Feld eine maximale Anzahl von Zeichen hat
    private function max(string $field, string $satisfier) {
        if (strlen($this->formInput[$field]) > (int) $satisfier) {
            throw new Exception("Das {$field} Feld darf nicht mehr als {$satisfier} Zeichen haben.");
        }
    }

    // validiert, ob das Feld eine gültige E-Mail-Adresse enthält
    private function email(string $field){
        if (!filter_var($this->formInput[$field], FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Das {$field} Feld muss eine E-Mail-Adresse enthalten");
        }
    }

    // validiert, ob das Feld mit einem anderen Feld übereinstimmt
    private function matches(string $field, string $satisfier) {
        if ($this->formInput[$field] !== $this->formInput[$satisfier]) {
            throw new Exception("Das {$field} Feld muss übereinstimmen mit dem {$satisfier} Feld.");
        }
    }

    // validiert, ob das Feld in der Datenbank noch nicht existiert
    private function available(string $field, string $satisfier) {
        $sql = "SELECT `id` FROM `{$satisfier}` WHERE `{$field}` = :field";

        $this->db->query($sql, ['field' => $this->formInput[$field]]);

        if ($this->db->count() > 0 ) {
            throw new Exception("Das {$field} ist bereits vergeben");
        }
    }

}

