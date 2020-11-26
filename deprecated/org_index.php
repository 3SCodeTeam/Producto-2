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
include('controllers\router.class.php');
include('modules\DBconnection.class.php');
//require_once 'includes/autoLoader.inc.php';



$GLOBALS['connection'] = new DBconnection();
$GLOBALS['connection'] = $GLOBALS['connection']->dbconn();

session_start();


if ( isset( $_SESSION['user_id'] ) ) {

    //Todo las rutas que se ejecutan a partir de aquí deben ser para usuarios que han iniciado sesión.

    // Página de inicio.
    Route::add('/',function(){
        echo 'Welcome :-)';
    });

    // Simple test route that simulates static html file
    Route::add('/login',function(){
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

} else {
printf('Estoy aqui');
    //ATENCIÓN LA REDIRECCIÓN ESTÁNDAR HTTP ES AL PUERTO 80.
    //ES NECESARIO ESPECIFICAR EL PUERTO SI SE HA MODIFICADO EN XAMPP.
    Route::add('/', function(){        
        if(isset($_GET['controller'])&&isset($_GET['method'])){
            $controller = $_GET['controller'];
            $method = $_GET['method'];
            if($controller === 'login' && $method ==='login'){
                printf($_POST);
            }else{
                require("Location: http://localhost/public/error.php");
            }
        }else{
            require("Location: http://localhost/public/login.php");
        }        
     });    
}

Route::run('/');

/*<!--https://steampixel.de/en/simple-and-elegant-url-routing-with-php/-->*/

/*
$req = parse_url($_SERVER['REQUEST_URI']);
echo implode($req);
echo ($_SERVER['REQUEST_URI']);

if(isset($_GET['controller'])){
    echo $_GET['controller'];
    echo $_GET['action'];
}
*/
?>
