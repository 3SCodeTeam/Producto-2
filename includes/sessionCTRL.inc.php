
<?php
/*
Este código debe iniciar index.php para controlar que solo los usuarios que han iniciado sessión puedan acceder a la aplicación.
*/
    session_start();

    if ( isset( $_SESSION['user_id'] ) ) {
        //INSERTAR EL CÓDIGO AQUÍ.
    } else {
        // Redirect them to the login page
        header("Location: http://localhost/login.php");
    }
?>