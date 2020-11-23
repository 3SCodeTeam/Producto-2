<?php
include_once 'includes/autoloader.inc.php';
class CoursesMod{
    private $conn;
    
    public function __construct(){
        //parent::__construct();
        //$this->con = parent::dbconn();
        $dbconnection = new DBconnection();
        $this->conn = $dbconnection->dbconn();
    }

    function transformData($res){          
        $data=[];        
        //SELECT COUNT(id_course), id_course, name, description, date_start, date_end, active FROM courses
        //Ajustar las variables al orden.
        $res->bind_result(
            $count,
            $id,
            $name,
            $description,
            $date_start,
            $date_end,
            $active,
        );
        while($res->fetch()){
            if($count ==0){return 0;} //Si devuelve 0, no hay datos. row_num de mysqli no siempre devuelve valor.  
            $user = new Course();
            $user->count=$count;
            $user->id_course = $id;            
            $user->name=$name;
            $user->description=$description;
            $user->date_start=$date_start;
            $user->date_end=$date_end;
            $user->active=$active;
            $data[] = $user;
            
        }        
        return $data;
    }
    
    /*Select Data With PDO (+ Prepared Statements)
        i - integer
        d - double
        s - string
        b - BLOB
    */

    //SELECT
    public function getAll(){        
        $sql = $this->conn->prepare('SELECT COUNT(id_course), id_course, name, description, date_start, date_end, active FROM courses');
        $sql->execute();
        $res = $this->transformData($sql);
        $sql->close();
        return $res;
    }

    public function getByAttribute($col, $val) {
        $sql = 'SELECT COUNT(id_course), id_course, name, description, date_start, date_end, active FROM courses WHERE '.$col.' = ?';        
        $sql = $this->conn->prepare($sql);
        $sql->bind_param('s', $val);        
        $sql->execute();        
        $res = $this->transformData($sql);        
        $sql->close();
        return $res;
    }

    public function getByAttributes($col1, $col2, $val1, $val2, string $operator) {
        $sql = $this->conn->prepare('SELECT COUNT(id_course), id_course, name, description, date_start, date_end, active FROM courses WHERE ? = ? ? ? = ?');
        $sql->bind_param('sssss', $col1, $val1, $operator, $col2, $val2);        
        $sql->execute();
        $res = $this->transformData($sql);
        $sql->close();
        return $res;
    }    

    //SELECT BY ATTRIBUTE

    public function getById( $value){
        return $this->getByAttribute('id_course',$value);        
    }
    public function getByName($value){
        return $this->getByAttribute('name',$value);                
    }
    public function getByStatus(int $active){
        return $this->getByAttribute('active',$active);
    }
    public function getByDateStart(strin $date){
        return $this->getByAttribute('date_start',$date);
    }
    public function getByDateEnd(string $date){
        return $this->getByAttribute('date_start',$date);
    }    

    //INSERT
    public function insertValues(string $name, string $description, string $date_start, string $date_end, int $active)
    {
        $sql = $this->conn->prepare('INSERT INTO courses (name, description, date_start, date_end, active) VALUES (?,?,?,?,?)');
        $sql->bind_param('ssssi', $name, $description, $date_start, $date_end, $active);
        $sql->execute();
        $res=$sql->affected_rows;
        $sql->close();
        return $res;
    }

    //UPDATE

    public function updateValueById($attribute, $new_value, $id){
        $sql = $this->conn->prepare('UPDATE courses SET ? = ? WHERE id_course = ?');
        $sql->bind_param('sss', $attribute, $new_value, $id);
        $sql->execute();
        $res=$sql->affected_rows;
        $sql->close();
        return $res;
    }

    //DELETE int $mysqli->affected_rows;
    public function deleteById($id){
        $sql = $this->conn->prepare("DELETE FROM courses WHERE id_course = ?");
        $sql->bind_param('s', $id);
        $sql->execute();
        $res=$sql->affected_rows;
        $sql->close();
        return $res;
    }
}

?>