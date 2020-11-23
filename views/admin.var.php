<?php
class AdminVar{
    public static $err;

    private static bool $teacher =false;
    private static bool $profile =false;
    private static bool $courses =false;
    private static bool $classes =false;
    private static bool $delete =false;
        
    //Getters
    public static function getTeacher(){return AdminVar::$teacher;}
    public static function getProfile(){return AdminVar::$profile;}
    public static function getCourses(){return AdminVar::$courses;}
    public static function getClasses(){return AdminVar::$classes;}
    public static function getDelete(){return AdminVar::$delete;}


    public static function activeMenu($value=null){
        AdminVar::inactiveAll();
        switch($value){
            case 'teacher': AdminVar::$teacher=true;break;
            case 'profile': AdminVar::$profile=true;break;
            case 'courses': AdminVar::$courses=true;break;
            case 'classes': AdminVar::$classes=true;break;
            case 'delete': AdminVar::$delete=true;break;                           
        }
    }

    private static function inactiveAll(){
        AdminVar::$teacher= false;
        AdminVar::$profile= false;
        AdminVar::$courses= false;
        AdminVar::$classes= false;
        AdminVar::$delete= false;
    }
}
?>