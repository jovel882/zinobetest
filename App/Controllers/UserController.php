<?php

namespace App\Controllers;

use Illuminate\Http\Request;
use App\Auth\Auth;
use App\Validator\User\LoginValidator;
use App\Validator\User\StorageValidator;
use App\Validator\ValidatorContext;
class UserController extends Controller
{
    /**
     * @var array $validateEnable Validaciones habilitadas.
     */   
    protected $validateEnable=[
        "Login" => LoginValidator::class,
        "Storage" => StorageValidator::class,
    ];
    /**
     * Genera la vista con todos los usuarios.
     * @param Auth $auth Objeto de autenticacion.
     * @return Blade Con la vista de los usuarios.
     */    
    public function index(Auth $auth)
    {
        $user=$auth->user;
        $data=$this->model->getAll();
        echo $this->view->make("user.index",compact("data","user"));        
    }
    /**
     * Genera la vista del home.
     * @return Blade Con la vista del home.
     */    
    public function home()
    {
        $user=Auth::getUser();
        echo $this->view->make("home",compact("user"));        
    }
    /**
     * Retorna todos los usuarios que concuerden con la busqueda.
     * @param Request $request Toda la peticion.
     * @return Json Con los usuarios.
     */      
    public function search(Request $request)
    {
        return json_encode($this->model->searchByNameEmail($request->search));        
    }
    /**
     * Genera la vista para la autenticacion.
     * @param Auth $auth Objeto de autenticacion.
     * @return Blade Con la vista para la autenticacion.
     */    
    public function loginLoad(Auth $auth)
    {                
        echo $this->view->make("user.login");      
    }
    /**
     * Autentica a un usuario.
     * @param Request $request Toda la peticion.
     * @return Json Con el resultado de la autenticacion.
     */          
    public function login(Request $request)
    {
        $validator=(new ValidatorContext(new $this->validateEnable["Login"]))->validate($request->all());
        if ($validator["status"]==false) {
            return json_encode($validator);        
        }
        else{
            return json_encode(Auth::create($request));        
        }         
    }
    /**
     * Cierra session de un usario..
     */          
    public function logout()
    {   
        Auth::delete();
    }
    /**
     * Genera la vista para el registro.
     * @param Auth $auth Objeto de autenticacion.
     * @return Blade Con la vista para el registro.
     */          
    public function singUpLoad(Auth $auth)
    {   
        $countries=$this->model->getAllCountries();
        echo $this->view->make("user.singUp",compact("countries"));      
    }
    /**
     * Crea a un usuario.
     * @param Request $request Toda la peticion.
     * @return Json Con el resultado de la creacion del usuario.
     */          
    public function storage(Request $request)
    {
        $validator=(new ValidatorContext(new $this->validateEnable["Storage"]))->validate($request->all());
        if ($validator["status"]==false) {
            return json_encode($validator);        
        }
        else{
            $fields=$request->all();
            unset($fields["passwordConfirme"]);
            $this->model->createNew(
                array_filter($fields, function($k) {
                    return $k != 'passwordConfirme';
                })
            );
            return json_encode(Auth::create($request));            
        }         
    }      
}

?>