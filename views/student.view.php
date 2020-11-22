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
            <H1>HORARIO</H1>
            <div>SESSION DATA
            <?php var_dump($_SESSION);?><!--RELLLENO DE PRUEBA-->
            </div><br>
            <div>QUERY STUDENTS
            <?php
                require_once('Modules/students.mod.class.php');
                $res = new Students();
                $res->getAll();
                var_dump($res);
            ?>
            </div><br>
            <div>QUERY ADMIN
            <?php
                require_once('Modules/usersAdmin.mod.class.php');
                $res = new usersAdminMod();
                $res->getAll();
                var_dump($res);
            ?>
            </div><br>
            <div>QUERY SHEDULE
            <?php
                require_once('Modules/schedule.mod.class.php');
                $res = new ScheduleMod();
                $res->getAll();
                var_dump($res);
            ?>
            </div><BR>
            <div>QUERY ENROLLMENT
            <?php
                require_once('Modules/enrollment.mod.class.php');
                $res = new EnrollmentMod();
                $res->getAll();
                var_dump($res);
            ?>
            </div><BR>
            <div>QUERY CLASS
            <?php
                require_once('Modules/classes.mod.class.php');
                $res = new ClassesMod();
                $res->getAll();
                var_dump($res);
            ?>
            </div><br>
            <div>QUERY TEACHERS
            <?php
                require_once('Modules/teachers.mod.class.php');
                $res = new TeachersMod();
                $res->getAll();
                var_dump($res);
            ?>
            </div><br>
            <div>QUERY COURSES
            <?php
                require_once('Modules/courses.mod.class.php');
                $res = new CoursesMod();
                $res->getAll();
                var_dump($res);
            ?>
            </div><br>

            <!--EL CÓDIGO DE ARRIBA ES UNA PRUEBA-->
            
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