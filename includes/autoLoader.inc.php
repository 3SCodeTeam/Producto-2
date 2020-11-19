<?php

spl_autoload_register('modsAutoloader');
spl_autoload_register('ctrlAutoloader');

function modsAutoloader($className){
    $url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    $path = "modules/";
    $extension = ".class.php";
    $fullpath =$path.$className.$extension;

    if(strpos($url, 'includes') !== false){
        $path = '../modules/';
    }
    else{
        $path = 'modules/';
    }

    if(!file_exists($fullpath)){
        return false;
    }

    require_once $fullpath ;
}
function ctrlAutoloader($className){
    $url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    $path = "controllers/";
    $extension = ".class.php";
    $fullpath =$path.$className.$extension;

    if(strpos($url, 'includes') !== false){
        $path = '../controllers/';
    }
    else{
        $path = 'controllers/';
    }

    if(!file_exists($fullpath)){
        return false;
    }

    require_once $fullpath ;
}
?>