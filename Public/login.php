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
                    <select name="rol_option" id="rol" form="login" required>
                        <option type="text" value="student">Estudiante</option>
                        <option type="text" value="teacher">Profesor</option>
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
        </div>
        <?php include("G:\\repos\\UOC\\3SCode\\Producto2\\Recursos\\html\\footer.html"); ?>
    </body>
</html>