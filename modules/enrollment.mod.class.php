<?php
include_once 'includes/autoloader.inc.php';
class EnrollmentMod{
    protected $conn;

    public function __construct(){        
        //parent::__construct();
        //$this->con = parent::dbconn();
        $dbconnection = new DBconnection();
        $this->conn = $dbconnection->dbconn();
    }

    function transformData($res){          
        $data=[];
        //SELECT id_enrollment, id_student, id_course, status FROM enrollment
        //Ajustar las variables al orden.
        $res->bind_result(
            $id,
            $id_student,
            $id_course,
            $status,          
        );
        while($res->fetch()){            
            $item = new Enrollment();
            $item->id_enrollment = $id;            
            $item->id_student=$id_student;
            $item->id_course=$id_course;            
            $item->status=$status;
            $data[] = $item;            
        }        
        return $data;
    }

    public function getAll() {
        $sql = $this->conn->prepare('SELECT id_enrollment, id_student, id_course, status FROM enrollment');        
        $sql->execute();
        $res = $this->transformData($sql);
        $sql->close();
        return $res;
    }

    public function getById(int $id){
        $sql = $this->conn->prepare("SELECT id_enrollment, id_student, id_course, status FROM enrollment WHERE id_enrollment = ?");
        $sql->bind_param("i", $id);        
        $sql->execute();
        $res = $this->transformData($sql);
        $sql->close();
        return $res;
    }

    public function getByStudentId($id_student){
        $sql = $this->conn->prepare("SELECT id_enrollment, id_student, id_course, status FROM enrollment WHERE id_student = ?");        
        $sql->bind_param("s", $id_student);        
        $sql->execute();
        $res = $this->transformData($sql);
        $sql->close();
        return $res;
    }

    public function getByCourseId($id_course){
        $sql = $this->conn->prepare("SELECT id_enrollment, id_student, id_course, status FROM enrollment WHERE id_course = ?");
        $sql->bind_param("s", $id_course);
        $sql->execute();
        $res = $this->transformData($sql);
        $sql->close();
        return $res;
    }

    public function getByStatusId($status){
        $sql = $this->conn->prepare("SELECT id_enrollment, id_student, id_course, status FROM enrollment WHERE status = ?");
        $sql->bind_param("s", $status);        
        $sql->execute();
        $res = $this->transformData($sql);
        $sql->close();
        return $res;
    }

    public function getStudentsByCurseIdAndStatus($course_id, $status){
        $sql = $this->conn->prepare("SELECT id_enrollment, id_student, id_course, status FROM enrollment WHERE id_course = ? and status = ?");
        $sql->bind_param("ss", $course_id, $status);
        $sql->execute();
        $res = $this->transformData($sql);
        $sql->close();
        return $res;
    }
    

    //INSERT
    public function insertValues($id_student, $id_course, $status)
    {
        $sql = $this->conn->prepare("INSERT INTO enrollment (id_student, id_course, status) VALUES (?,?,?)");
        $sql->bind_param("sss", $id_student, $id_course, $status);
        $sql->execute();
        $res=$sql->affected_rows;
        $sql->close();
        return $res;
    }
    
    public function updateValueById($attribute, $new_value, $id){
        $sql = $this->conn->prepare("UPDATE enrollment SET '.$attribute.' = ? WHERE id = ?");
        $sql->bind_param("ss", $new_value, $id);
        $sql->execute();
        $res=$sql->affected_rows;
        $sql->close();
        return $res;
    }

    public function updateStatusByStudentAndCourse($status, $id_student, $id_course){
        $sql = $this->conn->prepare("UPDATE enrollment SET status = ? WHERE id_student = ? AND id_course = ?");
        $sql->bind_param("sss", $status, $id_student, $id_course);
        $sql->execute();
        $res=$sql->affected_rows;
        $sql->close();
        return $res;
    }

    //DELETE int $mysqli->affected_rows;
    public function deleteById($id_enrollment){
        $sql = $this->conn->prepare("DELETE FROM enrollment WHERE id_enrollment = ?");
        $sql->bind_param("s", $id_enrollment);
        $sql->execute();
        $res=$sql->affected_rows;
        $sql->close();
        return $res;
    }
}
?>