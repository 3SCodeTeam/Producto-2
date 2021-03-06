<?php

#include 'includes/MODs.autoloader.inc.php';
include_once 'DBconfig.class.php';
class DBconnection extends Dbconfig{

    public $conn;
    protected $db;
    protected $host;
    protected $user;
    protected $pass;

    public function __construct(){
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
            die($this->conn->connect_error);
        }finally{
            return $this->conn;
        }
    }
}
?>