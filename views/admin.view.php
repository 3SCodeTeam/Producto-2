<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Iniciar Sesión</title>
        <link rel="stylesheet" href="Recursos/css/style.css">
        <link rel="stylesheet" href="Recursos/css/login.css">
        <link rel="stylesheet" href="Recursos/css/admin.css">
        <link rel="stylesheet" href="Recursos/css/menu.css">
    </head>
    <body>
        <?php    
        require("Recursos/html/header.html");
        ?>

        <div class= "nav-bar">
            <?php require('templates/admin.menu.view.php'); ?>
        </div>

        <div class= "nav-bar">
            <?php /*INSERTAR MENU NAV-BAR ESTUDIANTE*/ ?>
        </div>

        <div id="main-container">

            <?php /*INSERTAR CODIGO PHP PERFIL*/
                require_once('views/admin.var.php');
                if(AdminVar::getProfile()){
                    require_once('templates/admin.profile.view.php');
                }
             ?>
            <?php /*INSERTAR CODIGO PHP PROFESORES*/
                require_once('views/admin.var.php');                
                if(AdminVar::getTeacher()){
                    require_once('templates/admin.teachers.view.php');
                }
             ?>
            <?php /*INSERTAR CODIGO PHP CURSOS*/
                require_once('views/admin.var.php');
                if(AdminVar::getCourses()){
                    require_once('templates/admin.courses.view.php');
                }
             ?>
            <?php /*INSERTAR CODIGO PHP ASIGNATURAS*/
                require_once('views/admin.var.php');
                if(AdminVar::getClasses()){
                    require_once('templates/admin.classes.view.php');
                }
            ?>
            <?php /*INSERTAR CODIGO PHP ELIMINAR*/
                require_once('views/admin.var.php');
                if(AdminVar::getDelete()){
                    require_once('templates/admin.delete.view.php');
                }
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