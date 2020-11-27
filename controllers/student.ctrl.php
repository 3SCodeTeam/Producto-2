<?php

include_once 'includes/autoLoader.inc.php';
include_once 'templates/student/student.menu.var.php';
include_once 'templates/student/student.profile.var.php';

class StudentController{
    public function __construct(){

    }

    public function start(){
        StudentMenu::$menu='mSchedule';
        StudentMenu::activeMenu('mSchedule');
        return require_once('views/student.view.php');
    }
    public function profile(){        
        require_once 'modules/student.class.php';
        StudentMenu::activeMenu('profile');
        require_once('views/student.view.php');
    }

    public function profilePost(){        
        $updateProfile = new updateData();        
        $updateProfile-> updateStudentData();
        StudentMenu::activeMenu('profile');
        StudentProfile::$errormsg=$updateProfile->err;        
        require_once("views/student.view.php");
    }
    public function enrollment(){

    }
    public function dSchedule(){

    }
    public function wSchedule(){

    }
    public function mSchedule(){
        StudentMenu::$menu='mSchedule';
        StudentMenu::activeMenu('mSchedule');
        return require_once('views/student.view.php');
    }
}
?>