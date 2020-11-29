<?php
include_once 'includes/autoLoader.inc.php';
class teachersController extends teachers {

    // Funcion INSERT query
    public function insertTeachers($id_teacher, $name, $surname, $telephone, $nif, $email){
        $mysqli = new Dbh;
        $query = "INSERT INTO teachers VALUES (?, ?, ?, ?, ?, ?)";

        // Check connection
        if ($mysqli->connect() -> connect_errno) {
            echo "Failed to connect to MySQL: " . $mysqli->connect() -> connect_error;
            exit();
        }
        $stmt = $mysqli->connect()->prepare("INSERT INTO teachers VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('ississ', $id_teacher, $name, $surname, $telephone, $nif, $email);
        $stmt->execute();
        $stmt->close();
    }  
    
    // Funcion INSERT query <-- students.mod.class.php
    public function insertTeachers2($id_teacher, $name, $surname, $telephone, $nif, $email){
        $mysqli = new Dbh;
        $sql = $mysqli->connect()->prepare('INSERT INTO teachers (id_teacher, name, surname, telephone, nif, email) VALUES (?,?,?,?,?,?)');
        $result = $sql->bind_param('ississ', $id_teacher, $name, $surname, $telephone, $nif, $email);
        $result = $sql->execute();
        $sql->close();
        // return $result->affected_rows;
    }

    // // Funcion para comprobar que los datos llegan correctamente desde la vista
    // // y son devueltos (p.ej. operación con el tipo INT del campo ID_TEACHER)
    // public function returnTeachers($id){
    //     $result = $id * 4;
    //     echo $result;
    // }

    // // Funcion INSERT query
    public function insertTeachers0(){
        $mysqli = new Dbh;
        $query = "INSERT INTO teachers VALUES (5, 'Mary', 'Jane', 654987321, '741L', 'mary@jane.com')";
        $mysqli->connect()->query($query);
    }
    
    // Funcion SELECT query
    public function showTeachers(){
        $mysqli = new Dbh;
        $query = "SELECT * FROM teachers";

        // Check connection
        if ($mysqli->connect() -> connect_errno) {
            echo "Failed to connect to MySQL: " . $mysqli->connect() -> connect_error;
            exit();
        }
        
        // MySQLi, object oriented way
        if ($result = $mysqli->connect()->query($query)){
            while ($teacher = $result->fetch_object('teachers')){
                echo $teacher->__toString()."<br>";
            }
        }
        // MySQLi, procedural way
        // if ($result = mysqli_query($this->connect(), $query)){
        //     while ($teachers = mysqli_fetch_object($result, 'teachers')){
        //         echo $teachers->info()."<br>";
        //     }
        // }
    }
    
    // Funcion mostrar listado
    // public function showAllTeachers() {
    //     $datas = $this->getAllTeachers();
    //     foreach ($datas as $data) {
    //         echo $data['id_teacher']."<br>";
    //         echo $data['name']."<br>";
    //         echo $data['surname']."<br>";
    //         echo $data['email']."<br>";
    //     }
    // }
}