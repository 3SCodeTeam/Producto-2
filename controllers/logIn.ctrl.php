<?php
include_once 'includes/autoloader.inc.php';
require_once('views/login.var.php');
class LogInController{

    public function __construct(){

    }

    public function new(){
        require_once("views/login.view.php");
    }
    public function post(){        
        require_once('modules/login.class.php');        
        $controller = new LogInChecker();        
        $controller -> checkUser();
    }    
    public function error($errmsg=NULL){
        if(isset($errmsg)){
            LogInvar::$errormsg = $errmsg;
        }
        require_once('views/login.view.php');
    }
}
?>