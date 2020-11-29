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
            <?php require('templates/admin/admin.menu.view.php'); ?>
        </div>

        <div class= "nav-bar">
            <?php /*INSERTAR MENU NAV-BAR ESTUDIANTE*/ ?>
        </div>

        <div id="main-container">

            <?php
            /*INSERTAR CODIGO PHP PERFIL*///WORK IN PROGRESS
                require_once('views/admin.var.php');
                if(AdminVar::getProfile()){
                    require_once('templates/admin/admin.profile.view.php');
                }
            
            /*INSERTAR CODIGO PHP PROFESORES*///DONE
                require_once('views/admin.var.php');                
                if(AdminVar::getTeacher()){
                    require_once('templates/admin/admin.teachers.view.php');
                }
            
            /*INSERTAR CODIGO PHP CURSOS*///DONE
                require_once('views/admin.var.php');                
                if(AdminVar::getCourses()){
                    require_once('templates/admin/admin.courses.view.php');
                }
            
            /*INSERTAR CODIGO PHP ASIGNATURAS*///TODO
                require_once('views/admin.var.php');
                if(AdminVar::getClasses()){
                    require_once('templates/admin/admin.classes.view.php');
                    //require_once('views/error.view.php');
                }
                
            /*INSERTAR CODIGO PHP ELIMINAR*///TODO
                require_once('views/admin.var.php');
                if(AdminVar::getDelete()){
                    //require_once('templates/admin/admin.delete.view.php');
                    require_once('views/error.view.php');
                    
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