<?php

include_once 'includes/autoloader.inc.php';
include_once 'views/admin.var.php';
include_once 'templates/admin/admin.teachers.var.php';
include_once 'templates/admin/admin.menu.var.php';
include_once 'templates/admin/admin.courses.var.php';
include_once 'templates/admin/admin.profile.var.php';
include_once 'templates/admin/admin.classes.var.php';
include_once 'modules/teachers.mod.class.php';
include_once 'modules/createNewValues.admin.class.php';
include_once 'modules/usersAdmin.mod.class.php';
include_once 'modules/updateData.class.php';

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

    public function profile(){
        AdminMenu::$menu='profile';
        AdminVar::activeMenu('profile');        
        require_once('views/admin.view.php');
    }

    public function profilePost(){        
        $updateProfile = new updateData('admin');        
        $updateProfile->updateAdminData();
        AdminVar::activeMenu('profile');
        AdminProfile::$errormsg=$updateProfile->err;        
        require_once("views/admin.view.php");
    }

    public function classes(){
        return $this->PostClassesCall('init');
    }
    public function PostClassInit(){
        //var_dump($_POST);
        if(!($_POST['teachers'] === 'none' || !$_POST['courses']=== 'none')){
            //var_dump($_POST);
            $selectedTeacherId = $_POST['teachers'];
            $selectedCourseID = $_POST['courses'];

            $mod = new CoursesMod();
            $selectedCourse = $mod->getById($selectedCourseID);
            
            if(isset($selectedCourse[0]->id_course)){
                AdminClasses::$selectedCourseId = $selectedCourse[0]->id_course;
                AdminClasses::$selectedTeacherId = $selectedTeacherId;//OBETENER LA ID USUARIO DEL POST;
                AdminClasses::$selectedCourseEndDate=$selectedCourse[0]->date_end;//OBTENER LA FECHA DE LA DB
                AdminClasses::$selectedCourseStartDate=$selectedCourse[0]->date_start;//OBTENER LA FECHA DE LA DB
                AdminClasses::$selectedColor = $_POST['colors'];
                AdminClasses::$selectedName = $_POST['name'];
                $mod = new ClassesMod();
                AdminClasses::$selectedListOfClasses = $mod->getScheduleByTeacherAndDate($selectedTeacherId, $selectedCourse[0]->date_start, $selectedCourse[0]->date_end);
                return $this->PostClassesCall('classes');
            }else{                
                AdminClasses::$errormsg="Error de conexión con la base de datos.";
                return $this->PostClassesCall('init');
            }
        }else{            
            AdminClasses::$errormsg="No se han seleccionado valores";
            return $this->PostClassesCall('init');
        }
    }

    /**
     * ESTA FUNCIÓN TRATA EL POST AL CREAR UNA NUEVA CLASE.
    */
    public function PostClassNew(){        
        //La clase y el schedule estan relacionadas on una doble llave. Decido insertar primero Class, luego Schedule y después hacer un update de Class para insertar la llave Schedule.
        $mod = new ClassesMod();
        //INSERT INTO class (id_teacher, id_course, id_schedule, name, color)
        $res = $mod->insertValues($_POST['teacher_id'], $_POST['course_id'],"0",$_POST['name'], $_POST['color']);        
        if($res > 0){            
            //WHERE id_teacher = ? and id_course = ? and id_schedule = ? and name = ? and color = ?'
            //$class = $mod->getIdClass($_POST['teacher_id'], $_POST['course_id'],"0",$_POST['name'], $_POST['color']);            
            $class = $mod->getByScheduleId("0");
            if(count($class)>0){
                
                $id_class = $class[0]->id_class;
                $mod = new ScheduleMod();
                
                $plus1Day = new DateInterval("P1D");
                $plus1Hour = new DateInterval("PT1H");               
                $start = new DateTime($_POST['time_start']);
                $end = new DateTime($_POST['time_end']);
                $interval = $start->diff($end);
                $d = $interval->days;                
                
                for($i=0; $i<=$d; $i++){                    
                    
                    if(isset($_POST[$this->getDOWName($start)])){
                        
                        $time_start= new DateTime($_POST[$this->getDOWName($start)]);
                        $time_end = $time_start;
                        $time_end->add($plus1Hour);
                        //'INSERT INTO schedule(id_class, time_start, time_end, day)
                        $mod->insertValues($id_class, $time_start->format("H:i:s"), $time_end->format("H:i:s"), $start->format("Y-m-d"));
                        //echo($id_class.' '.$time_start->format("H:i:s").' '.$time_end->format("H:i:s").' '.$start->format("Y-m-d"));
                    }
                    $start->add($plus1Day);
                }
                $res = $mod->maxById($id_class);
                //var_dump($res);
                $mod = new ClassesMod();
                $mod->updateValueById('id_schedule', $res[0]->id_schedule, $id_class);

            }else{
                $mod->deleteByScheduleId("0");
                AdminClasses::$errormsg = "Error de acceso a la base de datos.";
            }            
        }else{
            AdminClasses::$errormsg = "Error de acceso a la base de datos.";
        }
        
        $this->classes();

    }
    public function delete(){
        AdminMenu::$menu='delete';
        AdminVar::activeMenu('delete');        
        require_once('views/admin.view.php');
    }

    private function PostClassesCall($status){
        if($status === 'init'){
            AdminMenu::$menu='classes';
            AdminVar::activeMenu('classes');
            AdminClasses::$status = 'init';
            AdminClasses::$selectedTeacherId=null;
            AdminClasses::$selectedCourseStartDate=null;
            AdminClasses::$selectedCourseEndDate=null;
            AdminClasses::$errormsg=null;
            AdminClasses::$selectedColor=null;
            AdminClasses::$selectedName=null;
            return require_once('views/admin.view.php');
        }
        AdminMenu::$menu='classes';
        AdminVar::activeMenu('classes');     
        AdminClasses::$status = 'classes';
        return require_once('views/admin.view.php');
    }
    private function getDOWName($date){        
        switch($date->format("D")){
            case 'Mon': return 'LUNES';
            case 'Tue': return 'MARTES';
            case 'Wed': return 'MIÉRCOLES';
            case 'Thu': return 'JUEVES';
            case 'Fry': return 'VIERNES';
            case 'Sat': return 'SÁBADO';
            case 'Sun': return 'DOMINGO';
        }
    }
        /*   
        DateTime();
        DateTime()->format("W"); weekNum
        DateTime()->format("Y"); year
        DateTime()->format("m"); month
        DateTime()->format("D"); day of the week

        DateTime()->sub(new DateInterval('P10D'));
        DateTime()->add(new DateInterval('P10D'));

        date("Y/m/d")
        date("Y.m.d")
        date("Y-m-d")
        date("l")
        
    */

}
?>