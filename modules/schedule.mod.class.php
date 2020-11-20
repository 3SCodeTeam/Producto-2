<?php
include 'includes/autoloader.inc.php';

class schedule extends DBconn {
    private $conn;
    private $id_schedule;
    private $id_class;
    private $time_start;
    private $time_end;
    private $day;

    public function _constructor() {
        $dbconnection = new DBconnection();
        $this->conn = $dbconnection->dbconn();
    }

    public function getAll() {
        $sql = 'SELECT * FROM schedule';
        $result = $this->conn->query($sql);
        return $result;
    }

    public function getByAttribute($col, $val) {
        $sql = $this->conn->prepare('SELECT * FROM schedule WHERE ? = ?');
        $sql->bind_param('ss', $col, $val);
        $sql->close();
        $result = $sql->execute();
        return $result;
    }

    public function getByAttributes($col1, $col2, $val1, $val2, string $operator) {
        $sql = $this->conn->prepare('SELECT * FROM schedule WHERE ? = ? ? ? = ?');
        $sql->bind_param('sssss', $col1, $val1, $operator, $col2, $val2);
        $sql->close();
        $result = $sql->execute();
        return $result;
    }

    public function getById(int $id) {
        return getByAttribute('id_schedule', $id);
    }

    public function insertValues($id_schedule, $id_class, $time_start, $time_end, $day) {
        $sql = $this->conn->prepare('INSERT INTO schedule(id_schedule, id_class, time_start, time_end, day) VALUES (?, ?, ?, ?, ?)');
        $result = $sql->bind_param('sssss', $id_schedule, $id_class, $time_start, $time_end, $day);
        $sql->close();
        return $result->affected_rows;
    }

    public function updateValue($attribute, $new_value, $col, $val) {
        $sql = $this->conn->prepare('UPDATE schedule SET ? = ? WHERE ? = ?');
        $result = $sql->bind_param('ssss', $attribute, $new_value, $col, $val);
        $sql->close();
        return $result->affected_rows;
    }

    public function updateValueById($attribute, $new_value, $id) {
        $sql = $this->conn->prepare('UPDATE schedule SET ? = ? WHERE id_schedule = ?');
        $result = $sql->bind_param('sss', $attribute, $new_value, $id);
        $sql->close();
        return $result->affected_rows;
    }

    public function deleteById($id) {
        $sql = $this->conn->prepare('DELETE FROM schedule WHERE id_schedule = ?');
        $result = $sql->bind_param('s', $id);
        $sql->close();
        return $result->affected_rows;
    }
}
?>