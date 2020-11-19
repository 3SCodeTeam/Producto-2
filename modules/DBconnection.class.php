<?php

#include 'includes/MODs.autoloader.inc.php';
include 'DBconfig.class.php';
class DBconnection extends Dbconfig{

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
        $this -> conn = NULL;
        $this -> db = NULL;
        $this -> host = NULL;
        $this -> user = NULL;
        $this -> pass = NULL;
    }

    public function dbConn() {
        try{
            $this -> conn = new mysqli($this -> host,$this -> user,$this -> pass,$this -> db);                    
        }catch (Exception $e) {
            echo $e; //Gestionar el error.
        }finally{
            die($this->conn->connect_error);
            dbDisconnect();
        }
    }

    public function getConn()
    {
        return $this->conn;
    }
}
?>