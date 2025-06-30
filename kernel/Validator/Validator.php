<?php

namespace App\Kernel\Validator;

class Validator
{
    private array $errors = [];

    public function validate(array $data, array $rules): array
    {
        $this->errors = [];
        foreach ($rules as $key => $rule) {
            $rules = $rule;
            foreach ($rules as $rule) {
                $rule = explode(':', $rule);
                $ruleName = $rule[0];
                $ruleValue = $rule[1] ?? null;

                $error = $this -> validateRule($key, $ruleName, $ruleValue);

                if ($error) {
                    $errors[$key][]  = $error;
                }
            }
        }
        return $errors;
    }

    private function validateRule(string $key, string $ruleName, string $ruleValue = null): ?string
    {
        $value = $this -> data[$key];

        switch ($ruleName) {
            case 'required':
                if (!$value) {
                    return 'Field is required';
                }
                break;
            case 'min':
                if(strlen($value) < $ruleValue){
                    return 'Field must be at least '.$ruleValue.' characters long';
                }
                break;
            case 'max':
                if(strlen($value) > $ruleValue){
                    return 'Field must not be greater than '.$ruleValue.' characters';
                }
                break;
            case 'email':
                if(!filter_var($value, FILTER_VALIDATE_EMAIL)){
                    return 'Field must be a valid email address';
                }
        }
        return false;
    }
}