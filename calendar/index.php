<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
    <title>Calendario</title>
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
    <div align="center">
    <?php 
        require("calendar.php");
        if($_GET) {
            $month = $_GET["m"];
            $year = $_GET["y"];
        }
        else {
            $actualTime = time();
            $month = date("n", $actualTime);
            $year = date("Y", $actualTime);
        }
        displayCalendar($month, $year);

        // Añado LEYENDA con las asignaturas por alumno
        // if ($student.id_course = 1){
        //     leyendaDaw();
        // }
        // else {
        //     leyendaDam();
        // }
        leyendaDaw();
    ?>
    </div>
</body>
</html>