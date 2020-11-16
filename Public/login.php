<?php
    require("G:\\repos\\UOC\\3SCode\\Producto2\\Modulos\\db\\database.php");

    $prueba = new DataManager();
    $prueba -> dbConnect();    
    echo $prueba -> get_Estudiantes();

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Iniciar Sesión</title>
        <link rel="stylesheet" href="/Recursos/css/style.css">
        <link rel="stylesheet" href="/Recursos/css/login.css"> 
    </head>
    <body>
    <?php
    require("G:\\repos\\UOC\\3SCode\\Producto2\\Recursos\\html\\header.html");
    /* include("G:\\repos\\UOC\\3SCode\\Producto2\\Recursos\\html\\header.html"); */
    ?>
        <div class= "main-container">
            <div>
                <h1>Inicia sesión</h1>
                <span>o <a href="http://localhost/public/signin.php">Registrate</a></span>
            </div>
            <div class="form-container">
            <div class="selector-container">
                <label for="rol">Perfil:</label>
                <select name="rol" id="rol" form="login">
                    <option value="Estudiante">Estudiante</option>
                    <option value="Profesor">Profesor</option>
                    <option value="Admin">Administrador</option>                                
                </select>                        
            </div>
                <form action="public/login.php" method="post" form="login">
                    <div><input type="text" name="username" placeholder="Nombre de usuario" required></div>
                    <div><input type="text" name="email" placeholder="Email" required></div>
                    <div><input type="password" name="pass" placeholder="Contraseña" required></div>                    
                    <div><input type="submit" value="Enviar"></div>
                </form>                
            </div>
        </div>
        <?php include("G:\\repos\\UOC\\3SCode\\Producto2\\Recursos\\html\\footer.html"); ?>
    </body>
</html>