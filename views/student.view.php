<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Iniciar Sesión</title>
        <link rel="stylesheet" href="Recursos/css/style.css">
        <link rel="stylesheet" href="Recursos/css/login.css">
        <link rel="stylesheet" href="Recursos/css/student.css">
        <link rel="stylesheet" href="Recursos/css/menu.css">
    </head>
    <body>
        <?php    
        require("Recursos/html/header.html");
        ?>
        <div class= "nav-bar">
            <?php require_once('templates/student.menu.view.php'); ?>
        </div>

        <div id="main-container">
            <h1>HORARIO</h1>
            <?php /*INSERTAR CODIGO PHP HORARIO*/
                require_once('templates/student/student.schedule.view.php');
                $schedule = new ScheduleGen();
                $schedule->builSchedule();
            ?>
            <?php /*INSERTAR CODIGO PHP PERFIL*/ ?>
            <?php /*INSERTAR CODIGO PHP MATRICULA*/ ?>
        </div>            

        <div class="alert-msg">
            <?php
            require_once('login.var.php');
            if(isset(LogInvar::$errormsg)){echo('<div class="errmsg">'.LogInvar::$errormsg.'</div>');}
            ?>
        </div>
            
        <?php include("Recursos/html/footer.html"); ?>
    </body>
</html>