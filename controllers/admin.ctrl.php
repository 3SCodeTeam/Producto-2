<?php
include_once 'includes/autoloader.inc.php';
include_once 'views/admin.var.php';
include_once 'templates/admin.teachers.var.php';
include_once 'modules/teachers.mod.class.php';
include_once 'modules/teacher.admin.class.php';

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
        $createTeacher = new TeacherAdd();        
        If($createTeacher->createTeacher()){
            AdminVar::activeMenu('teacher');
            AdminTeachers::$errormsg="Datos registrados.";            
            require_once("views/admin.view.php");
        }else{            
            AdminVar::activeMenu('teacher');            
            AdminTeachers::$errormsg=$createTeacher->err;            
            require_once("views/admin.view.php");
        }
    }
}
?>

