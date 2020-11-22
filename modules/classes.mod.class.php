<?php
class Classes extends DBqueries{
    private $conn;
    
    public function __construct(){
        parent::__construct('class');
        $dbconnection = new DBconnection();        
        $this->conn = $dbconnection->dbconn();
    }

    public function getAll(){        
        $sql = 'SELECT * FROM class';
        $result = $this->conn->query($sql);
        return $result;
    }

    /*Select Data With PDO (+ Prepared Statements)
        i - integer
        d - double
        s - string
        b - BLOB
    */

    //SELECT

    public function getById(int $id){
        $sql = $this->conn->prepare('SELECT * FROM class WHERE id_class = ?');
        $sql->bind_param('i', $id);
        $sql->close();
        $result = $sql->execute();
        return $result;
    }
    public function getByScheduleId(int $id_schedule){
        $sql = $this->conn->prepare('SELECT * FROM class WHERE id_schedule = ?');
        $sql->bind_param('i', $id_schedule);
        $sql->close();
        $result = $sql->execute();
        return $result;
    }

    public function getByCourseId($id_course){
        $sql = $this->conn->prepare('SELECT * FROM class WHERE id_course = ?');
        $result = $sql->bind_param('s', $id_course);
        $sql->close();
        $result = $sql->execute();
        return $result;
    }

    public function getByTecherId($id_techer){
        $sql = $this->conn->prepare('SELECT * FROM class WHERE id_teacher = ?');
        $result = $sql->bind_param('s', $id_techer);
        $sql->close();
        $result = $sql->execute();        
        return $result;
    }

    public function checkPassMatch($username, $hash){
        $sql = $this->conn->prepare('SELECT * FROM class WHERE username = ? and pass = ?');
        $result = $sql->bind_param('ss', $username, $hash);
        $sql->close();
        return $result->affected_rows;
    }

    //INSERT
    public function insertValues($id_techer, $id_course, $id_schedule, $name, $color)
    {
        $sql = $his->conn->prepare('INSERT INTO class (email, name, nif, pass username, telephone, username) VALUES (?,?,?,?,?,?,?)');
        $result = $sql->bind_param('sssss', $id_techer, $id_course, $id_schedule, $name, $color);
        $sql->close();
        return $result->affected_rows;
    }

    // ATENCIÓN: ESTOS MÉTODOS A LO MEJOR LOS PASAMOS A DBqueries.class.php POR QUE SON COMUNES A TODAS LAS TABLAS.
    //UPDATE int $mysqli->affected_rows;

    public function updateValueById($attribute, $new_value, $id){
        $sql = $his->conn->prepare('UPDATE class SET ? = ? WHERE id = ?');
        $result = $sql->bind_param('ssss', $attribute, $new_value, $id);
        $sql->close();
        return $result->affected_rows;
    }

    //DELETE int $mysqli->affected_rows;
    public function deleteById($id){
        $sql = $his->conn->prepare("DELETE FROM class WHERE id_class = ?");
        $result = $sql->bind_param('s', $id);
        $sql->close();
        return $result->affected_rows;
    }


}

?>