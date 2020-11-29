<?php
include_once 'includes/autoloader.inc.php';
class ClassesMod{
    private $conn;
    
    public function __construct(){
        //parent::__construct();
        //$this->con = parent::dbconn();
        $dbconnection = new DBconnection();
        $this->conn = $dbconnection->dbconn();
    }

    private function transformData($res){          
        $data=[];        
        //SELECT id_class, id_teacher, id_course, id_schedule, name, color FROM class
        //Ajustar las variables al orden.
        $res->bind_result(
            $id,
            $id_teacher,
            $id_course,
            $id_schedule,
            $name,
            $color,
        );
        while($res->fetch()){
            $item = new Classes();
            $item->id_class = $id;            
            $item->id_teacher=$id_teacher;
            $item->id_course=$id_course;            
            $item->id_schedule=$id_schedule;
            $item->name=$name;
            $item->color=$color;
            $data[] = $item;            
        }        
        return $data;
    }
    private function transformDataGetByDOW($res){          
        $data=[];        
        //Ajustar las variables al orden.
        $res->bind_result(
            $dow,
            $time_start,
            $time_end,
            $class_name,
            $class_color,
            $course_name,
            $teacher_email,
            $teacher_name,
            $teacher_surname
            
        );//$class_day $class_name $class_color $course_name $teacher_email $teacher_name $teacher_surname $time_start $time_end;
        while($res->fetch()){
            $item = new DayClasses();            
            $item->class_day=$dow;
            $item->class_name = $class_name;
            $item->class_color = $class_color;
            $item->course_name = $course_name;
            $item->teacher_email=$teacher_email;
            $item->teacher_name =$teacher_name;
            $item->teacher_surname = $teacher_surname;
            $item->time_start = $time_start;
            $item->time_end = $time_end;
            $data[] = $item;            
        }        
        return $data;
    }

    /*Query for dayClasses
    SELECT DISTINCT DAYOFWEEK(S.day) as DOW, S.time_start, S.time_end, C.name, C.color, Co.name, T.email
    FROM class as C
    INNER JOIN courses as Co ON C.id_course = Co.id_course
    INNER JOIN teachers AS T ON C.id_teacher = T.id_teacher
    INNER JOIN schedule AS S ON C.id_schedule = S.id_schedule
    */
    public function getbyDOW(){
        $stm='SELECT DISTINCT DAYOFWEEK(S.day) as DOW, S.time_start, S.time_end, C.name, C.color, Co.name as course_name, T.email, T.name as Tname, T.surname
        FROM class as C
        INNER JOIN courses as Co ON C.id_course = Co.id_course
        INNER JOIN teachers AS T ON C.id_teacher = T.id_teacher
        INNER JOIN schedule AS S ON C.id_schedule = S.id_schedule
        ORDER BY DOW';    
        $sql = $this->conn->prepare($stm);
        if($sql){
            $sql->execute();            
        }else{
            //var_dump($this->conn);
        }
        $res = $this->transformDataGetByDOW($sql);        
        return $res;
    }

    /*Query for dayClasses
        SELECT DISTINCT DAYOFWEEK(S.day), S.time_start, S.time_end
        FROM schedule as S INNER JOIN class as C on S.id_class = C.id_class
        WHERE C.id_teacher = 1 and S.day BETWEEN '2020-01-01' and '2020-12-31'
    */

    public function getScheduleByTeacherAndDate($id_teacher, $start_date, $end_date){
        $stm='SELECT DISTINCT DAYOFWEEK(S.day) as DOW, S.time_start, S.time_end, C.name, C.color, Co.name as course_name, T.email, T.name as Tname, T.surname
        FROM class as C
        INNER JOIN courses as Co ON C.id_course = Co.id_course
        INNER JOIN teachers AS T ON C.id_teacher = T.id_teacher
        INNER JOIN schedule AS S ON C.id_schedule = S.id_schedule
        WHERE C.id_teacher = ? and S.day BETWEEN ? and ?';
        $sql = $this->conn->prepare($stm);
        $sql->bind_param('sss', $id_teacher, $start_date, $end_date);
        $res = $this->transformDataGetByDOW($sql);
        $sql->close();
        return $res;
    }
     


