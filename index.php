<?php
include_once 'includes/autoLoader.inc.php';

#session_start();
//El controlador y la acción del controlador se pasan en la URL. http://localhost/index.php?controller=controllerName&action=ActionName
//¿¿¿Controlamos el inicio de sessión en este punto con la variable $SESSIONS???

if (isset($_GET['controller'])&&isset($_GET['method'])) {
    $route = new Therouter($_GET['controller'], $_GET['method']);
    $route -> call();
} else {
    //Acción predeterminada si no se le pasa un controlador y acción en la ruta ó no se ha iniciado sessión.
    //Este controlador no debe controlar que exista sessión.
    
    $route = new Therouter('login', 'new');
    $route -> call();
}
//carga la vista layout.php
#require_once('Views/layout.php');

?>
