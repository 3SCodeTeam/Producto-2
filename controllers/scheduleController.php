<?php

class scheduleController extends schedule {

    // Funcion insertar horarios para todo el curso en funcion dia semana
    public function insertScheduleAuto() {
        $date = '2020-09-01'; // guardamos fecha inicio curso
        
        while ($date <= '2021-06-30') { // condicion fecha fin curso
            $day = date('l', strtotime($date));
            switch ($day) {
                case "Monday":
                    // llamar a funcion MONDAY schedule
                break;
                case "Tuesday":
                    // llamar a funcion TUESDAY schedule
                break;
                case "Wednesday":
                    // llamar a funcion WEDNESDAY schedule
                break;
                case "Thursday":
                    // llamar a funcion THURSDAY schedule
                break;
                case "Friday":
                    // llamar a funcion FRIDAY schedule
                break;
            }
            $date++;
        }
    }

    // Funcion horario Monday
    public function mondaySchedule() {
        $hora = []; // declaramos array para las 6 horas diarias
        $hora[0] = 'Programacion';
        $hora[1] = 'Programacion';
        $hora[2] = '';
        $hora[3] = '';
        $hora[4] = 'Bases de datos';
        $hora[5] = 'Bases de datos';
        
        $array = implode("\n", $hora); // devuelve las asignaturas por hora
        echo $array;
    }
}