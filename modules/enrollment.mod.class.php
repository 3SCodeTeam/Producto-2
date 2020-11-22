<?php
class Enrollment extends DBconnection{
    private $conn;

    public function __construct(){        
        parent::__construct();
        $this->con = parent::dbconn();
        /*$dbconnection = new DBconnection();
        $this->conn = $dbconnection->dbconn();*/
    }

    function transformData($res){          
        $data=[];        
        //SELECT COUNT(id_enrollment), id_enrollment, id_student, id_course, status FROM enrollment
        //Ajustar las variables al orden.
        $res->bind_result(
            $count,
            $id,
            $id_student,
            $id_course,
            $status,          
        );
        while($res->fetch()){
            if($count ==0){return 0;} //Si devuelve 0, no hay datos. row_num de mysqli no siempre devuelve valor.
            $user = new Enrollment();
            $user->count=$count;
            $user->id_enrollment = $id;            
            $user->id_student=$id_student;
            $user->id_course=$id_course;            
            $user->status=$status;
            $data[] = $user;            
        }        
        return $data;
    }

    public function getById(int $id){
        $sql = $this->conn->prepare("SELECT COUNT(id_enrollment), id_enrollment, id_student, id_course, status FROM enrollment WHERE id_enrollment = ?");
        $sql->bind_param("i", $id);        
        $res = $sql->execute();
        $sql->close();
        return $this->transformData($res);
    }

    public function getByStudentId($id_student){
        $sql = $this->conn->prepare("SELECT COUNT(id_enrollment), id_enrollment, id_student, id_course, status FROM enrollment WHERE id_student = ?");
        $res = $sql->bind_param("s", $id_student);
        $res = $sql->execute();
        $sql->close();
        return $this->transformData($res);
    }

    public function getByCourseId($id_course){
        $sql = $this->conn->prepare("SELECT COUNT(id_enrollment), id_enrollment, id_student, id_course, status FROM enrollment WHERE id_course = ?");
        $res = $sql->bind_param("s", $id_course);
        $res = $sql->execute();
        $sql->close();
        return $this->transformData($res);
    }

    public function getByStatusId($status){
        $sql = $this->conn->prepare("SELECT COUNT(id_enrollment), id_enrollment, id_student, id_course, status FROM enrollment WHERE status = ?");
        $res = $sql->bind_param("s", $status);
        $res = $sql->execute();
        $sql->close();
        return $this->transformData($res);
    }

    public function getStudentsByCurseIdAndStatus($course_id, $status){
        $sql = $this->conn->prepare("SELECT COUNT(id_enrollment), id_enrollment, id_student, id_course, status FROM enrollment WHERE id_course = ? and status = ?");
        $res = $sql->bind_param("ss", $course_id, $status);
        $res = $sql->execute();
        $sql->close();
        return $this->transformData($res);
    }
    

    //INSERT
    public function insertValues($id_student, $id_course, $status)
    {
        $sql = $his->conn->prepare("INSERT INTO enrollment (id_student, id_course, status) VALUES (?,?,?)");
        $res = $sql->bind_param("sss", $id_student, $id_course, $status);
        $sql->close();
        return $res->affected_rows;
    }
    
    public function updateValueById($attribute, $new_value, $id){
        $sql = $his->conn->prepare("UPDATE enrollment SET ? = ? WHERE id = ?");
        $res = $sql->bind_param("sss", $attribute, $new_value, $id);
        $sql->close();
        return $res->affected_rows;
    }

    public function updateStatusByStudentAndCourse($status, $id_student, $id_course){
        $sql = $his->conn->prepare("UPDATE enrollment SET status = ? WHERE id_student = ? AND id_course = ?");
        $res = $sql->bind_param("sss", $status, $id_student, $id_course);
        $sql->close();
        return $res->affected_rows;
    }

    //DELETE int $mysqli->affected_rows;
    public function deleteById($id_enrollment){
        $sql = $his->conn->prepare("DELETE FROM enrollment WHERE id_enrollment = ?");
        $res = $sql->bind_param("s", $id_enrollment);
        $sql->close();
        return $res->affected_rows;
    }
}
?>