<?php
include_once 'includes/autoloader.inc.php';
include_once 'views/admin.var.php';
include_once 'templates/admin/admin.teachers.var.php';
include_once 'templates/admin/admin.menu.var.php';
include_once 'templates/admin/admin.courses.var.php';
include_once 'modules/teachers.mod.class.php';
include_once 'modules/createNewValues.admin.class.php';

class AdminController{


    public function __construct(){

    }
    public function start(){
        AdminVar::activeMenu();
        require_once("views/admin.view.php");
    }

    public function teacher(){
        AdminMenu::$menu='teacher';
        AdminVar::activeMenu('teacher');
        require_once("views/admin.view.php");
    }

    public function teacherPost(){
        AdminVar::activeMenu('teacher');
        $createTeacher = new createNewValue();                
        If($createTeacher->createTeacher()){        
            AdminTeachers::$errormsg="Datos registrados.";            
            require_once("views/admin.view.php");
        }else{                                    
            AdminTeachers::$errormsg=$createTeacher->err;            
            require_once("views/admin.view.php");
        }
    }

    public function courses(){
        AdminMenu::$menu='courses';
        AdminVar::activeMenu('courses');
        require_once('views/admin.view.php');
    }
    public function coursePost(){
        $createCourse = new createNewValue();        
        AdminVar::activeMenu('courses');
        if($createCourse->createCourse()){
            AdminCourses::$errormsg="Datos registrados";
            require_once("views/admin.view.php");
        }else{
            AdminCourses::$errormsg=$createCourse->err;
            require_once("views/admin.view.php");
        }
    }

    public function courseActivation(){

    }
}
?>

