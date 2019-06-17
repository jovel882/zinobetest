<?php
namespace App\Validator;

interface  ValidatorStrategy{
    public function validate(array $fields);
}

?>