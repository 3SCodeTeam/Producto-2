<?php
include 'includes/autoloader.inc.php';

class DBqueries extends DBconnection{
    private $table;
    private $db;
    private $conn;
    

    public function _construct($table){
        $this -> table = (string) $table;            
        $dbconnection = new DBconnection();
        $this->conn = $dbconnection->dbconn()
    }
    public function __destructor(){ //Destructor ???
        $this->conn->close();   //Cerrar conexión???
    }

    function dataToArray($result){
        while($row = $result->fetch_object()){
            $dataSet[]=$row;
        }
        return $dataSet;
    }    

    function queryDB($sql){
        $result = $this->conn->query($sql);        
        return dataToArray($result);
    }

    public function getAll(){
        $sql="SELECT * FROM $this->table ORDER BY id DESC"; //Verificar que tenemos id en todas las tablas.
        return queryDB($sql);
    }

    public function geBy($column, $value){
        $sql = "SELECT * FROM $this->table WHERE $column = '$value'";
        return queryDB($sql);
    }

    public function deletByid($id){
        $sql = "DELETE FROM $this->table WHERE id = $id"; //Verificar que tenemos id en todas las tablas.
    }


}
?>