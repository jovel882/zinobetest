<?php

namespace App\Exception;

use Jenssegers\Blade\Blade;
use App\Auth\Auth;
class ExceptionManger 
{
    public $view;
    public function __construct(?Blade $view)
    {
        $this->view = $view;
    }
    public function send($exception)
    {
        $user=Auth::getUser();
        echo $this->view->make("exception",compact("user","exception"));        
    }    
}

?>