<?php
if(!isset($_SESSION)){
    session_start();
}        
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
    private $date;
    private $weekNum;
    private $mod;
    private $day;
    private $month;
    private $year;
    private $currentDate;
    private $firstDay;
    

    public function __construct(){
        date_default_timezone_set('Europe/London');
        $this->date = new DateTime(date("Y-m-d"));
        $this->weekNum = $this->date->format("W");
        $this->firstDay = $this->getFirstDate();
        $this->mod = new Students();  
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
                }            
            $date->add($plus1Day);
            }
            echo('</tr>');
        }
        //FIN TABLA
        echo('</tbody></table>');                
    }

    private function genClassesOfDay($date,$id){
        $date = $date->format("Y-m-d");
        $res = $this->mod->getClassesOfDay($date,$id);
        if(count($res)>0){
            foreach($res as $item){
                echo('<div class="color-'.$item->color.' class cell"><span>'.$item->name.'</span></div>');
            }
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
}

?>