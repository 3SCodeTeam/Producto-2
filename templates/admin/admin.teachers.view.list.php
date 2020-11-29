<?php
include_once 'includes/autoloader.inc.php';
include_once 'modules/teachers.mod.class.php';

class ListOfTeachers{
    private $teachersList;
    private $tableClass;
    private $mod;

    /*
    public $email;
    public $id_teacher;
    public $name;    
    public $nif;
    public $surname;
    public $telephone;
    */

    public function __construct($tableClass){        
        $this->tableClass = $tableClass;
        $this->mod = new TeachersMod();        
        $this->teachersList = $this->mod->getAll();        
    }

    public function tableOfTeachers(){          
        if(!isset($this->teachersList)){
            return $this->printMsg("err-msg", "Error de conexión con la base de datos.");                        
        }
        if(count($this->teachersList) < 1){            
            return $this->printMsg("info-msg", "No hay profesores.");
        }
        
        return $this->buildTable();
    }

    private function printMsg($class, $msg){
        echo('<div class= "'.$class.'"><span>'.$msg.'</span></div>');
    }

    private function buildTable(){        
        echo('<table class="'.$this->tableClass.'"><tbody>');
        echo('<tr>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Email</th>
        <th>NIF</th>
        <th>Teléfono</th>
        </tr>');
        foreach($this->teachersList as $teacher){
            echo('<tr>');
            echo('<td><span>'.$teacher->name.'</span></td>');
            echo('<td><span>'.$teacher->surname.'</span></td>');
            echo('<td><span><a href="mailto:'.$teacher->email.'">'.$teacher->email.'</a></span></td>');            
            echo('<td><span>'.$teacher->nif.'</span></td>');
            echo('<td><span>'.$teacher->telephone.'</span></td>');
            echo('</tr>');
        }
        echo('</tbody></table>');                
    }

}

?>