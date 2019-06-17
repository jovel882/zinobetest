<?php
namespace App\Validator\User;
use App\Validator\ValidatorFactory;
use App\Validator\ValidatorStrategy;
class StorageValidator implements ValidatorStrategy
{
    public function validate(array $fields){
        $validator = (new ValidatorFactory())->make($fields, [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'country_id' => 'required|integer',
            'password' => 'required|regex:/^(?=[a-zA-ZÁáÀàÉéÈèÍíÌìÓóÒòÚúÙùÑñüÜ0-9!.@\-#\+\$%\^&\*\?_~\/ ]*\d[a-zA-ZÁáÀàÉéÈèÍíÌìÓóÒòÚúÙùÑñüÜ0-9!.@\-#\+\$%\^&\*\?_~\/ ]*)[a-zA-ZÁáÀàÉéÈèÍíÌìÓóÒòÚúÙùÑñüÜ0-9!.@\-#\+\$%\^&\*\?_~\/ ]{6,}$/i',
            'passwordConfirme' => 'required|same:password',
        ],[
            "name.required"=>"Debes ingresar tu nombre completo.",
            "name.min"=>"Debes ingresar un nombre de mas de 3 caracteres.",
            "email.required"=>"Debes ingresar un correo.",
            "email.email"=>"Debes ingresar un correo valido.",
            "email.unique"=>"El correo que ingresaste ya esta registrado.",
            "country_id.required"=>"Debes seleccionar tu país.",
            "country_id.integer"=>"Debes seleccionar tu país.",
            "password.required"=>"Debes ingresar una contraseña.",
            "password.regex"=>'La contraseña no cumple los parametros, debe tener minimo 6 caracteres y al menos 1 dígito, acepta los caracteres de la "a" a la "z" en mayúsculas "A-Z" y minúsculas "a-z" y con sus acentos incluyendo ÑñüÜ. También incluye rango de digitos del "0-9", y caracteres especiales "!.@-#+$%^&*?_~/" junto al espacio.',
            "passwordConfirme.required"=>"Debes ingresar la confirmacion de contraseña.",
            "passwordConfirme.same"=>"La confirmacion no coincide con la contraseña.",
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