<?php
include_once 'includes/autoloader.inc.php';

class Students extends DBqueries{
    
    private $conn;

    public function __construct(){
        
        parent::__construct('students');        
        $dbconnection = new DBconnection();
        $this->conn = $dbconnection->dbconn();        
        
    }
    Function transformData($res){                
        if(isset($res) && $res!='err'){
            $numRows= $res->num_rows;            
        }else{
            $numRows = 0;
        }
        if($numRows > 0){
            while($row = $res -> fetch_assoc()){
                $user = new Student();
                $user->id = $row['id'];
                $user->date_registred = $row['date_registered'];                
                $user->email = $row['email'];
                $user->id = $row['name'];
                $user->name = $row['nif'];
                $user->nif = $row['nif'];
                $user->pass = $row['pass'];
                $user->surname = $row['surname'];
                $user->telephone = $row['telephone'];
                $user->username = $row['username'];
                $data[] = $user;
                
            }
            return $data;
        }        
        return $numRows;
    }

    public function getAll(){        
        $sql = 'SELECT * FROM students ORDER BY id';
        $result = $this->conn->query($sql);
        return $this->transformData($result);
    }    

    /*Select Data With PDO (+ Prepared Statements)
        i - integer
        d - double
        s - string
        b - BLOB
    */ 

    public function getById(int $id){
        $sql = $this->conn->prepare('SELECT * FROM students WHERE id = ?');
        $sql->bind_param('i', $id);        
        $result = $sql->execute();
        $sql->close();
        return $result;
    }

    public function getByUsername($username){
        $sql = $this->conn->prepare("SELECT * FROM students WHERE username = ?");
        if($sql->bind_param('s', $username)){
            $sql->execute();
            echo($sql->num_rows.' '.$username);
            $result = $this->transformData($sql);            
        }else{            
            $result = 'err';
        }
        $sql->close();
        return $result;
    }

    public function getByEmail($email){
        $sql = $this->conn->prepare('SELECT * FROM students WHERE email = ?');
        $result = $sql->bind_param('s', $id);        
            
        $sql->close();
        return $result;
    }

    public function checkPassMatch($username, $hash){
        $sql = $this->conn->prepare('SELECT * FROM students WHERE username = ? and pass = ?');
        $result = $sql->bind_param('ss', $username, $hash);
        $result = $sql->execute();
        $sql->close();
        return $result->affected_rows;
    }

    //INSERT
    public function insertValues($date_registered, $email, $name, $nif, $pass, $surname, $telephone, $username){
        $sql = $this->conn->prepare("INSERT INTO students (date_registered, email, name, nif, pass, surname, telephone, username) VALUES (?,?,?,?,?,?,?,?)");
        try{
            $sql->bind_param("ssssssss", $date_registered, $email, $name, $nif, $pass, $surname, $telephone, $username);
            $result = $sql->execute();
        }catch(Exception $e)
        {
            echo($e->getMessage());
        }finally{
            $sql->close();
            return $this->transformData($result);
        }
    }
    
    public function updateValueById($attribute, $new_value, $id){
        $sql = $his->conn->prepare('UPDATE students SET ? = ? WHERE id = ?');
        $result = $sql->bind_param('ssss', $attribute, $new_value, $id);
        $result = $sql->execute();
        $sql->close();
        return $result->affected_rows;
    }

    //DELETE int $mysqli->affected_rows;
    public function deleteById($id){
        $sql = $his->conn->prepare('DELETE FROM students WHERE id = ?');
        $result = $sql->bind_param('s', $id);
        $result = $sql->execute();
        $sql->close();
        return $result->affected_rows;
    }
}    
?>