<?php
include 'includes/autoloader.inc.php';

class schedule extends DBconnection {
    private $conn;
    private $id_schedule;
    private $id_class;
    private $time_start;
    private $time_end;
    private $day;

    public function _constructor() {
        parent::__construct();
        $this->con = parent::dbconn();
        /*$dbconnection = new DBconnection();
        $this->conn = $dbconnection->dbconn();*/
    }

    function transformData($res){          
        $data=[];        
        //"SELECT count(id_schedule), id_schedule, id_class, time_start, time_end, day FROM schedule'
        //Ajustar las variables al orden.
        $res->bind_result(
            $count,
            $id,
            $id_class,
            $time_start,
            $time_end,
            $day,            
        );
        while($res->fetch()){
            if($count ==0){return 0;} //Si devuelve 0, no hay datos. row_num de mysqli no siempre devuelve valor.
            $user = new Schedule();
            $user->count=$count;
            $user->id_schedule = $id;            
            $user->id_class=$id_class;
            $user->time_start=$time_start;            
            $user->time_end=$time_end;            
            $user->day=$day;
            $data[] = $user;            
        }        
        return $data;
    }

    public function getAll() {
        $sql = 'SELECT count(id_schedule), id_schedule, id_class, time_start, time_end, day FROM schedule';
        $res = $this->conn->query($sql);
        return $this->transformData($res);
    }

    public function getByAttribute($col, $val) {
        $sql = $this->conn->prepare('SELECT count(id_schedule), id_schedule, id_class, time_start, time_end, day FROM schedule WHERE ? = ?');
        $sql->bind_param('ss', $col, $val);        
        $res = $sql->execute();
        $sql->close();
        return $this->transformData($res);
    }

    public function getByAttributes($col1, $col2, $val1, $val2, string $operator) {
        $sql = $this->conn->prepare('SELECT count(id_schedule), id_schedule, id_class, time_start, time_end, day FROM schedule WHERE ? = ? ? ? = ?');
        $sql->bind_param('sssss', $col1, $val1, $operator, $col2, $val2);        
        $res = $sql->execute();
        $sql->close();
        return $this->transformData($res);
    }

    public function getById(int $id) {
        return getByAttribute('id_schedule', $id);
    }

    public function insertValues($id_class, $time_start, $time_end, $day) {
        $sql = $this->conn->prepare('INSERT INTO schedule(id_schedule, id_class, time_start, time_end, day) VALUES (?, ?, ?, ?, ?)');
        $res = $sql->bind_param('sssss', $id_class, $time_start, $time_end, $day);
        $sql->close();
        return $res->affected_rows;
    }

    public function updateValue($attribute, $new_value, $col, $val) {
        $sql = $this->conn->prepare('UPDATE schedule SET ? = ? WHERE ? = ?');
        $res = $sql->bind_param('ssss', $attribute, $new_value, $col, $val);
        $sql->close();
        return $res->affected_rows;
    }

    public function updateValueById($attribute, $new_value, $id) {
        $sql = $this->conn->prepare('UPDATE schedule SET ? = ? WHERE id_schedule = ?');
        $res = $sql->bind_param('sss', $attribute, $new_value, $id);
        $sql->close();
        return $res->affected_rows;
    }

    public function deleteById($id) {
        $sql = $this->conn->prepare('DELETE FROM schedule WHERE id_schedule = ?');
        $res = $sql->bind_param('s', $id);
        $sql->close();
        return $res->affected_rows;
    }
}
?>