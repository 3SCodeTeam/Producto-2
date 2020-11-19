<?php
class Enrollment extends DBqueries{
    private $conn;

    public function __construct(){
        parent::__construct("enrollment");
        $dbconnection = new DBconnection();        
        $this->conn = $dbconnection->dbconn();
    }

    public function getById(int $id){
        $sql = $this->conn->prepare("SELECT * FROM enrollment WHERE id_enrollment = ?");
        $sql->bind_param("i", $id);
        $sql->close();
        $result = $sql->execute();
        return $result;
    }

    public function getByStudentId($id_student){
        $sql = $this->conn->prepare("SELECT * FROM enrollment WHERE id_student = ?");
        $result = $sql->bind_param("s", $id_student);
        $sql->close();
        $result = $sql->execute();
        return $result;
    }

    public function getByCourseId($id_course){
        $sql = $this->conn->prepare("SELECT * FROM enrollment WHERE id_course = ?");
        $result = $sql->bind_param("s", $id_course);
        $sql->close();
        $result = $sql->execute();        
        return $result;
    }

    public function getByStatusId($status){
        $sql = $this->conn->prepare("SELECT * FROM enrollment WHERE status = ?");
        $result = $sql->bind_param("s", $status);
        $sql->close();
        $result = $sql->execute();        
        return $result;
    }

    public function getStudentsByCurseIdAndStatus($course_id, $status){
        $sql = $this->conn->prepare("SELECT * FROM enrollment WHERE id_course = ? and status = ?");
        $result = $sql->bind_param("ss", $course_id, $status);
        $sql->close();
        $result = $sql->execute();        
        return $result;
    }
    

    //INSERT
    public function insertValues($id_student, $id_course, $status)
    {
        $sql = $his->conn->prepare("INSERT INTO enrollment (id_student, id_course, status) VALUES (?,?,?)");
        $result = $sql->bind_param("sss", $id_student, $id_course, $status);
        $sql->close();
        return $result->affected_rows;
    }
    
    public function updateValueById($attribute, $new_value, $id){
        $sql = $his->conn->prepare("UPDATE enrollment SET ? = ? WHERE id = ?");
        $result = $sql->bind_param("ssss", $attribute, $new_value, $id);
        $sql->close();
        return $result->affected_rows;
    }

    public function updateStatusByStudentAndCourse($status, $id_student, $id_course){
        $sql = $his->conn->prepare("UPDATE enrollment SET status = ? WHERE id_student = ? AND id_course = ?");
        $result = $sql->bind_param("sss", $status, $id_student, $id_course);
        $sql->close();
        return $result->affected_rows;
    }

    //DELETE int $mysqli->affected_rows;
    public function deleteById($id_enrollment){
        $sql = $his->conn->prepare("DELETE FROM enrollment WHERE id_enrollment = ?");
        $result = $sql->bind_param("s", $id_enrollment);
        $sql->close();
        return $result->affected_rows;
    }

}
?>