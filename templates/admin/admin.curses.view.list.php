<?php
include_once 'includes/autoloader.inc.php';


class ListOfCourses{
    private $coursesList =[];
    private $tableClass;
    private $mod;

    /*
   public $active;
    public $date_end;
    public $date_start;
    public $description;
    public $id_course;
    public $name;
    */

    public function __construct($tableClass){        
        $this->tableClass = $tableClass;
        $this->mod = new CoursesMod();        
        
    }

    public function tableOfCourses(int $status){        
        $this->coursesList = $this->mod->getByStatus($status);
               
        if(!isset($this->coursesList)){
            return $this->printMsg("err-msg", "Error de conexión con la base de datos.");                        
        }
        if(count($this->coursesList) < 1){            
            return $this->printMsg("info-msg", "No hay cursos.");
        }
        
        return $this->buildTable($status);
    }

    private function printMsg($class, $msg){
        echo('<div class= "'.$class.'"><span>'.$msg.'</span></div>');
    }

    private function buildTable($status){
        if($status){            
            echo('<div class="table-title-courses">Cursos Activos</div>');
        }else{
            echo('<div class="table-title-courses">Cursos Inactivos</div>');
        }
        
        echo('<table class="'.$this->tableClass.'"><tbody>');
        echo('<tr>
        <th>Nombre</th>
        <th>Inicio</th>
        <th>Fin</th>        
        <th>Descripción</th>
        </tr>');
        foreach($this->coursesList as $course){
            echo('<tr>');
            echo('<td><span>'.utf8_encode($course->name).'</span></td>');
            echo('<td><span>'.$course->date_start.'</span></td>');
            echo('<td><span>'.$course->date_end.'</span></td>');            
            echo('<td><span class="course-cell description">'.$course->description.'</span></td>');
            echo('</tr>');
        }
        echo('</tbody></table>');                
    }
}

?>