<?php
include 'includes/autoloader.inc.php';

class Students extends DBqueries{
    
    private $conn;

    public function __construct(){
        paren::_contruct('students');
        $dbconnection = new DBconnection();
        $this->conn = $dbconnection->dbconn();
    }

    public function getAll(){        
        $sql = 'SELECT * FROM students ORDER BY id';
        $result = $this->conn->query($sql);
        return $result;
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
        $sql->close();
        $result = $sql->execute();
        return $result;
    }

    public function getByUsername($username){
        $sql = $this->conn->prepare('SELECT * FROM students WHERE username = ?');
        $result = $sql->bind_param('s', $username);
        $sql->close();
        $result = $sql->execute();
        return $result;
    }

    public function getByEmail($email){
        $sql = $this->conn->prepare('SELECT * FROM students WHERE email = ?');
        $result = $sql->bind_param('s', $id);
        $sql->close();
        $result = $sql->execute();        
        return $result;
    }

    public function checkPassMatch($username, $hash){
        $sql = $this->conn->prepare('SELECT * FROM students WHERE username = ? and pass = ?');
        $result = $sql->bind_param('ss', $username, $hash);
        $sql->close();
        return $result->affected_rows;
    }

    //INSERT
    public function insertValues($email, $name, $nif, $pass, $surname, $telephone, $username)
    {
        $sql = $his->conn->prepare('INSERT INTO students (email, name, nif, pass username, telephone, username) VALUES (?,?,?,?,?,?,?)');
        $result = $sql->bind_param('sssssss', $email, $name, $nif, $pass, $surname, $telephone, $username);
        $sql->close();
        return $result->affected_rows;
    }
    
    public function updateValueById($attribute, $new_value, $id){
        $sql = $his->conn->prepare('UPDATE students SET ? = ? WHERE id = ?');
        $result = $sql->bind_param('ssss', $attribute, $new_value, $id);
        $sql->close();
        return $result->affected_rows;
    }

    //DELETE int $mysqli->affected_rows;
    public function deleteById($id){
        $sql = $his->conn->prepare('DELETE FROM students WHERE id = ?');
        $result = $sql->bind_param('s', $id);
        $sql->close();
        return $result->affected_rows;
    }
}    
?>