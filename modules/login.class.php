<?php

include_once 'includes/autoloader.inc.php';
include_once 'students.mod.class.php';
include_once 'usersAdmin.mod.class.php';
include_once 'student.class.php';

class LogInChecker{
    
    private $name;
    private $email;
    private $pass;
    private $tipo;

    private $user_data;

    public function __construct(){
        $this->name = $_POST['username'];
        $this->email= $_POST['email'];
        $this->pass = crypt($_POST['pass'],'$6$Nodejesquemeentiendan.Guardameelsecreto.');
        $this->tipo = $_POST['rol_option'];         
    }

    public function checkUser(){    
        $this->user_data = $this->getUserData();        
        //var_dump($this->user_data);
        if($this->user_data != 0){            
            if($this->userExist()&&$this->passMatch()){                
               $_SESSION['user_id']=password_hash($_POST['pass'], PASSWORD_BCRYPT);
               $user_data->pass = null;
               $GLOBALS['user_data']=$user_data;
               return $this->callUserTemplate();
            }
        }
        return $this->errorMsg('Usuario y/o contraseña incorrectos.');
    }

    private function callUserTemplate(){
        switch($this->tipo){
            case 'student':
                $route = new Router('student', 'start');
            break;            
            case 'admin':
                $route = new Router('admin', 'start');
            break;
            case 'teacher':
                //$route = new Router('teacher', 'start');
            //break;
            default:
                return $this->errorMesg('Tipo de usuario incorrecto.');            
        }
        $route -> call();
    }

    private function getUserData(){
        switch($this->tipo){
            case 'admin':
                $module = new usersAdminMod();                
                return $module->getByUsername($this->name);
            case 'student':                
                $module = new Students();                
                return $module->getByUsername($this->name);
            /*case 'teacher':
                $module = new Teacher();                
                return $module->getByUsername($this->name);*/
        }
    }
    private function userExist(){
        if(!isset($this->user_data[0])){            
            return false;
        }        
        return true;
    }
    private function passMatch(){        
        //var_dump($this->user_data[0]->pass === $this->pass);
        if($this->user_data[0]->pass === $this->pass){
            return true;
        }
        return false;
    }
    private function errorMsg($msg=NULL){
        require_once('controllers/logIn.ctrl.php');
        $controller = new LogInController();
        return $controller -> error($msg);
    }
}
?>