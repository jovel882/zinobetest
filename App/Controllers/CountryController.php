<?php

namespace App\Controllers;

use Illuminate\Http\Request;
use App\Auth\Auth;

class CountryController extends Controller
{
    /**
     * Genera la vista con todos los paises.
     * @param Auth $auth Objeto de autenticacion.
     * @return Blade Con la vista de los paises.
     */
    public function index(Auth $auth)
    {
        $user=$auth->user;
        $data=$this->model->getAll();
        echo $this->view->make("country.index",compact("data","user"));        
    } 
}

?>