<?php
class StudentMenu{
    public static $menu;
    public static $err;

    private static bool $enrollment=false;
    private static bool $profile =false;
    private static bool $dSchedule =false;
    private static bool $wSchedule =false;
    private static bool $mSchedule =false;
        
    //Getters
    public static function getEnrollment(){return StudentMenu::$enrollment;}
    public static function getProfile(){return StudentMenu::$profile;}
    public static function getdSchedule(){return StudentMenu::$dSchedule;}
    public static function getwSchedule(){return StudentMenu::$wSchedule;}
    public static function getmSchedule(){return StudentMenu::$mSchedule;}


    public static function activeMenu($value=null){
        StudentMenu::inactiveAll();
        switch($value){
            case 'enrollment': StudentMenu::$enrollment=true;break;
            case 'profile': StudentMenu::$profile=true;break;
            case 'dSchedule': StudentMenu::$dSchedule=true; break;
            case 'wSchedule': StudentMenu::$wSchedule=true;break;
            case 'mSchedule': StudentMenu::$mSchedule=true;break;                           
        }
        StudentMenu::$menu=$value;
    }

    private static function inactiveAll(){
        StudentMenu::$enrollment= false;
        StudentMenu::$profile= false;
        StudentMenu::$dSchedule= false;
        StudentMenu::$wSchedule= false;
        StudentMenu::$mSchedule= false;
    }  

    /**
     * Get the value of menu
     */ 
    public function getMenu(){return $this->menu;}

    public function setMenu($menu)
    {
        $this->menu = $menu;
        return $this;
    }
}