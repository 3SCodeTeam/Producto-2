<? php
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
        <div class= "main-container">
            <h1>Iniciar Sesión<h1>
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
    </body>
    <?php include("G:\\repos\\UOC\\3SCode\\Producto2\\Recursos\\html\\footer.html"); ?>
</html>