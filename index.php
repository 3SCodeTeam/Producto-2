<?php

//ESTE PARTE DEL CÓDIGO DEBE ADAPTARSE A CADA SERVIDOR
/* ################################################# */
$path = '\repos\UOC\3SCode\Producto2\Modulos';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);
$path = '\repos\UOC\3SCode\Producto2\Public';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);
$path = '\repos\UOC\3SCode\Producto2\Recursos';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);
/* ################################################# */

// Include router class
include('router.php');


session_start();

if ( isset( $_SESSION['user_id'] ) ) {

    //Todo las rutas que se ejecutan a partir de aquí deben ser para usuarios que han iniciado sesión.

    // Página de inicio.
    Route::add('/',function(){
        echo 'Welcome :-)';
    });

    // Simple test route that simulates static html file
    Route::add('/test',function(){
        require 'test.php';
        #echo 'Hello from test.php';
    });

    // Post route example
    Route::add('/contact-form',function(){
        echo '<form method="post"><input type="text" name="test" /><input type="submit" value="send" /></form>';
    },'get');

    // Post route example
    Route::add('/contact-form',function(){
        echo 'Hey! The form has been sent:<br/>';
        print_r($_POST);
    },'post');

    // Accept only numbers as parameter. Other characters will result in a 404 error
    Route::add('/foo/([0-9]*)/bar',function($var1){
        echo $var1.' is a great number!';
    });

    Route::run('/');
} else {

    //ATENCIÓN LA REDIRECCIÓN ESTÁNDAR HTTP ES AL PUERTO 80.
    //ES NECESARIO ESPECIFICAR EL PUERTO SI SE HA MODIFICADO EN XAMPP.
    
    header("Location: http://localhost/public/wellcome.php");
}
/*<!--https://steampixel.de/en/simple-and-elegant-url-routing-with-php/-->*/
?>