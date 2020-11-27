<?php
include_once 'includes/autoLoader.inc.php';
include_once 'modules/student.class.php';
if(!isset($_SESSION)){
    session_start();
}
if (isset($_GET['controller'])&&isset($_GET['method'])&&isset($_SESSION['token'])) {
    $route = new Router($_GET['controller'], $_GET['method']);
    $route -> call();
} else {
    $route = new Router('login', 'new');
    $route -> call();
}

?>
