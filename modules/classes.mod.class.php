<?php
class Classes extends DBconnection{
    private $conn;
    
    public function __construct(){
        parent::__construct();
        $this->con = parent::dbconn();
        /*$this->conn = $dbconnection->dbconn();*/
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
        $sql = 'SELECT COUNT(id_class), id_class, id_teacher, id_course, id_schedule, name, color FROM class';
        $res = $this->conn->query($sql);
        return transformData($res);
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
        $sql->close();
        $res = $sql->execute();
        return transformData($res);
    }
    public function getByScheduleId(int $id_schedule){
        $sql = $this->conn->prepare('SELECT COUNT(id_class), id_class, id_teacher, id_course, id_schedule, name, color FROM class WHERE id_schedule = ?');
        $sql->bind_param('i', $id_schedule);        
        $res = $sql->execute();
        $sql->close();        
        return transformData($res);
    }

    public function getByCourseId($id_course){
        $sql = $this->conn->prepare('SELECT COUNT(id_class), id_class, id_teacher, id_course, id_schedule, name, color FROM class WHERE id_course = ?');
        $res = $sql->bind_param('s', $id_course);
        $res = $sql->execute();
        $sql->close();        
        return transformData($res);
    }

    public function getByTecherId($id_techer){
        $sql = $this->conn->prepare('SELECT COUNT(id_class), id_class, id_teacher, id_course, id_schedule, name, color FROM class WHERE id_teacher = ?');
        $res = $sql->bind_param('s', $id_techer);        
        $res = $sql->execute();
        $sql->close();
        return transformData($res);
    }

    public function checkPassMatch($username, $hash){
        $sql = $this->conn->prepare('SELECT COUNT(id_class), id_class, id_teacher, id_course, id_schedule, name, color FROM class WHERE username = ? and pass = ?');
        $res = $sql->bind_param('ss', $username, $hash);        
        $res = $sql->execute();
        $sql->close();
        return transformData($res);
    }

    //INSERT
    public function insertValues($id_techer, $id_course, $id_schedule, $name, $color)
    {
        $sql = $his->conn->prepare('INSERT INTO class (id_teacher, id_course, id_schedule, name, color) VALUES (?,?,?,?,?)');
        $res = $sql->bind_param('sssss', $id_techer, $id_course, $id_schedule, $name, $color);
        $sql->close();
        return $res->affected_rows;
    }

    // ATENCIÓN: ESTOS MÉTODOS A LO MEJOR LOS PASAMOS A DBqueries.class.php POR QUE SON COMUNES A TODAS LAS TABLAS.
    //UPDATE int $mysqli->affected_rows;

    public function updateValueById($attribute, $new_value, $id){
        $sql = $his->conn->prepare('UPDATE class SET ? = ? WHERE id = ?');
        $res = $sql->bind_param('sss', $attribute, $new_value, $id);
        $sql->close();
        return $res->affected_rows;
    }

    //DELETE int $mysqli->affected_rows;
    public function deleteById($id){
        $sql = $his->conn->prepare("DELETE FROM class WHERE id_class = ?");
        $res = $sql->bind_param('s', $id);
        $sql->close();
        return $res->affected_rows;
    }
}

?>