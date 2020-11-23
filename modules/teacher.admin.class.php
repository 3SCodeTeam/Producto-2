<?php
    class TeacherAdd extends Teacher{
        
        private Teacher $teacher;
        private TeachersMod $mod;
        public $err;

        public function __construct(){
            $this->mod = new TeachersMod();
            $this->teacher = new Teacher();
            $this->teacher->email = $_POST['email'];
            $this->teacher->name = $_POST['name'];
            $this->teacher->surname=$_POST['surname'];
            $this->teacher->telephone=$_POST['telephone'];
            $this->teacher->nif=$_POST['nif'];
        }
        
        public function createTeacher(){
            $email = $this->mod->getByEmail($this->teacher->email);
            $nif = $this->mod->getByNIF($this->teacher->nif);
            if(!(isset($email)&&isset($nif))){
                $this->err = "Error de conexión a la base de datos.";
                return false;
            }
            if(!($email == 0)){
                $this->err = "El email ya existe en la base de datos.";
                return false;
            }
            if(!($nif == 0)){
                $this->err = "El NIF ya existe en la base de datos.";
                return false;
            }
            if($this->insertData()>0){
                return true;
            }
            $this->err = "Error en la inserción. Compruebe el tipo de los datos.";
            return false;
        }
        private function insertData(){
            
            //insertValues($name, $surname, $telephone, $nif, $email)
            $res=$this->mod->insertValues($this->teacher->name,$this->teacher->surname, $this->teacher->telephone, $this->teacher->nif, $this->teacher->email);
            return $res;
        }
    }
?>