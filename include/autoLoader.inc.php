<?php

spl_autoload_register('autoloader');

function autoloader($className){
    $url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    $path = "modules/";
    $extension = ".class.php";
    $fullpath =$path.$className.$extension;

    if(strpos($url, 'includes')!== false){
        $path = '../modules/';
    }
    else{
        $path = 'modules/';
    }

    if(!file_exists($fullpath)){
        return false;
    }

    include_once $fullpath;
}
?>