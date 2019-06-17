<?php

namespace App\Controllers;

use Jenssegers\Blade\Blade;
use App\Interfaces\ModelInterface;
use Session\Session;
class Controller 
{
    public $view;
    public $model;    
    public function __construct(Blade $view,ModelInterface $model)
    {
        $this->view = $view;
        $this->model = $model;
    }
}

?>