    public function getAll(){        
        $sql = $this->conn->prepare('SELECT id_class, id_teacher, id_course, id_schedule, name, color FROM class');
        $sql->execute();
        $res = $this->transformData($sql);
        $sql->close();
        return $res;
    }

    /*Select Data With PDO (+ Prepared Statements)
        i - integer
        d - double
        s - string
        b - BLOB
    */

    //SELECT
    public function getIdClass($id_teacher, $id_course, $id_schedule, $name, $color){
        $stm ='SELECT id_class, id_teacher, id_course, id_schedule, name, color FROM class
        WHERE id_teacher = ? and id_course = ? and id_schedule = ? and name = ? and color = ?';
        $sql = $this->conn->prepare($stm);        
        $sql->bind_param('sssss', $id_teacher, $id_course, $id_schedule, $name, $color);        
        $sql->execute();
        //var_dump($this->conn);
        $res = $this->transformData($sql);
        $sql->close();
        return $res;

    }
    public function getByAttribute($col, $val) {
        $sql = $this->conn->prepare('SELECT id_class, id_teacher, id_course, id_schedule, name, color FROM class WHERE '.$col.' = ?');
        $sql->bind_param('s', $val);        
        $sql->execute();
        $res = $this->transformData($sql);
        $sql->close();
        return $res;
    }
    public function getByAttributes($col1, $col2, $val1, $val2, string $operator) {
        $sql = $this->conn->prepare('SELECT id_class, id_teacher, id_course, id_schedule, name, color FROM class WHERE '.$col.' = ? '.$operator.' '.$col2.' = ?');
        $sql->bind_param('ss', $val1, $val2);        
        $sql->execute();
        $res = $this->transformData($sql);
        $sql->close();
        return $res;
    }

    public function getById(int $id){
        return $this->getByAttribute('id_class',$id);
    }
    public function getByScheduleId(int $id_schedule){
        return $this->getByAttribute('id_schedule',$id_schedule);
    }
    public function getByCourseId($id_course){
        return $this->getByAttribute('id_course',$id_course);
    }
    public function getByTecherId($id_techer){
        return $this->getByAttribute('id_teacher',$id_teacher);
    }
    public function getByName($name){
        return $this->getByAttribute('name',$name);
    }
    public function getByColor($color){
        return $this->getByAttribute('color',$color);
    }

    //INSERT
    public function insertValues($id_teacher, $id_course, $id_schedule, $name, $color)
    {
        $sql = $this->conn->prepare('INSERT INTO class (id_teacher, id_course, id_schedule, name, color) VALUES (?,?,?,?,?)');        
        $sql->bind_param('sssss', $id_teacher, $id_course, $id_schedule, $name, $color);
        $sql->execute();
        //var_dump($this->conn);
        $res=$sql->affected_rows;
        $sql->close();
        return $res;
    }

    public function updateValueById($attribute, $new_value, $id){
        $stm='UPDATE class SET '.$attribute.' = ? WHERE id_class = ?';
        $sql = $this->conn->prepare($stm);
        $sql->bind_param('ss', $new_value, $id);
        //var_dump($this->conn);
        $sql->execute();
        $res=$sql->affected_rows;
        $sql->close();
        return $res;
    }

    //DELETE int $mysqli->affected_rows;
    public function deleteById($id){
        $sql = $this->conn->prepare("DELETE FROM class WHERE id_class = ?");
        $sql->bind_param('s', $id);
        $sql->execute();
        $res=$sql->affected_rows;
        $sql->close();
        return $res;
    }
    public function deleteByScheduleId($id){
        $sql = $this->conn->prepare("DELETE FROM class WHERE id_schedule = ?");
        $sql->bind_param('s', $id);
        $sql->execute();
        $res=$sql->affected_rows;
        $sql->close();
        return $res;
    }
}

?>