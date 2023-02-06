<?php

namespace App\Models;

use App\Models\Database;
use Exception;
use http\QueryString;

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

    public function setRules(array $rules) : void
    {
        $this->rules = $rules;
    }

    public function setMessages(array $messages): void {
        $this->messages = $messages;
    }

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

    public function fails() : bool {
        return !empty($this->errors);
    }

    public function getErrors() : array {
        return $this->errors;
    }


    private function validateField(string $field, array $fieldRules)
    {
        usort($fieldRules, function ($firstRule, $secondRule) {
            if ($firstRule = 'required') {
                return -1;
            }

            return 1;
        });


        foreach ($fieldRules as $fieldRule) {
            $ruleSegments = explode(':', $fieldRule);
            $fieldRule = $ruleSegments[0];

//            if (isset($ruleSegments[1])){
//                $satisfier = $ruleSegments[1];
//            } else {
//                $satisfier = null;
//            }
//
//            if (!method_exists(FormValidation::class, $fieldRule)) {
//                continue;
//            }

            // oben und unten gleich - nur unterschiedlicher Aufbau

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

    private function fieldExists(string $field): bool {
        return isset($this->formInput[$field])  && !empty($this->formInput[$field]);
    }

    private function required(string $field) {

        if (!$this->fieldExists($field)) {
            throw new Exception("The {$field} field is required.");
        }
    }

    private function min(string $field, string $satisfier) {

        if (strlen($this->formInput[$field]) < (int) $satisfier) {
            throw new Exception("The {$field} must be at least {$satisfier} charakters.");
        }
    }

    private function max(string $field, string $satisfier) {
        if (strlen($this->formInput[$field]) > (int) $satisfier) {
            throw new Exception("The {$field} field must not be more than {$satisfier} charakters.");
        }
    }

    private function email(string $field){
        if (!filter_var($this->formInput[$field], FILTER_VALIDATE_EMAIL)) {
            throw new Exception("The {$field} field must be a valid email adress");
        }
    }


    private function matches(string $field, string $satisfier) {
        if ($this->formInput[$field] !== $this->formInput[$satisfier]) {
            throw new Exception("Das {$field} Feld muss übereinstimmen mit dem {$satisfier} Feld.");
        }
    }

    private function available(string $field, string $satisfier) {
        $sql = "SELECT `id` FROM `{$satisfier}` WHERE `{$field}` = :field";

        $this->db->query($sql, ['field' => $this->formInput[$field]]);

        if ($this->db->count() > 0 ) {
            throw new Exception("Das {$field} ist bereits vergeben");
        }
    }

}

