<?php

function displayCalendar($month, $year) {
    // Nombre del mes a mostrar.
    $monthName = getMonthName($month);
    // Construyo la tabla general.
    echo '<table class="calendar" cellspacing="3" cellpadding="2" border="0">';
    echo '<tr><td colspan"7" class="tit">';
    // Tabla para mostrar el mes, año, y los controles para pasar al mes anterior y siguiente.
    echo '<table width="100%" cellspacing="2" cellpadding="2" border ="0"><tr><td class="nextMonth">';
    // Calculo el mes y año anterior.
    $previousMonth = $month - 1;
    $previousYear = $year;
    if($previousMonth==0) {
        $previousYear--;
        $previousMonth=12;
    }
    echo '<a href="index.php?m='.$previousMonth.'&y='.$previousYear.'"><span>&lt;</span></a></td>';
    echo '<td class="titmonthyear">'.$monthName." ".$year.'</td>';
    echo '<td class="previousMonth">';
    // Calculo el mes y año siguiente.
    $nextMonth = $month + 1;
    $nextYear = $year;
    if($nextMonth==13) {
        $nextYear++;
        $nextMonth=1;
    }
    echo '<a href="index.php?m='.$nextMonth.'&y='.$nextYear.'"><span>&gt;</span></a></td>';
    // Finalizo la tabla de cabecera.
    echo '</tr></table>';
    echo '</td></tr>';
    // Fila con todos los días de la semana.
    echo '<tr>';
    echo '<td class="weekday"><span>LUNES</span></td>';
    echo '<td class="weekday"><span>MARTES</span></td>';
    echo '<td class="weekday"><span>MIÉRCOLES</span></td>';
    echo '<td class="weekday"><span>JUEVES</span></td>';
    echo '<td class="weekday"><span>VIERNES</span></td>';
    echo '<td class="weekday"><span>SÁBADO</span></td>';
    echo '<td class="weekday"><span>DOMINGO</span></td>';
    echo '</tr>';
    // Variable para llevar la cuenta del día actual.
    $actualDay = 1;
    // Calculo el número del día de la semana del primer día.
    $numDay = getNumDayWeek(1,$month, $year);
    $lastDay = getLastDayOfMonth($month, $year);
    // Escribo la primera fila de la semana.
    echo '<tr>';
    for($i=0; $i<7; $i++) {
        if($i < $numDay) {
            // si el día de la semana i es menor que el número del primer día de la semana no pongo nada en la celda.
            echo '<td class="invalidday"><span></span></td>';
        } else {
            echo '<td class="validday"><span>'.$actualDay.'</span></td>';
            $actualDay++;
        }
    }
    echo '</tr>';
    // Recorro todos los demás días hasta el final del mes.
    $numDay = 0;
    while($actualDay <= $lastDay) {
        // Si estamos a principio de la semana escribo el <tr>
        if($numDay==0)
            echo '<tr>';
        echo '<td class="validday"><span>'.$actualDay.'</span></td>';
        $actualDay++;
        $numDay++;
        // Si es el último día de la semana me pongo al proncipo de la semana y escribo el </tr>
        if($numDay==7) {
            $numDay = 0;
            echo '</tr>';
        }
    }
    // Compruebo qué celdas me faltan por escribir vacías de la última semana del mes.
    for($i=$numDay; $i<7; $i++) {
        echo '<td class="invalidday"><span></span></td>';
    }
    echo '</tr>';
    echo '</table>';
}

// Devuelve el número de día de la semana.
function getNumDayWeek($day, $month, $year) {
    $numDayWeek = date('w', mktime(0, 0, 0, $month, $day, $year));
    if($numDayWeek==0) $numDayWeek = 6;
    else $numDayWeek--;
    return $numDayWeek;
}

// Devuelve el último día del mes.
function getLastDayOfMonth($month, $year) {
    $lastDay = 28;
    while(checkdate($month, $lastDay+1, $year)) $lastDay++;
    return $lastDay;
}

// Devuelve el nombre del mes.
function getMonthName($month) {
    switch($month) {
        case 1:
            $monthName = "ENERO";
            break;
        case 2:
            $monthName = "FEBRERO";
            break;
        case 3:
            $monthName = "MARZO";
            break;
        case 4:
            $monthName = "ABRIL";
            break;
        case 5:
            $monthName = "MAYO";
            break;
        case 6:
            $monthName = "JUNIO";
            break;
        case 7:
            $monthName = "JULIO";
            break;
        case 8:
            $monthName = "AGOSTO";
            break;
        case 9:
            $monthName = "SEPTIEMBRE";
            break;
        case 10:
            $monthName = "OCTUBRE";
            break;
        case 11:
            $monthName = "NOVIEMBRE";
            break;
        case 12:
            $monthName = "DICIEMBRE";
            break;
    }
    return $monthName;
}

// Funcion mostrar LEYENDA DAW
function leyendaDaw(){
    $clases = [];
    $clases[0] = 'Programacion';
    $clases[1] = 'Bases de datos';
    $clases[2] = 'Diseño grafico';
    $clases[3] = 'Aplicaciones escritorio';
    $clases[4] = 'Aplicaciones web';
    echo '<table><td><strong>Clases:</strong></td></table>';
    $array = implode('<br>', $clases);
    echo $array;
}

// Funcion mostrar LEYENDA DAM
function leyendaDam(){
    $clases = [];
    $clases[0] = 'Programacion';
    $clases[1] = 'Bases de datos';
    $clases[2] = 'Ciberseguridad';
    $clases[3] = 'Aplicaciones escritorio';
    $clases[4] = 'Aplicaciones moviles';
    echo '<table><td><strong>Clases:</strong></td></table>';
    $array = implode('<br>', $clases);
    echo $array;
}

?>