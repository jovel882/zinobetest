<?php

namespace App\Auth;

use Session\Session;
use App\Models\User;
use Illuminate\Http\Request;
class Auth 
{
    public $user;
    static private $urlLogin="/login";
    static private $urlHome="/user";
    public function __construct(bool $not_validate=false)
    {
        $userId=Session::instance()->get('user');
        if(!empty($userId)){
            $this->user=User::findFromId($userId);
            if($not_validate==true){
                header("Location: ".self::$urlHome);
                die();
            }
        }
        else{
            if($not_validate==false){
                // throw  new \Exception('No tienes acceso a estos recurso.', 403);
                header("Location: ".self::$urlLogin);
                die();
            }
        }
    }
    static public function create(Request $request){
        $user=User::findFromLogin($request->email??false);
        if(!empty($user) && password_verify($request->password??false, $user->password??true)){
            Session::instance()->set('user',$user->id);

            return ["status"=>true,"url"=>self::$urlHome];
        }
        else{
            return ["status"=>false,"url"=>self::$urlLogin];
        }
    }
    static public function delete(){
        $userId=Session::instance()->get('user');
        if(!empty($userId)){
            Session::instance()->destroy();
            header("Location: ".self::$urlLogin);
            die();
        }
        else{
            header("Location: ".self::$urlHome);
            die();            
        }
    }
    static public function getUser(){
        $userId=Session::instance()->get('user');
        if(!empty($userId)){
            return User::findFromId($userId);
        }
    }
}

?>