<?php
include_once 'modules/courses.mod.class.php';
include_once 'modules/courses.class.php';
include_once 'includes/autoloader.inc.php';
    class createNewValue{
        
        private $dataStore;
        private $mod;
        public $err;

        public function __construct(){}

        public function createCourse(){
            $this->initDataInsertion('course');
            
            if($this->dataStore->date_end <= $this->dataStore->date_start){
                $this->err = "La fecha de finalización es igual o inferior a la de inicio.";
                return false;
            }
            $name = $this->mod->getByName($this->dataStore->name);            
            if(!isset($name)){
                $this->err = "Error de conexión a la base de datos.";
                return false;
            }            
            if(count($name) > 0){
                $this->err = "El nombre del curso ya existe.";
                return false;
            }
            if($this->insertData('course')>0){
                
                return true;
            }
            $this->err = "Error en la inserción. Compruebe el tipo de los datos.";
            return false;
        }
        
        public function createTeacher(){
            $this->initDataInsertion('teacher');
            $email = $this->mod->getByEmail($this->dataStore->email);
            $nif = $this->mod->getByNIF($this->dataStore->nif);
            if(!(isset($email)&&isset($nif))){
                $this->err = "Error de conexión a la base de datos.";
                return false;
            }            
            if(count($email) > 0){
                $this->err = "El email ya existe en la base de datos.";
                return false;
            }
            if(count($nif) > 0){
                $this->err = "El NIF ya existe en la base de datos.";
                return false;
            }
            if($this->insertData('teacher')>0){
                return true;
            }
            $this->err = "Error en la inserción. Compruebe el tipo de los datos.";
            return false;
        }

        private function insertData($type){
            switch($type){
                case 'teacher':
                    return $res=$this->mod->insertValues($this->dataStore->name,$this->dataStore->surname, $this->dataStore->telephone, $this->dataStore->nif, $this->dataStore->email);
                case 'course':
                    //insertValues($name, $description, $date_start, $date_end, $active)
                    return $res=$this->mod->insertValues($this->dataStore->name, $this->dataStore->description,$this->dataStore->date_start, $this->dataStore->date_end,$this->dataStore->active);
            }
        }
        private function initDataInsertion($type){
            switch($type){
                case 'teacher':
                    $this->mod = new TeachersMod();
                    $this->dataStore = new Teacher();
                    $this->dataStore->email = $_POST['email'];
                    $this->dataStore->name = $_POST['name'];
                    $this->dataStore->surname=$_POST['surname'];
                    $this->dataStore->telephone=$_POST['telephone'];
                    $this->dataStore->nif=$_POST['nif'];
                break;
                case 'course':
                    $this->mod = new CoursesMod();
                    $this->dataStore = new Course();
                    if(isset($_POST['active'])){
                        $this->dataStore->active = $_POST['active'];
                    }else{
                        $this->dataStore->active = 1;
                    }
                    $this->dataStore->date_start = $_POST['date_start'];
                    $this->dataStore->date_end = $_POST['date_end'];
                    $this->dataStore->email = $_POST['date_start'];
                    $this->dataStore->description = $_POST['description'];
                    $this->dataStore->name = $_POST['name'];
                break;
            }
        }
    }
?>