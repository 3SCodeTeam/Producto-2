<?php
if(!isset($_SESSION)){
    session_start();
}
include_once 'includes/autoloader.inc.php';

class Students{
    
    private $conn;

    public function __construct(){
                
        //parent::__construct();
        //$this->conn = parent::dbconn();
        //parent::__construct('students');
        $dbconnection = new DBconnection();
        $this->conn = $dbconnection->dbconn();
        
    }
    private function transformData($res){              
        $data=[];        
        //"SELECT count(id), id, date_registered, email, name, nif, pass, surname, telephone, username"
        //Ajustar las variables al orden.
        $res->bind_result(            
            $id,
            $date_registered,
            $email,            
            $name,
            $nif,        
            $pass,
            $surname,            
            $telephone,
            $username,
        );
        while($res->fetch()){
            $item = new Student();
            $item->id = $id;
            $item->date_registered=$date_registered;
            $item->email=$email;
            $item->name=$name;
            $item->nif=$nif;
            $item->surname=$surname;
            $item->pass=$pass;            
            $item->telephone=$telephone;
            $item->username=$username;
            $data[] = $item;            
        }        
        return $data;
    }

    

    public function getClassesOfDay($id, $date){
        $stm = 'SELECT S.id_class, S.day, S.time_start, S.time_end, C.name, C.color, Co.name FROM schedule as S inner JOIN class as C ON S.id_class=C.id_class INNER JOIN courses as Co ON C.id_course = Co.id_course
        WHERE Co.id_course IN (SELECT id_course FROM enrollment WHERE id_student = ?) and S.day =? ORDER BY S.day, S.time_start';
        $sql = $this->conn->prepare($stm);        
        $sql->bind_param('ss', $id, $date);        
        $sql->execute();
        $res=$this->transformClassData($sql);
        $sql->close();
        return $res;        
    }
    public $class_day; //Día de la semana
    public $class_name;
    public $class_color; //¿nombre del color?
    public $course_name;
    public $teacher_email;
    public $teacher_name;
    public $teacher_surname;
    public $time_start;
    public $time_end;
    private function transformClassData($res){
        $data=[];        
        //"SELECT S.id_class, S.day, S.time_start, S.time_end, C.name, C.color, Co.name FROM schedule as S inner JOIN class as C ON S.id_class=C.id_class
        //Ajustar las variables al orden.
        $res->bind_result(            
            $id_class,
            $class_day,
            $class_time_start,
            $class_time_end,
            $class_name,            
            $class_color,
            $course_name,            
            
        );
        while($res->fetch()){
            $item = new classesDetails();
            $item->id_class = $id_class;
            $item->class_day = $class_day;
            $item->class_name = $class_name;
            $item->class_color = $class_color;
            $item->course_name = $course_name;
            $item->time_start = $class_time_start;
            $item->time_end = $class_time_end;
            $data[] = $item;
        }        
        return $data;

    }

    public function getAll(){        
        $sql = $this->conn->prepare('SELECT id, date_registered, email, name, nif, pass, surname, telephone, username  FROM students ORDER BY id');
        $sql->execute(); //Ejecutas la consulta con la sentencia preparada
        $res = $this->transformData($sql); //Recuperas un array de datos.
        //var_dump($res); 
        $sql->close(); //Cierras la consulta.
        return $res; //Devuelves los datos.
    }    

    /*Select Data With PDO (+ Prepared Statements)
        i - integer
        d - double
        s - string
        b - BLOB
    */ 

    public function getById(int $id){
        $sql = $this->conn->prepare('SELECT id, date_registered, email, name, nif, pass, surname, telephone, username  FROM students WHERE id = ?');
        $sql->bind_param('i', $id);        
        $sql->execute();        
        $res = $this->transformData($sql);
        $sql->close();
        return $res;
    }

    public function getByUsername($username){
        $sql = $this->conn->prepare("SELECT id, date_registered, email, name, nif, pass, surname, telephone, username  FROM students WHERE username = ?");
        if($sql->bind_param('s', $username)){
            $sql->execute();            
            $result = $this->transformData($sql);            
        }else{            
            $result = 'err';
        }
        $sql->close();        
        return $result;
    }

    public function getByEmail($email){
        $sql = $this->conn->prepare('SELECT id, date_registered, email, name, nif, pass, surname, telephone, username  FROM students WHERE email = ?');
        $sql->bind_param('s', $id);        
        $sql->execute();        
        $res = $this->transformData($sql);
        $sql->close();
        return $res;
    }

    public function checkPassMatch($username, $hash){
        $sql = $this->conn->prepare('SELECT id, date_registered, email, name, nif, pass, surname, telephone, username  FROM students WHERE username = ? and pass = ?');
        $sql->bind_param('ss', $username, $hash);
        $sql->execute();        
        $res = $this->transformData($sql);
        $sql->close();
        return $res;
    }

    //INSERT
    public function insertValues($date_registered, $email, $name, $nif, $pass, $surname, $telephone, $username){
        $sql = $this->conn->prepare("INSERT INTO students (date_registered, email, name, nif, pass, surname, telephone, username) VALUES (?,?,?,?,?,?,?,?)");        
        $sql->bind_param("ssssssss", $date_registered, $email, $name, $nif, $pass, $surname, $telephone, $username);
        $sql->execute();
        $res=$sql->affected_rows;
        $sql->close();        
        return $res;
    }
    
    public function updateValueById($attribute, $new_value, $id){
        $stm = 'UPDATE students SET '.$attribute.' = ? WHERE id = ?';
        $sql = $this->conn->prepare($stm);
        $sql->bind_param('ss', $new_value, $id);
        $sql->execute();
        $res=$sql->affected_rows;
        $sql->close();        
        return $res;
    }

    //DELETE int $mysqli->affected_rows;
    public function deleteById($id){
        $sql = $this->conn->prepare('DELETE FROM students WHERE id = ?');
        $sql->bind_param('s', $id);
        $sql->execute();
        $res=$sql->affected_rows;
        $sql->close();
        return $res;
    }
}    
?>