<?php
include_once 'includes/autoLoader.inc.php';
class Router{

    private $controller;
    private $method;

    public function __construct($controller, $method){
        $this->controller = $controller;
        $this->method = $method;
    }

    public function call(){
        if(!(ctype_alpha($this->controller)&&ctype_alpha($this->method))){
            $this->controler = 'error';
            $this->method = 'harderr';
        }
        switch($this->controller){
            case 'login':                
                require_once('controllers/'.$this->controller.'.ctrl.php');
                $this->controller = new LogIn();
                break;
        }        
        $this->controller->{$this->method}();
    }
}
?>