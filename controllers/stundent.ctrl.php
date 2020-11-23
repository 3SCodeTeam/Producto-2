<?php
class StundentController{
    public function __construct(){

    }

    public function start(){
        return require_once('views/student.view.php');
    }
}
?>