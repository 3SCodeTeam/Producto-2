<?php
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>3SCode Academy Manager</title>
        <link rel="stylesheet" href="/Recursos/css/style.css">
        <link rel="stylesheet" href="/Recursos/css/signin.css"> 
    </head>
    <body>
    <?php include("G:\\repos\\UOC\\3SCode\\Producto2\\Recursos\\html\\header.html");?>
        <div>
            <h1>Registrate<h1>
             <span>o <a href="http://localhost/public/login.php">Inicia sesión.</a></span>
        </div>
        <div class="main-container">
            <form action="" method="post">
                <div>
                <input type="text" name="username" placeholder="Nombre de usuario" required>
                <input type="text" name="email" placeholder="Email" required>
                <input type="password" name="pass" placeholder="Contraseña" required>
                <input type="password" name="pass_check" placeholder="Confirmar la contraseña" required>
                <input type="text" name="nombre" placeholder="Nombre" required>
                <input type="text" name="apellidos" placeholder="Apellidos" required>
                <input type="text" name="tel" placeholder="Teléfono">
                <input type="submit" value="Enviar">
                </div>
            </form>
        </div>
        <?php include("G:\\repos\\UOC\\3SCode\\Producto2\\Recursos\\html\\footer.html"); ?>
    </body>    
</html>