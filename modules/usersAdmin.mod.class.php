<?php
include 'includes/autoloader.inc.php';

class usersAdmin extends DBconnection {
    private $conn;
    private $id_user_admin;
    private $username;
    private $name;
    private $email;
    private $password;

    public function _constructor() {
        parent::__construct();
        $this->con = parent::dbconn();
        /*$dbconnection = new DBconnection();
        $this->conn = $dbconnection->dbconn();*/
    }

    function transformData($res){          
        $data=[];        
        //"SELECT count(id_user_admin), id_user_admin, username, name, email, password FROM users_admin"
        //Ajustar las variables al orden.
        $res->bind_result(
            $count,
            $id,
            $username,
            $name,
            $email,
            $pass,            
        );
        while($res->fetch()){
            if($count ==0){return 0;} //Si devuelve 0, no hay datos. row_num de mysqli no siempre devuelve valor.
            $user = new Admin();
            $user->count=$count;
            $user->id_user_admin = $id;            
            $user->email=$email;
            $user->name=$name;            
            $user->pass=$pass;            
            $user->username=$username;
            $data[] = $user;            
        }        
        return $data;
    }

    public function getAll() {
        $sql = "SELECT count(id_user_admin), id_user_admin, username, name, email, password FROM users_admin";
        $res = $this->conn->query($sql);
        return $this->transformData($res);
    }

    public function getByAttribute($col, $val) {
        $sql = $this->conn->prepare('SELECT count(id_user_admin), id_user_admin, username, name, email, password  FROM users_admin WHERE ? = ?');
        $sql->bind_param('ss', $col, $val);        
        $res = $sql->execute();
        $sql->close();
        return $this->transformData($res);
    }

    public function getByAttributes($col1, $col2, $val1, $val2, string $operator) {
        $sql = $this->conn->prepare('SELECT count(id_user_admin), id_user_admin, username, name, email, password  FROM users_admin WHERE ? = ? ? ? = ?');
        $sql->bind_param('sssss', $col1, $val1, $operator, $col2, $val2);        
        $res = $sql->execute();
        $sql->close();
        return $this->transformData($res);
    }

    public function getById(int $id) {
        return getByAttribute('id_user_admin', $id);
    }

    public function getByUsername($username) {
        return getByAttribute('username', $username);
    }

    public function getByEmail($email) {
        return getByAttribute('email', $email);
    }

    public function checkPassMatch($username, $hash) {
        $sql = $this->conn->prepare('SELECT count(id_user_admin), id_user_admin, username, name, email, password  FROM users_admin WHERE username = ? AND password = ?');
        $res = $sql->bind_param('ss', $username, $hash);
        $sql->close();
        return $res->affected_rows;
    }

    public function insertValues($username, $name, $email, $password) {
        $sql = $this->conn->prepare('INSERT INTO users_admin (username, name, email, password) VALUES (?, ?, ?, ?)');
        $res = $sql->bind_param('ssss', $id, $username, $name, $email, $password);
        $sql->close();
        return $res->affected_rows;
    }

    public function updateValue($attribute, $new_value, $col, $val) {
        $sql = $this->conn->prepare('UPDATE users_admin SET ? = ? WHERE ? = ?');
        $res = $sql->bind_param('ssss', $attribute, $new_value, $col, $val);
        $sql->close();
        return $res->affected_rows;
    }

    public function updateValueById($attribute, $new_value, $id) {
        $sql = $this->conn->prepare('UPDATE users_admin SET ? = ? WHERE id_user_admin = ?');
        $res = $sql->bind_param('sss', $attribute, $new_value, $id);
        $sql->close();
        return $res->affected_rows;
    }

    public function deleteById($id) {
        $sql = $this->conn->prepare('DELETE FROM users_admin WHERE id_user_admin = ?');
        $res = $sql->bind_param('s', $id);
        $sql->close();
        return $res->affected_rows;
    }
}
?>