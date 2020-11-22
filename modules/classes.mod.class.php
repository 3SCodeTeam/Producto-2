<?php
include_once 'includes/autoloader.inc.php';
class Classes{
    private $conn;
    
    public function __construct(){
        //parent::__construct();
        //$this->con = parent::dbconn();
        $dbconnection = new DBconnection();
        $this->conn = $dbconnection->dbconn();
    }

    function transformData($res){          
        $data=[];        
        //SELECT COUNT(id_class), id_class, id_teacher, id_course, id_schedule, name, color FROM class
        //Ajustar las variables al orden.
        $res->bind_result(
            $count,
            $id,
            $id_teacher,
            $id_course,
            $id_schedule,
            $name,
            $color,
        );
        while($res->fetch()){
            if($count ==0){return 0;} //Si devuelve 0, no hay datos. row_num de mysqli no siempre devuelve valor.
            $user = new Classes();
            $user->count=$count;
            $user->id_class = $id;            
            $user->id_teacher=$id_teacher;
            $user->id_course=$id_course;            
            $user->id_schedule=$id_schedule;
            $user->name=$name;
            $user->color=$color;
            $data[] = $user;            
        }        
        return $data;
    }

    public function getAll(){        
        $sql = $this->conn->prepare('SELECT COUNT(id_class), id_class, id_teacher, id_course, id_schedule, name, color FROM class');
        $sql->execute();
        $res = $this->transformData($sql);
        $sql->close();
        return $res;
    }

    /*Select Data With PDO (+ Prepared Statements)
        i - integer
        d - double
        s - string
        b - BLOB
    */

    //SELECT

    public function getById(int $id){
        $sql = $this->conn->prepare('SELECT COUNT(id_class), id_class, id_teacher, id_course, id_schedule, name, color FROM class WHERE id_class = ?');
        $sql->bind_param('i', $id);        
        $sql->execute();
        $res = $this->transformData($sql);
        $sql->close();
        return $res;
    }
    public function getByScheduleId(int $id_schedule){
        $sql = $this->conn->prepare('SELECT COUNT(id_class), id_class, id_teacher, id_course, id_schedule, name, color FROM class WHERE id_schedule = ?');
        $sql->bind_param('i', $id_schedule);        
        $sql->execute();
        $res = $this->transformData($sql);
        $sql->close();
        return $res;
    }

    public function getByCourseId($id_course){
        $sql = $this->conn->prepare('SELECT COUNT(id_class), id_class, id_teacher, id_course, id_schedule, name, color FROM class WHERE id_course = ?');
        $sql->bind_param('s', $id_course);
        $sql->execute();
        $res = $this->transformData($sql);
        $sql->close();
        return $res;
    }

    public function getByTecherId($id_techer){
        $sql = $this->conn->prepare('SELECT COUNT(id_class), id_class, id_teacher, id_course, id_schedule, name, color FROM class WHERE id_teacher = ?');
        $sql->bind_param('s', $id_techer);        
        $sql->execute();
        $res = $this->transformData($sql);
        $sql->close();
        return $res;
    }

    public function checkPassMatch($username, $hash){
        $sql = $this->conn->prepare('SELECT COUNT(id_class), id_class, id_teacher, id_course, id_schedule, name, color FROM class WHERE username = ? and pass = ?');
        $sql->bind_param('ss', $username, $hash);        
        $sql->execute();
        $res = $this->transformData($sql);
        $sql->close();
        return $res;
    }

    //INSERT
    public function insertValues($id_techer, $id_course, $id_schedule, $name, $color)
    {
        $sql = $his->conn->prepare('INSERT INTO class (id_teacher, id_course, id_schedule, name, color) VALUES (?,?,?,?,?)');
        $sql->bind_param('sssss', $id_techer, $id_course, $id_schedule, $name, $color);
        $sql->execute();
        $res->$sql->affected_rows;
        $sql->close();
        return $res;
    }

    // ATENCIÓN: ESTOS MÉTODOS A LO MEJOR LOS PASAMOS A DBqueries.class.php POR QUE SON COMUNES A TODAS LAS TABLAS.
    //UPDATE int $mysqli->affected_rows;

    public function updateValueById($attribute, $new_value, $id){
        $sql = $his->conn->prepare('UPDATE class SET ? = ? WHERE id = ?');
        $sql->bind_param('sss', $attribute, $new_value, $id);
        $sql->execute();
        $res->$sql->affected_rows;
        $sql->close();
        return $res;
    }

    //DELETE int $mysqli->affected_rows;
    public function deleteById($id){
        $sql = $his->conn->prepare("DELETE FROM class WHERE id_class = ?");
        $sql->bind_param('s', $id);
        $sql->execute();
        $res->$sql->affected_rows;
        $sql->close();
        return $res;
    }
}

?>