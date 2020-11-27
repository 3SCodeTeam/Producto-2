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
            <?php require_once('templates/student/student.menu.view.php'); ?>
        </div>

        <div id="main-container">
            <h1><?php echo(strtoupper(StudentMenu::$menu));?></h1>
            <?php
            /*INSERTAR CODIGO PHP HORARIO*/                
                if(StudentMenu::$menu === 'mSchedule'){
                    require_once('templates/student/student.schedule.view.php');
                    $schedule = new ScheduleGen();
                    $schedule->builSchedule();
                }
                if(StudentMenu::$menu === 'wSchedule'){require_once('views/error.view.php');} //SEMANAL
                if(StudentMenu::$menu === 'dSchedule'){require_once('views/error.view.php');} //DIARIO
            
                /*INSERTAR CODIGO PHP PERFIL*/                 
                if(Studentmenu::$menu ==='profile'){
                    require_once('templates/student/student.profile.view.php');                    
                }
            
                /*INSERTAR CODIGO PHP MATRICULA*/ 
                if(StudentMenu::$menu === 'enrollment'){require_once('views/error.view.php');}
            ?>
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