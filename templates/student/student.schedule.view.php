<?php

include_once 'includes/autoLoader.inc.php'; 
include_once 'modules/students.mod.class.php';
class ScheduleGen{


    /*
    SELECT
    S.id_class,
    S.day,
    C.name,
    C.color,
    Co.name
    FROM schedule as S inner JOIN class as C ON S.id_class=C.id_class INNER JOIN courses as Co ON C.id_course = Co.id_course
    WHERE id_course IN (SELECT id_course FROM enrollment WHERE id_student = ?) and S.day = ?;
    */

    /*
        jddayofweek($date);
        0 (Por defecto)	Devuelve el número de día como un entero (0=domingo, 1=lunes, etc.)
        1	Devuelve una cadena que contiene el día de la semana (Inglés-Gregoriano)
        2	Devuelve una cadena que contiene el día de la semana abreviado (Inglés-Gregoriano)
    */
    /*   
        DateTime();
        DateTime()->format("W"); weekNum
        DateTime()->format("Y"); year
        DateTime()->format("m"); month
        DateTime()->format("D"); day of the week

        DateTime()->sub(new DateInterval('P10D'));
        DateTime()->add(new DateInterval('P10D'));

        date("Y/m/d")
        date("Y.m.d")
        date("Y-m-d")
        date("l")
        
    */
    private $id_student;
    private $date;
    private $weekNum;
    private $mod;
    private $day;
    private $month;
    private $year;
    private $currentDate;
    private $firstDay;
    private $hours = ['08:00', '09:00', '10:00', '11:00','12:00','13:00','14:00','15:00','16:00','17:00','18:00','19:00','20:00'];
    private $dow = ['SEMANA','LUNES', 'MARTES','MIÉRCOLES', 'JUEVES', 'VIERNES', 'SÁBADO', 'DOMINGO'];

    public function __construct(){
        date_default_timezone_set('Europe/London');
        $this->date = new DateTime(date("Y-m-d"));
        $this->date = $this->getCurrentMonthFristDay();
        $this->weekNum = $this->date->format("W");
        $this->firstDay = $this->getFirstDate();
        $this->mod = new Students();
        $this->id_student = $_SESSION['sql_user_id'];
    }

    private function getCurrentMonthFristDay(){
        $month = $this->date->format("m");
        $year = $this->date->format("Y");
        $newdateString = $year.'-'.$month.'-01';
        $fdate = new DateTime($newdateString);
        return $fdate;
    }
    public function buildWeekSchedule(){
        $plus1Hour = new DateInterval('PT1H');
        $startHour = $this->hours[0];
        $date = $this->getFirstDate();

        //CUERPO DE LA TABLA
        echo('<table><tbody>');        
        echo('<tr>');

        //CABECERA DE LA TABLA
        foreach($dow as $d){        
            echo('<th>'.$d.'</th>');
        }        
        echo('</tr>');

        //TABLA HORARIO SEMANA
        for($i = 0; $i < count($hours); $i++){
            echo('<tr class="row week">');
            foreach($this->dow as $d){
                if(!$d === 'SEMANA'){
                    echo('<td class="dow col '.$d.'">'.$this->getClassesOfDay($date, $this->id_student).'</td>');
                }
            }
        }

    }

    public function builSchedule(){        
        $plus1Day = new DateInterval('P1D');
        $dow = ['SEMANA','LUNES', 'MARTES','MIÉRCOLES', 'JUEVES', 'VIERNES', 'SÁBADO', 'DOMINGO'];        
        $date = $this->firstDay;

        //CUERPO DE LA TABLA
        echo('<table><tbody>');        
        echo('<tr>');
        
        //CABECERA DE LA TABLA
        foreach($dow as $d){        
            echo('<th>'.$d.'</th>');
        }        
        echo('</tr>');

        //TABLA HORARIOS
        for($i =$this->weekNum; $i < $this->weekNum+6; $i++){
            echo('<tr class="row week">');
            foreach($dow as $d){
                if($d==='SEMANA'){
                    echo('<td class="week col '.$d.'"><span>'.$i.'</span></td>');
                }else{
                    echo('<td class="dow col '.$d.'">'.$this->genClassesOfDay($date, $_SESSION['sql_user_id']).'</td>');
                    $date->add($plus1Day);
                }                        
            }
            echo('</tr>');
        }
        //FIN TABLA
        echo('</tbody></table>');
        
        //LEYENDA
        echo('<br>'.'<br>');
        $this->leyenda();

        // $student = new student;
        // if ($student.course == 1){
        //     $this->leyendaDaw();
        // }
        // else {
        //     $this->leyendaDam();
        // }
    }

