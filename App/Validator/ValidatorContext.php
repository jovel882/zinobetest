<?php
namespace App\Validator;
use App\Validator\ValidatorStrategy;

class  ValidatorContext{
    private $strategy;
    public function __construct(ValidatorStrategy $strategy){
        $this->strategy=$strategy;
    }
    public function validate(array $fields){
        return $this->strategy->validate($fields);
    }
}

?>