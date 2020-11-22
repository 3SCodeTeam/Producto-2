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
    ?>
    </div>
</body>
</html>