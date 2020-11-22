<?php
include_once 'includes/autoloader.inc.php';
class TeachersMod{
    private $conn;
    
    public function __construct(){
        //parent::__construct();
        //$this->con = parent::dbconn();
        $dbconnection = new DBconnection();
        $this->conn = $dbconnection->dbconn();
    }

    function transformData($res){          
        $data=[];        
        //SELECT COUNT(id_teacher), id_teacher, name, surname, telephone, nif, email FROM teachers
        //Ajustar las variables al orden.
        $res->bind_result(
            $count,
            $id,
            $name,
            $surname,
            $telephone,
            $nif,
            $email,
        );
        while($res->fetch()){
            if($count ==0){return 0;} //Si devuelve 0, no hay datos. row_num de mysqli no siempre devuelve valor.
            $user = new Teacher();
            $user->count=$count;
            $user->id_teacher = $id;            
            $user->name=$name;
            $user->surname=$surname;            
            $user->telephone=$telephone;
            $user->nif=$nif;
            $user->email=$email;
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
        $sql = $this->conn->prepare('SELECT COUNT(id_teacher), id_teacher, name, surname, telephone, nif, email FROM teachers');
        $sql->execute();
        $res = $this->transformData($sql);
        $sql->close();
        return $res;
    }

    public function getByAttribute($col, $val) {
        $sql = $this->conn->prepare('SELECT COUNT(id_teacher), id_teacher, name, surname, telephone, nif, email FROM teachers WHERE ? = ?');
        $sql->bind_param('ss', $col, $val);        
        $sql->execute();
        $res = $this->transformData($sql);
        $sql->close();
        return $res;
    }

    public function getByAttributes($col1, $col2, $val1, $val2, string $operator) {
        $sql = $this->conn->prepare('SELECT COUNT(id_teacher), id_teacher, name, surname, telephone, nif, email FROM teachers WHERE ? = ? ? ? = ?');
        $sql->bind_param('sssss', $col1, $val1, $operator, $col2, $val2);        
        $sql->execute();
        $res = $this->transformData($sql);
        $sql->close();
        return $res;
    }    

    //SELECT BY ATTRIBUTE

    public function getById(int $id){
        $this->getByAttribute('id_teacher',$id);
    }

    public function getByEmail(int $email){
        $this->getByAttribute('email',$email);
    }

    public function getByNIF($nif){
        $this->getByAttribute('nif',$nif);
    }    

    //INSERT
    public function insertValues($name, $surname, $telephone, $nif, $email)
    {
        $sql = $his->conn->prepare('INSERT INTO class (name, surname, telephone, nif, email) VALUES (?,?,?,?,?)');
        $sql->bind_param('sssss', $name, $surname, $telephone, $nif, $email);
        $sql->execute();
        $res->$sql->affected_rows;
        $sql->close();
        return $res;
    }

    //UPDATE

    public function updateValueById($attribute, $new_value, $id){
        $sql = $his->conn->prepare('UPDATE teachers SET ? = ? WHERE id_teacher = ?');
        $sql->bind_param('sss', $attribute, $new_value, $id);
        $sql->execute();
        $res->$sql->affected_rows;
        $sql->close();
        return $res;
    }

    //DELETE int $mysqli->affected_rows;
    public function deleteById($id){
        $sql = $his->conn->prepare("DELETE FROM class WHERE id_teacher = ?");
        $sql->bind_param('s', $id);
        $sql->execute();
        $res->$sql->affected_rows;
        $sql->close();
        return $res;
    }
}

?>