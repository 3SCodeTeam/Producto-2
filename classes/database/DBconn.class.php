<?php

include 'includes/autoloader.inc.php';

class DBconn extends Dbconfig{

    protected $connection;
    
    protected $conn;
    protected $db;
    protected $host;
    protected $user;
    protected $pass;

    function __construct(){
        $this -> connection = NULL;
        $dbParam = new Dbconfig();
        $this -> db = $dbParam -> dbName;
        $this -> host = $dbParam -> serverName;
        $this -> user = $dbParam -> userName;
        $this -> pass = $dbParam ->passCode;
        $dbParam = NULL;
    }
    
    function dbDisconnect() {
        $this -> connection = NULL;
        $this -> db = NULL;
        $this -> host = NULL;
        $this -> user = NULL;
        $this -> pass = NULL;
    }

    public function dbConn() {
        try{
            $this -> connection = new mysqli($this -> host,$this -> user,$this -> pass,$this -> db);            
        }catch (Exception $e) {
            echo $e; //Gestionar el error.
        }finally{
            dbDisconnect();
        }      
    }
}
?>