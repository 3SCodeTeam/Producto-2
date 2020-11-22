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
            <?php require_once('templates/teacher.menu.view.php'); ?>
        </div>

        <div class= "nav-bar">
            <?php /*INSERTAR MENU NAV-BAR ESTUDIANTE*/ ?>
        </div>

        <div id="main-container">
    
            <H1>HORARIO</H1>
            
            <?php var_dump($_SESSION);?><!--RELLLENO DE PRUEBA-->

            <?php /*INSERTAR CODIGO PHP HORARIO*/ ?>
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