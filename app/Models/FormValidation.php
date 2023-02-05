<?php

class FormValidation {

    private array $formInput;
    private array $rules;
    private array $errors = [];

    public function __construct(array $formInput)
    {
        $this->formInput = $formInput;
    }

    public function setRules(array $rules) : void
    {
        $this->rules = $rules;
    }

    public function validate(): void
    {
        foreach ($this->rules as $field => $fieldRules) {
            $fieldRules = explode('|', $fieldRules);


            // wenn es das Feld nicht gibt,  überspringen
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

            $satisfier = isset($ruleSegments[1]) ? $ruleSegments[1] : null;



            try {
                $this->{$fieldRule}($field, $satisfier);
            } catch (Exception $e) {
                $this->errors[$field][] = $e->getMessage();

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

//    Für die Registrierung relevant
//    private function matches(string $field, string $satisfier) {
//        if ($this->formInput[$field] !== $this->formInput[$satisfier]) {
//            throw new Exception("Das Passwort muss mit deiner ersten Eingabe übereinstimmen");
//        }
//    }

}

