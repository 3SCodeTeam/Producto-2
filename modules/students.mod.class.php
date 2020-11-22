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
        $data=[];        
        //"SELECT count(id), id, date_registered, email, name, nif, pass, surname, telephone, username"
        //Ajustar las variables al orden.
        $res->bind_result(
            $count,
            $id,
            $date_registered,
            $email,            
            $name,
            $nif,        
            $pass,
            $surname,            
            $telephone,
            $username,
        );
        while($res->fetch()){
            if($count ==0){return 0;} //Si devuelve 0, no hay datos. row_num de mysqli no siempre devuelve valor.
            $user = new Student();
            $user->id = $id;
            $user->date_registered=$date_registered;
            $user->email=$email;
            $user->name=$name;
            $user->nif=$nif;
            $user->surname=$surname;
            $user->pass=$pass;            
            $user->telephone=$telephone;
            $user->username=$username;
            $data[] = $user;            
        }        
        return $data;
    }

    public function getAll(){        
        $sql = 'SELECT count(id), id, date_registered, email, name, nif, pass, surname, telephone, username  FROM students ORDER BY id';
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
        $sql = $this->conn->prepare('SELECT count(id), id, date_registered, email, name, nif, pass, surname, telephone, username  FROM students WHERE id = ?');
        $sql->bind_param('i', $id);        
        $result = $sql->execute();        
        $result = $this->transformData($sql);
        $sql->close();
        return $result;
    }

    public function getByUsername($username){
        $sql = $this->conn->prepare("SELECT count(id), id, date_registered, email, name, nif, pass, surname, telephone, username  FROM students WHERE username = ?");
        if($sql->bind_param('s', $username)){
            $sql->execute();            
            $result = $this->transformData($sql);            
        }else{            
            $result = 'err';
        }
        $sql->close();        
        return $result;
    }

    public function getByEmail($email){
        $sql = $this->conn->prepare('SELECT count(id), id, date_registered, email, name, nif, pass, surname, telephone, username  FROM students WHERE email = ?');
        $result = $sql->bind_param('s', $id);        
        $result = $sql->execute();        
        $result = $this->transformData($sql);
        $sql->close();
        return $result;
    }

    public function checkPassMatch($username, $hash){
        $sql = $this->conn->prepare('SELECT count(id), id, date_registered, email, name, nif, pass, surname, telephone, username  FROM students WHERE username = ? and pass = ?');
        $result = $sql->bind_param('ss', $username, $hash);
        $result = $sql->execute();        
        $result = $this->transformData($sql);
        $sql->close();
        return $result;
    }

    //INSERT
    public function insertValues($date_registered, $email, $name, $nif, $pass, $surname, $telephone, $username){
        $sql = $this->conn->prepare("INSERT INTO students (date_registered, email, name, nif, pass, surname, telephone, username) VALUES (?,?,?,?,?,?,?,?)");        
        $sql->bind_param("ssssssss", $date_registered, $email, $name, $nif, $pass, $surname, $telephone, $username);
        $sql->execute();
        $res=$sql->affected_rows;
        $sql->close();        
        return $res;
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