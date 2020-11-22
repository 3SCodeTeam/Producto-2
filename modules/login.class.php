<?php

include_once 'includes/autoloader.inc.php';
include_once 'students.mod.class.php';
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
        $this->pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
        $this->tipo = $_POST['rol_option'];  
        
    }

    public function checkUser(){    
        $this->user_data = $this->getUserData();
        
        if($this -> user_data != 0){            
            if($this->userExist()&&$this->passMatch()){
               $_SESSION['user_id']=rand(999999999, 999999999999);
                return require_once('public/posttest.php');
            }
        }
        return $this->errorMsg('Wrong user or password.');
    }

    private function getUserData(){
        switch($this->tipo){
            case 'admin':
                $module = new Admin();                
                return $module->getByUsername($this->name);
            case 'student':                
                $module = new Students();                
                return $module->getByUsername($this->name);                                 
            case 'teacher':
                $module = new Teacher();                
                return $module->getByUsername($this->name);
        }
    }
    private function userExist(){
        if($this->user_data == 0 || !isset($this->user_data)){
            return false;
        }
        return true;
    }
    private function passMatch(){             
        if($this->user_data->user->pass === $this->pass){
            true;
        }
        false;
    }
    private function errorMsg($msg=NULL){
        require_once('controllers/logIn.ctrl.php');
        $controller = new LogInController();
        return $controller -> error($msg);
    }
}
?>