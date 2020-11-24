<?php
include_once 'includes/autoLoader.inc.php';

if (isset($_GET['controller'])&&isset($_GET['method'])) {
    $route = new Router($_GET['controller'], $_GET['method']);
    $route -> call();
} else {
    $route = new Router('login', 'new');
    $route -> call();
}

?>
