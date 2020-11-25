<?php
if(!isset($_SESSION)){
    session_start();
}
include_once 'includes/autoloader.inc.php';

class usersAdminMod{
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
        //"SELECT id_user_admin, username, name, email, password FROM users_admin"
        //Ajustar las variables al orden.
        $res->bind_result(
            $id,
            $username,
            $name,
            $email,
            $pass,            
        );        
        while($res->fetch()){
            $user = new Admin();       
            $user->id_user_admin = $id;            
            $user->email=$email;
            $user->name=$name;            
            $user->pass=$pass;            
            $user->username=$username;            
            //if($count ==0){return 0;} //Si devuelve 0, no hay datos. row_num de mysqli no siempre devuelve valor.
            $data[] = $user;            
        }        
        return $data;
    }

    public function getAll() {
        $sql = $this->conn->prepare("SELECT id_user_admin, username, name, email, password FROM users_admin");        
        $sql->execute();
        $res = $this->transformData($sql);
        $sql->close();
        return $res;
    }

    public function getByAttribute(string $col, string $val) { 
        $stm = "SELECT id_user_admin, username, name, email, password FROM users_admin WHERE ".$col." = ?";
        $sql = $this->conn->prepare($stm);
        $sql->bind_param('s', $val);
        $sql->execute();        
        $res = $this->transformData($sql);
        $sql->close();        
        return $res;
    }

    public function getByAttributes($col1, $col2, $val1, $val2, string $operator) {
        $stm = 'SELECT id_user_admin, username, name, email, password  FROM users_admin WHERE '.$col1.' = ? '.$operator.' '.$col2.' = ?';
        $sql = $this->conn->prepare($stm);
        $sql->bind_param('sssss', $col1, $val1, $operator, $col2, $val2);        
        $sql->execute();
        $res = $this->transformData($sql);
        $sql->close();
        return $res;
    }
    
    public function getById(int $id) {
        //$this->getByAttribute('id_user_admin', $id);
        $sql = $this->conn->prepare('SELECT id_user_admin, username, name, email, password FROM users_admin WHERE id_user_admin = ?');        
        $sql->bind_param("s", $id);
        $sql->execute();        
        $res = $this->transformData($sql);
        $sql->close();
        return $res;
    }

    public function getByUsername(string $username) {
        //return $this->getByAttribute('username', $username);
        $sql = $this->conn->prepare('SELECT id_user_admin, username, name, email, password FROM users_admin WHERE username = ?');        
        $sql->bind_param("s", $username);
        $sql->execute();        
        $res = $this->transformData($sql);
        $sql->close();
        return $res;
    }

    public function getByEmail($email) {
        //$this->getByAttribute('email', $email);
        $sql = $this->conn->prepare('SELECT id_user_admin, username, name, email, password FROM users_admin WHERE email = ?');        
        $sql->bind_param("s", $email);
        $sql->execute();        
        $res = $this->transformData($sql);
        $sql->close();
        return $res;
    }

    public function checkPassMatch($username, $hash) {
        $sql = $this->conn->prepare('SELECT id_user_admin, username, name, email, password  FROM users_admin WHERE username = ? AND password = ?');
        $sql->bind_param('ss', $username, $hash);
        $sql->execute();
        $res = $sql->affected_rows;
        $sql->close();
        return $res;
    }

    public function insertValues($username, $name, $email, $password) {
        $sql = $this->conn->prepare('INSERT INTO users_admin (username, name, email, password) VALUES (?, ?, ?, ?)');
        $sql->bind_param('ssss', $id, $username, $name, $email, $password);
        $sql->execute();
        $res = $sql->affected_rows;
        $sql->close();
        return $res;
    }

    public function updateValue($attribute, $new_value, $col, $val) {
        $stm = "UPDATE users_admin SET ".$atrribute." = ? WHERE ".$col." = ?";
        $sql = $this->conn->prepare($stm);
        $sql->bind_param('ssss', $attribute, $new_value, $col, $val);
        $sql->execute();
        $res = $sql->affected_rows;
        $sql->close();
        return $res;
    }

    public function updateValueById($attribute, $new_value, $id) {        
        $stm = "UPDATE users_admin SET ".$attribute." = ? WHERE id_user_admin = ?";
        $sql = $this->conn->prepare($stm);        
        $sql->bind_param('ss', $new_value, $id);        
        $sql->execute();
        $res = $sql->affected_rows;
        $sql->close();        
        return $res;
    }

    public function deleteById($id) {
        $sql = $this->conn->prepare('DELETE FROM users_admin WHERE id_user_admin = ?');
        $sql->bind_param('s', $id);
        $sql->execute();
        $res = $sql->affected_rows;
        $sql->close();
        return $res;
    }
}
?>