<?php
class enrollStudent{
    private $mod;
    private $id_course;
    private $id_student;
    
    public $err;
    public $status;


    public function __construct($id_course){
        $this->id_course=$id_course;
        $this->mod = new EnrollmentMod();        
        $this->id_student = $_SESSION['sql_user_id'];
    }

    private function checkStudentEnrollment(){
        $enrollment = $this->mod->getByStudentId($this->id_student);        
        if(count($enrollment)>0){
            $this->err = "NO PUEDES MATRICULARTE EN MÁS DE UN CURSO.";
            return false;
        }
        return true;
    }

    public function enrollStudent(){
        if($this->checkStudentEnrollment()){
            //"INSERT INTO enrollment (id_student, id_course, status) VALUES (?,?,?)"
            $res = $this->mod->InsertValues($this->id_student, $this->id_course, '1');
            if($res < 1){
                $this->err = "ERROR DE CONEXIÓN A LA BASE DE DATOS.";
                $this->status = false;
                return false;
            }else{
                $this->err = "MATRICULA REALIZADA.";
                $this->status = true;
            }
        }else{
            $this->status = false;            
        }
        return $this->status;
    }

}
?>