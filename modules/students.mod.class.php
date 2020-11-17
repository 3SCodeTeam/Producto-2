<?php
include 'includes/autoloader.inc.php';

class Students extends DBconn{
    
    private $conn;
    private $id;
    private $username;
    private $password;
    private $name;    
    private $telephone;
    private $nif;
    private $date_registered;

    public function _constructor(){
        $dbconnection = new DBconnection();
        $this->conn = $dbconnection->dbconn();

    }

    public function getAll(){        
        $sql = 'SELECT * FROM students';
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
    public function getByAttribute($col, $val){
        $sql = $this->conn->prepare('SELECT * FROM students WHERE ? = ?');
        $sql->bind_param('ss', $col, $val);
        $sql->close();
        $result = $sql->execute();
        return $result;
    }

    public function getByAttributes($col1, $col2, $val1, $val2, string $operator){
        $sql = $this->conn->prepare('SELECT * FROM students WHERE ? = ? ? ? = ?');
        $sql->bind_param('ssss', $col1, $val1,$operator,$col2,$val2);
        $sql->close();
        $result = $sql->execute();
        return $result;
    }

    //ATENCIÓN LOS DOS MËTODOS ANTEORIORES SON COMUNES A TODOS LOS MODULOS. MEJOR MOVERLOS A DBqueries.class.php

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

    // ATENCIÓN: ESTOS MÉTODOS A LO MEJOR LOS PASAMOS A DBqueries.class.php POR QUE SON COMUNES A TODAS LAS TABLAS.
    //UPDATE int $mysqli->affected_rows;
    public function updateValue($attribute, $new_value, $col, $val){
        $sql = $his->conn->prepare('UPDATE students SET ? = ? WHERE ? = ?');
        $result = $sql->bind_param('ssss', $attribute, $new_value, $col, $val);
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