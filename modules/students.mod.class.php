<?php
include_once 'includes/autoloader.inc.php';

class Students{
    
    private $conn;

    public function __construct(){
                
        //parent::__construct();
        //$this->conn = parent::dbconn();
        //parent::__construct('students');
        $dbconnection = new DBconnection();
        $this->conn = $dbconnection->dbconn();
        
    }
    function transformData($res){              
        $data=[];        
        //"SELECT count(id), id, date_registered, email, name, nif, pass, surname, telephone, username"
        //Ajustar las variables al orden.
        $res->bind_result(            
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
        $sql = $this->conn->prepare('SELECT id, date_registered, email, name, nif, pass, surname, telephone, username  FROM students ORDER BY id');
        $sql->execute(); //Ejecutas la consulta con la sentencia preparada
        $res = $this->transformData($sql); //Recuperas un array de datos.
        var_dump($res); 
        $sql->close(); //Cierras la consulta.
        return $res; //Devuelves los datos.
    }    

    /*Select Data With PDO (+ Prepared Statements)
        i - integer
        d - double
        s - string
        b - BLOB
    */ 

    public function getById(int $id){
        $sql = $this->conn->prepare('SELECT id, date_registered, email, name, nif, pass, surname, telephone, username  FROM students WHERE id = ?');
        $sql->bind_param('i', $id);        
        $sql->execute();        
        $res = $this->transformData($sql);
        $sql->close();
        return $res;
    }

    public function getByUsername($username){
        $sql = $this->conn->prepare("SELECT id, date_registered, email, name, nif, pass, surname, telephone, username  FROM students WHERE username = ?");
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
        $sql = $this->conn->prepare('SELECT id, date_registered, email, name, nif, pass, surname, telephone, username  FROM students WHERE email = ?');
        $sql->bind_param('s', $id);        
        $sql->execute();        
        $res = $this->transformData($sql);
        $sql->close();
        return $res;
    }

    public function checkPassMatch($username, $hash){
        $sql = $this->conn->prepare('SELECT id, date_registered, email, name, nif, pass, surname, telephone, username  FROM students WHERE username = ? and pass = ?');
        $sql->bind_param('ss', $username, $hash);
        $sql->execute();        
        $res = $this->transformData($sql);
        $sql->close();
        return $res;
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
        $stm = 'UPDATE students SET '.$attribute.' = ? WHERE id = ?';
        $sql = $his->conn->prepare($stm);
        $sql->bind_param('ss', $new_value, $id);
        $sql->execute();
        $res=$sql->affected_rows;
        $sql->close();        
        return $res;
    }

    //DELETE int $mysqli->affected_rows;
    public function deleteById($id){
        $sql = $his->conn->prepare('DELETE FROM students WHERE id = ?');
        $sql->bind_param('s', $id);
        $sql->execute();
        $res=$sql->affected_rows;
        $sql->close();
        return $res;
    }
}    
?>