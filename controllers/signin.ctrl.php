<?php
require_once('views/login.var.php');
class SignInController{

    public function __construct(){

    }
    public function new(){
        require_once("views/signin.view.php");
    }
    public function post(){        
        require_once('modules/signIn.class.php');
        $controller = new signIn();
        $controller->newStudent();
    }    
    public function error($errmsg=NULL){
        if(isset($errmsg)){
            LogInvar::$errormsg = $errmsg;
        }
        require_once('views/login.view.php');
    }
}
?>






