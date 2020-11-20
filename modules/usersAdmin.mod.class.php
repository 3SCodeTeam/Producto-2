<?php
include 'includes/autoloader.inc.php';

class usersAdmin extends DBconn {
    private $conn;
    private $id_user_admin;
    private $username;
    private $name;
    private $email;
    private $password;

    public function _constructor() {
        $dbconnection = new DBconnection();
        $this->conn = $dbconnection->dbconn();
    }

    public function getAll() {
        $sql = 'SELECT * FROM users_admin';
        $result = $this->conn->query($sql);
        return $result;
    }

    public function getByAttribute($col, $val) {
        $sql = $this->conn->prepare('SELECT * FROM users_admin WHERE ? = ?');
        $sql->bind_param('ss', $col, $val);
        $sql->close();
        $result = $sql->execute();
        return $result;
    }

    public function getByAttributes($col1, $col2, $val1, $val2, string $operator) {
        $sql = $this->conn->prepare('SELECT * FROM users_admin WHERE ? = ? ? ? = ?');
        $sql->bind_param('sssss', $col1, $val1, $operator, $col2, $val2);
        $sql->close();
        $result = $sql->execute();
        return $result;
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
        $sql = $this->conn->prepare('SELECT * FROM users_admin WHERE username = ? AND password = ?');
        $result = $sql->bind_param('ss', $username, $hash);
        $sql->close();
        return $result->affected_rows;
    }

    public function insertValues($id, $username, $name, $email, $password) {
        $sql = $this->conn->prepare('INSERT INTO users_admin(id_user_admin, username, name, email, password) VALUES (?, ?, ?, ?, ?)');
        $result = $sql->bind_param('sssss', $id, $username, $name, $email, $password);
        $sql->close();
        return $result->affected_rows;
    }

    public function updateValue($attribute, $new_value, $col, $val) {
        $sql = $this->conn->prepare('UPDATE users_admin SET ? = ? WHERE ? = ?');
        $result = $sql->bind_param('ssss', $attribute, $new_value, $col, $val);
        $sql->close();
        return $result->affected_rows;
    }

    public function updateValueById($attribute, $new_value, $id) {
        $sql = $this->conn->prepare('UPDATE users_admin SET ? = ? WHERE id_user_admin = ?');
        $result = $sql->bind_param('sss', $attribute, $new_value, $id);
        $sql->close();
        return $result->affected_rows;
    }

    public function deleteById($id) {
        $sql = $this->conn->prepare('DELETE FROM users_admin WHERE id_user_admin = ?');
        $result = $sql->bind_param('s', $id);
        $sql->close();
        return $result->affected_rows;
    }
}
?>