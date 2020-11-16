<?php

include 'mysql.php';
include 'Dbconfig.php';

class DataManager extends Dbconfig{

    public $connStatus;
    public $connection;
    public $dataSet;    
    private $sqlQuery;   
    
    protected $conn;
    protected $db;
    protected $host;
    protected $user;
    protected $pass;

    function __construct(){
        $this -> connectionString = NULL;
        $this -> sqlQuery = NULL;
        $this -> dataSet = NULL;

                $dbParam = new Dbconfig();
                $this -> db = $dbParam -> dbName;
                $this -> host = $dbParam -> serverName;
                $this -> user = $dbParam -> userName;
                $this -> pass = $dbParam ->passCode;
                $dbParam = NULL;
    }   

    function dbConnect() {
        try{
            $this -> connection = new mysqli($this -> host,$this -> user,$this -> pass,$this -> db);        
            return $this -> connection;
        }catch (Exception $e) {
            echo $e;
        }finally{
            return $this -> connection;
        }      
    }

    function get_connStatus(){
        return $this -> connStatus = $this -> connection -> connect_errno;
    }

    function get_Estudiantes(){
        $sqlQuery = 'Select * from Producto2.students';
        $this -> dataset = $this -> connection -> query($sqlQuery);        
    }
}
?>