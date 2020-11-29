<?php
spl_autoload_register('modsAutoloader');
spl_autoload_register('ctrlAutoloader');
spl_autoload_register('classAutoloader');
spl_autoload_register('varAutoloader');
spl_autoload_register('classctrlAutoloader');
spl_autoload_register('varTemplatesAutoloader');
spl_autoload_register('allControllersLoader');
spl_autoload_register('allModelsLoader');

function allModelsLoader(){
    $path = 'modules/';
    $extension = '.php';
    $models = [
        'classes.mod.class',
        'courses.mod.class',
        'enrollment.mod.class',
        'schedule.mod.class',
        'students.mod.class',
        'teachers.mod.class',
        'usersAdmin.mod.class',
        'Admin.class',
        'class.class',
        'courses.class',
        'createNewValues.admin.class',
        'dayClasses.class',
        'DBconfig.class',
        'DBconnection.class',
        'DBqueries.class',
        'enrollment.class',
        'login.class',
        'schedule.class',
        'signIn.class',
        'student.class',        
        'teacher.class',        
        'updateData.class',
    ];

    foreach($models as $model){
        include_once $path.$model.$extension;
    }
}
function allControllersLoader(){
    $path = 'controllers/';
    $extension = '.php';
    $controllers = [
        'admin.ctrl',
        'logIn.ctrl',
        'router.class',
        'scheduleController',
        'signin.ctrl',
        'student.ctrl',        
    ];
    foreach($controllers as $controller){
        include_once $path.$controller.$extension;
    }
}

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
function varTemplatesAutoloader($className){
    $url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    $path = "tamplates/admin/";
    $extension = ".var.php";
    $fullpath =$path.$className.$extension;

    if(!file_exists($fullpath)){
        return false;
    }

    require_once $fullpath ;
}
?>