    private function genClassesOfDay($date,$id){
        $string ='';        
        $date = $date->format("Y-m-d");        
        $res = $this->mod->getClassesOfDay($id, $date);        
        if(count($res)>0){            
            foreach($res as $item){
                $string.='<div class="color-'.$item->class_color.' class cell"><span style="color: '.htmlspecialchars($item->class_color).'" >'.$item->class_name.'</span></div>';               
            }
            return $string;
        }else{
            //return '<div class="empty class cell"><span>'.$d->format("d").'</span></div>';
        }

    }

    private function getFirstDate(){
        $date = $this->date;
        $days = 0;
        switch($this->date->format("D")){
            case 'Mon': return $date;
            case 'Tue': $days+=1; break;
            case 'Wed': $days+=2; break;
            case 'Thu': $days+=3; break;
            case 'Fry': $days+=4; break;
            case 'Sat': $days+=5; break;
            case 'Sun': $days+=6; break;
        }
        return $date->sub($this->subDaystoDate($days));
    }
    
    private function subDaystoDate($numOfDays){
        return new DateInterval('P'.$numOfDays.'D');
    }

      
    // Funcion mostrar LEYENDA universal
    function leyenda(){
        $clases = [];
        $clases[0] = '<t style="color:#ff0000;">Programacion</t>';
        $clases[1] = '<t style="color:#ffcc00;">Bases de datos</t>';
        $clases[2] = '<t style="color:#00ff00;">Diseño grafico</t>';
        $clases[3] = '<t style="color:#00ccff;">Aplicaciones escritorio</t>';
        $clases[4] = '<t style="color:#9900ff;">Aplicaciones web</t>';
        echo '<table><td><strong>Clases DAW:</strong></td></table>';
        echo('<br>'.'<br>');
        $array = implode('<br>', $clases);
        echo $array;
        echo('<br>'.'<br>');

        $clases = [];
        $clases[0] = '<t style="color:#ff0000;">Programacion</t>';
        $clases[1] = '<t style="color:#ffcc00;">Bases de datos</t>';
        $clases[2] = '<t style="color:#00ff00;">Ciberseguridad</t>';
        $clases[3] = '<t style="color:#00ccff;">Aplicaciones escritorio</t>';
        $clases[4] = '<t style="color:#9900ff;">Aplicaciones moviles</t>';
        echo '<table><td><strong>Clases DAM:</strong></td></table>';
        echo('<br>'.'<br>');
        $array = implode('<br>', $clases);
        echo $array;
    }
    
    // Funcion mostrar LEYENDA DAW
    function leyendaDaw(){
        $clases = [];
        $clases[0] = '<t style="color:#ff0000;">Programacion</t>';
        $clases[1] = '<t style="color:#ffcc00;">Bases de datos</t>';
        $clases[2] = '<t style="color:#00ff00;">Diseño grafico</t>';
        $clases[3] = '<t style="color:#00ccff;">Aplicaciones escritorio</t>';
        $clases[4] = '<t style="color:#9900ff;">Aplicaciones web</t>';
        echo '<table><td><strong>Clases:</strong></td></table>';
        echo('<br>'.'<br>');
        $array = implode('<br>', $clases);
        echo $array;
    }

    // Funcion mostrar LEYENDA DAM
    function leyendaDam(){
        $clases = [];
        $clases[0] = '<t style="color:#ff0000;">Programacion</t>';
        $clases[1] = '<t style="color:#ffcc00;">Bases de datos</t>';
        $clases[2] = '<t style="color:#00ff00;">Ciberseguridad</t>';
        $clases[3] = '<t style="color:#00ccff;">Aplicaciones escritorio</t>';
        $clases[4] = '<t style="color:#9900ff;">Aplicaciones moviles</t>';
        echo '<table><td><strong>Clases:</strong></td></table>';
        echo('<br>'.'<br>');
        $array = implode('<br>', $clases);
        echo $array;
    }
}

?>