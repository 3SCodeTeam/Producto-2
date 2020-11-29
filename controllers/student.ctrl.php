<?php

include_once 'includes/autoLoader.inc.php';
include_once 'templates/student/student.menu.var.php';
include_once 'templates/student/student.profile.var.php';
include_once 'templates/student/student.enrollment.var.php';

class StudentController{
    public function __construct(){

    }

    public function start(){
        StudentMenu::$menu='mSchedule';
        StudentMenu::activeMenu('mSchedule');
        return require_once('views/student.view.php');
    }
    public function profile(){                
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
        StudentMenu::activeMenu('enrollment');
        require_once('views/student.view.php');
    }
    public function dSchedule(){        
        StudentMenu::activeMenu('dSchedule');
        require_once('views/student.view.php');

    }
    public function wSchedule(){        
        StudentMenu::activeMenu('wSchedule');
        require_once('views/student.view.php');

    }
    public function mSchedule(){
        StudentMenu::$menu='mSchedule';
        StudentMenu::activeMenu('mSchedule');
        return require_once('views/student.view.php');
    }
    public function PostEnrollment(){    
        $id_course = $_POST['id_course'];
        $enrollStudent = new enrollStudent($id_course);
        $enrollStudent->enrollStudent();
        StudentMenu::activeMenu('enrollment');
        StudentEnrollment::$errormsg = $enrollStudent->err;
        require_once("views/student.view.php");
    }
}
?>