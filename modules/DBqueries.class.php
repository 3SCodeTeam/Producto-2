<?php
include 'includes/autoloader.inc.php';

class DBqueries{
    private $table;
    private $conn;

    public function getTable()
    {
        return $this->table;
    }
    public function setTable($table)
    {
        $this->table = $table;

        return $this;
    }

    public function __construct($table){
        $this -> table = (string) $table;            
        $dbconnection = new DBconnection();
        $this->conn = $dbconnection->dbconn();
    }
    
    function dataToArray($result){
        while($row = $result->fetch_object()){
            $dataSet[]=$row;
        }
        return $dataSet;
    }

    function queryDb($sql){
        $result = $this->conn->query($sql);        
        return dataToArray($result);
    }

    //SELECT
    public function getByAttribute($col, $val){
        $sql = $this->conn->prepare("SELECT * FROM $this->table WHERE ? = ?");
        $sql->bind_param('ss', $col, $val);
        $sql->close();
        $result = $sql->execute();
        return $result;
    }

    public function getByAttributes($col1, $col2, $val1, $val2, string $operator){
        $sql = $this->conn->prepare("SELECT * FROM $this->table WHERE ? = ? ? ? = ?");
        $sql->bind_param('ssss', $col1, $val1,$operator,$col2,$val2);
        $sql->close();
        $result = $sql->execute();
        return $result;
    }

    public function getAll(){
        $sql="SELECT * FROM $this->table"; //Verificar que tenemos id en todas las tablas.
        return queryDB($sql);
    }

    //UPDATE
    public function updateValue($attribute, $new_value, $col, $val){
        $sql = $his->conn->prepare("UPDATE $this->table SET ? = ? WHERE ? = ?");
        $result = $sql->bind_param('ssss', $attribute, $new_value, $col, $val);
        $sql->close();       
        return $result->affected_rows;
    }

    /*
    public function geBy($column, $value){
        $sql = "SELECT * FROM $this->table WHERE $column = '$value'";
        return queryDB($sql);
    }
    */
}
?>