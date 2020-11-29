<?php
class AdminClasses{
    public static $errormsg;
    
    public static $selectedCourseId;
    public static $selectedCourseStartDate;
    public static $selectedCourseEndDate;
    public static $selectedTeacherId; //ID Profesor seleccionado
    public static $status; //Inicial, clases   
    public static $selectedListOfClasses;    
    public static $selectedName;    
    public static $selectedColor;
    public static $hours = ['08:00', '09:00', '10:00', '11:00','12:00','13:00','14:00','15:00','16:00','17:00','18:00','19:00','20:00'];
    public static $dow = ['LUNES', 'MARTES','MIÉRCOLES', 'JUEVES', 'VIERNES', 'SÁBADO', 'DOMINGO'];


    public static function getClassName($ida, $hora){
        if(isset(AdminClasses::$selectedListOfClasses)){
            for($i=0; $i<count(AdminClasses::$selectedListOfClasses); $i++){
                if(AdminClasses::$selectedListOfClasses[$i]->class_day === $dia&&AdminClasses::$selectedListOfClasses[$i]->time_start === $hora){
                    return AdminClasses::$selectedListOfClasses[$i]->class_name;
                }
            }
        }
        return "";
    }
    public static function isSetHour($dia, $hora){
        if(isset(AdminClasses::$selectedListOfClasses)){
            for($i=0; $i<count(AdminClasses::$selectedListOfClasses); $i++){
                if(AdminClasses::$selectedListOfClasses[$i]->class_day === $dia&&AdminClasses::$selectedListOfClasses[$i]->time_start === $hora){
                    return true;
                }
            }
        }
        return false;
    }
    
    public static function getListOfFreeHours($day){
        $day = AdminClasses::getDayByName($day);        
        //AdminClasses::$hours = ['08:00', '09:00', '10:00', '11:00','12:00','13:00','14:00','15:00','16:00','17:00','18:00','19:00','20:00'];
        $freehours =[];        
        $ctrl = True;
            foreach(AdminClasses::$hours as $hour){
                foreach(AdminClasses::$selectedListOfClasses as $c){
                    if($c->class_day === $day&&$c->time_start === $hour){                    
                    $ctrl=false;
                    break;
                    }
                }
                if($ctrl){$freehours[] = $hour;}
                $ctrl = true;
            }
        return $freehours;
    }
        
    
    //MYSQL DAYOFWEEK() 1=Sunday, 2=Monday, 3=Tuesday, 4=Wednesday, 5=Thursday, 6=Friday, 7=Saturday.
    public static function getDayByName($day){        
        switch ($day){
            case 'SÁBADO': return "7";
            case 'VIERNES': return "6";
            case 'JUEVES': return "5";
            case 'MIÉRCOLES': return "4";
            case 'MARTES': return "3";
            case 'LUNES': return "2";
            case 'DOMINGO': return "1";
            case '1': return 'DOMINGO';
            case '2': return 'LUNES';
            case '3': return 'MARTES';
            case '4': return 'MIÉRCOLES';
            case '5': return 'JUEVES';
            case '6': return 'VIERNES';
            case '7': return 'SÁBADO';
        }
    }
}
?>