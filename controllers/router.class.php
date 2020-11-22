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
                require_once('controllers/'.$this->controller.'.ctrl.php'); //MIRAR /controllers/logIn.ctrl.php
                $this->controller = new LogInController();
                break;
            case 'signin':
                require_once('controllers/'.$this->controller.'.ctrl.php'); //MIRAR /controllers/signIn.ctrl.php
                $this->controller = new SignInController();
                break;
            case 'student':
                if(!isset($_SESSION['user_id'])){
                    return $this->callErr('Debes iniciar sesión.');
                }
            break;
            /*case 'teacher':
                if(!isset($_SESSION['user_id'])){
                    return $this->callErr('Debes iniciar sesión.');
                }
            break;*/
            case 'admin':
                if(!isset($_SESSION['user_id'])){
                    return $this->callErr('Debes iniciar sesión.');
                }
            break;
            case 'error':
                //ENVIAR A PÁGINA DE ADVERTENCIA
            break;
            default:
                //ENVIAR A PÁGINA DE ERROR
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