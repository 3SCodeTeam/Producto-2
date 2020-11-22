<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Iniciar Sesión</title>
        <link rel="stylesheet" href="Recursos/css/style.css">
        <link rel="stylesheet" href="Recursos/css/login.css"> 
    </head>
    <body>
    <?php    
    require("Recursos/html/header.html");
    ?>
        <div class= "main-container">
            <div>
                <h1>Inicia sesión</h1>
                <span>o <a href="http://localhost/?controller=signin&method=new">Registrate</a></span>
            </div>
            <div class="form-container">
                <div class="selector-container">
                    <label for="rol">Perfil:</label>
                    <select name="rol_option" id="rol" form="login" required>
                        <option type="text" value="student">Estudiante</option>
                        <!--<option type="text" value="teacher">Profesor</option>-->
                        <option type="text" value="admin">Administrador</option>                                
                    </select>                        
                </div>            
                <form action="/?controller=login&method=post" method="post" id="login">
                    <div><input type="text" name="username" placeholder="Nombre de usuario" required></div>
                    <div><input type="email" name="email" placeholder="Email" required></div>
                    <div><input type="password" name="pass" placeholder="Contraseña" required></div>                    
                    <div><input type="submit" value="Enviar"></div>
                </form>                
            </div>
            <?php
                require_once('login.var.php');
                if(isset(LogInvar::$errormsg)){echo('<div class="errmsg">'.LogInvar::$errormsg.'</div>');}
                ?>
        </div>
        <?php include("Recursos/html/footer.html"); ?>
    </body>
</html>