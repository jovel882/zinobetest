<?php
namespace App\Validator\User;
use App\Validator\ValidatorFactory;
use App\Validator\ValidatorStrategy;
class LoginValidator implements ValidatorStrategy
{
    public function validate(array $fields){
        $validator = (new ValidatorFactory())->make($fields, [
            'email' => 'required|email',
            'password' => 'required|regex:/^(?=[a-zA-ZÁáÀàÉéÈèÍíÌìÓóÒòÚúÙùÑñüÜ0-9!.@\-#\+\$%\^&\*\?_~\/ ]*\d[a-zA-ZÁáÀàÉéÈèÍíÌìÓóÒòÚúÙùÑñüÜ0-9!.@\-#\+\$%\^&\*\?_~\/ ]*)[a-zA-ZÁáÀàÉéÈèÍíÌìÓóÒòÚúÙùÑñüÜ0-9!.@\-#\+\$%\^&\*\?_~\/ ]{6,}$/i',
        ],[
            "email.required"=>"Debes ingresar un correo.",
            "email.email"=>"Debes ingresar un correo valido.",
            "password.regex"=>'La contraseña no cumple los parametros, debe tener minimo 6 caracteres y al menos 1 dígito, acepta los caracteres de la "a" a la "z" en mayúsculas "A-Z" y minúsculas "a-z" y con sus acentos incluyendo ÑñüÜ. También incluye rango de digitos del "0-9", y caracteres especiales "!.@-#+$%^&*?_~/" junto al espacio.',
            "password.required"=>"Debes ingresar una contraseña.",
        ]);

        if ($validator->fails()) {
            return ["status"=>false,"errors"=>$validator->errors()->all()];        
        }
        else{
            return ["status"=>true];        
        }        
    }
}
?>