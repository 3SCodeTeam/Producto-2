<?php
include_once 'includes/autoloader.inc.php';
class ClassesMod{
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
    public function getByAttribute($col, $val) {
        $sql = $this->conn->prepare('SELECT COUNT(id_class), id_class, id_teacher, id_course, id_schedule, name, color FROM class WHERE ? = ?');
        $sql->bind_param('ss', $col, $val);        
        $sql->execute();
        $res = $this->transformData($sql);
        $sql->close();
        return $res;
    }
    public function getByAttributes($col1, $col2, $val1, $val2, string $operator) {
        $sql = $this->conn->prepare('SELECT COUNT(id_class), id_class, id_teacher, id_course, id_schedule, name, color FROM class WHERE ? = ? ? ? = ?');
        $sql->bind_param('sssss', $col1, $val1, $operator, $col2, $val2);        
        $sql->execute();
        $res = $this->transformData($sql);
        $sql->close();
        return $res;
    }

    public function getById(int $id){
        return $this->getByAttribute('id_class',$id);
    }
    public function getByScheduleId(int $id_schedule){
        return $this->getByAttribute('id_schedule',$id_schedule);
    }
    public function getByCourseId($id_course){
        return $this->getByAttribute('id_course',$id_course);
    }
    public function getByTecherId($id_techer){
        return $this->getByAttribute('id_teacher',$id_teacher);
    }
    public function getByName($name){
        return $this->getByAttribute('name',$name);
    }
    public function getByColor($color){
        return $this->getByAttribute('color',$color);
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