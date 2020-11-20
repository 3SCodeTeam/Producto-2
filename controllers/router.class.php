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
                $this->controller = new LogInController();
                break;
            case 'register':
                break;
            case 'student':
                if(!isset($_SESSION['user_id'])){
                    return $this->callErr('Debes iniciar sesión.');
                }
            break;
            case 'teacher':
            break;
            case 'admin':
            break;
        }        
        $this->controller->{$this->method}();
    }

    private function callErr($msg=NULL){
        require_once('controllers/logIn.ctrl.php');
        $controller = new LogInController();
        return $controller->error($msg);
    }
}
?>