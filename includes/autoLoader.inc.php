<?php
spl_autoload_register('modsAutoloader');
spl_autoload_register('ctrlAutoloader');
spl_autoload_register('classAutoloader');
spl_autoload_register('varAutoloader');
spl_autoload_register('classctrlAutoloader');

function modsAutoloader($className){
    $url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    $path = "modules/";
    $extension = ".mod.class.php";
    $fullpath =$path.$className.$extension;

    if(strpos($url, 'includes') !== false){
        $path = '../modules/';
    }
    if(strpos($url, 'modules') !== false){
        $path = '';
    }
    else{
        $path = 'modules/';
    }

    if(!file_exists($fullpath)){
        
        return false;
    }
}
function classAutoloader($className){
    $url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    $path = "modules/";
    $extension = ".class.php";
    $fullpath =$path.$className.$extension;

    if(strpos($url, 'includes') !== false){
        $path = '../modules/';
    }
    if(strpos($url, 'modules') !== false){
        $path = '';
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
    if(strpos($url, 'modules') !== false){
        $path = '';
    }    
    else{
        $path = 'controllers/';
    }

    if(!file_exists($fullpath)){
        return false;
    }

    require_once $fullpath ;
}
function classctrlAutoloader($className){
    $url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    $path = "controllers/";
    $extension = ".ctrl.php";
    $fullpath =$path.$className.$extension;

    if(strpos($url, 'includes') !== false){
        $path = '../controllers/';
    }
    if(strpos($url, 'modules') !== false){
        $path = '';
    }    
    else{
        $path = 'controllers/';
    }

    if(!file_exists($fullpath)){
        return false;
    }

    require_once $fullpath ;
}
function varAutoloader($className){
    $url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    $path = "views/";
    $extension = ".var.php";
    $fullpath =$path.$className.$extension;

    if(strpos($url, 'includes') !== false){
        $path = '../views/';
    }
    if(strpos($url, 'views') !== false){
        $path = '';
    }    
    else{
        $path = 'views/';
    }

    if(!file_exists($fullpath)){
        return false;
    }

    require_once $fullpath ;
}
?>