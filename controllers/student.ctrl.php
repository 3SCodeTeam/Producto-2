<?php
if(!isset($_SESSION)){
    session_start();
}
class StudentController{
    public function __construct(){

    }

    public function start(){
        return require_once('views/student.view.php');
    }
}
?>