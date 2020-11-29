<?php
include_once 'includes/autoloader.inc.php';

class ScheduleMod{
    protected $conn;
    private $id_schedule;
    private $id_class;
    private $time_start;
    private $time_end;
    private $day;

    public function __construct() {
        //parent::__construct();
        //$this->con = parent::dbconn();
        $dbconnection = new DBconnection();
        $this->conn = $dbconnection->dbconn();
    }

    private function transformData($res){          
        $data=[];        
        //"SELECT  id_schedule, id_class, time_start, time_end, day FROM schedule'
        //Ajustar las variables al orden.
        $res->bind_result(            
            $id,
            $id_class,
            $time_start,
            $time_end,
            $day,            
        );
        while($res->fetch()){            
            $item = new Schedule();            
            $item->id_schedule = $id;            
            $item->id_class=$id_class;
            $item->time_start=$time_start;            
            $item->time_end=$time_end;            
            $item->day=$day;
            $data[] = $item;            
        }        
        return $data;
    }
    public function getAll() {
        $sql = $this->conn->prepare('SELECT  id_schedule, id_class, time_start, time_end, day FROM schedule');
        $res = $sql->execute();
        $sql->execute();
        $res = $this->transformData($sql);
        $sql->close();
        return $res;
    }

    public function getByAttribute($col, $val) {
        $stm = "SELECT  id_schedule, id_class, time_start, time_end, day FROM schedule WHERE ".$col." = ?";
        $sql = $this->conn->prepare($stm);
        $sql->bind_param('s',$val);        
        $sql->execute();
        $res = $this->transformData($sql);
        $sql->close();
        return $res;
    }

    public function getByAttributes($col1, $col2, $val1, $val2, string $operator) {
        $stm = "SELECT  id_schedule, id_class, time_start, time_end, day FROM schedule WHERE ".$col1." = ? ".$operator." ".$col2." = ?";
        $sql = $this->conn->prepare($stm);
        $sql->bind_param('ss',$val1, $val2);        
        $sql->execute();
        $res = $this->transformData($sql);
        $sql->close();
        return $res;
    }
    public function maxById($val){
        $stm = "SELECT  max(id_schedule), id_class, time_start, time_end, day FROM schedule WHERE id_class = ?";
        $sql = $this->conn->prepare($stm);
        $sql->bind_param('s',$val);        
        $sql->execute();
        $res = $this->transformData($sql);
        $sql->close();
        return $res;
    }

    public function getById(int $id) {
        return getByAttribute('id_schedule', $id);
    }

    public function insertValues($id_class, $time_start, $time_end, $day) {
        $sql = $this->conn->prepare('INSERT INTO schedule (id_class, time_start, time_end, day) VALUES (?, ?, ?, ?)');
        $sql->bind_param('ssss', $id_class, $time_start, $time_end, $day);
        //var_dump($this->conn);
        $sql->execute();        
        $res = $sql->affected_rows;
        $sql->close();
        return $res;
    }

    public function updateValue($attribute, $new_value, $col, $val) {
        $stm = "UPDATE schedule SET ".$attribute." = ? WHERE ".$col." = ?";
        $sql = $this->conn->prepare($stm);
        $sql->bind_param('ssss', $attribute, $new_value, $col, $val);
        $sql->execute();
        $res = $sql->affected_rows;
        $sql->close();
        return $res;
    }

    public function updateValueById($attribute, $new_value, $id) {
        $stm = "UPDATE schedule SET ".$attribute." = ? WHERE id_schedule = ?";
        $sql = $this->conn->prepare($stm);
        $sql->bind_param('sss', $attribute, $new_value, $id);
        $sql->execute();
        $res = $sql->affected_rows;
        $sql->close();
        return $res;
    }

    public function deleteById($id) {
        $sql = $this->conn->prepare('DELETE FROM schedule WHERE id_schedule = ?');
        $sql->bind_param('s', $id);
        $sql->execute();
        $res = $sql->affected_rows;
        $sql->close();
        return $res;
    }
}
?>