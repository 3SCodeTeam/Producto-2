<?php

class classes {
    private $id_class;
    private $id_teacher;
    private $id_course;
    private $id_schedule;
    private $name;
    private $color;
  
    // Método constructor
    public function classes($id_class, $id_teacher, $id_course, $id_schedule, $name, $color){
        $this->id_class = $id_class;
        $this->id_teacher = $id_teacher;
        $this->id_course = $id_course;
        $this->id_schedule = $id_schedule;
        $this->name = $name;
        $this->color = $color;
    }
    
    // Método constructor vacío
    public function __construct() {

    }

    // Setters
    public function setIdClass($id_class){
        $this->id_class = $id_class;
    }
    public function setIdTeacher($id_teacher){
        $this->id_teacher = $id_teacher;
    }
    public function setIdCourse($id_course){
        $this->id_course = $id_course;
    }
    public function setIdSchedule($id_schedule){
        $this->id_schedule = $id_schedule;
    }
    public function setIdName($name){
        $this->name = $name;
    }
    public function setIdColor($color){
        $this->color = $color;
    }
    
    // Getters
    public function getIdClass(){
        return $this->id_class;
    }
    public function getIdTeacher(){
        return $this->id_teacher;
    }
    public function getIdCourse(){
        return $this->id_course;
    }
    public function getIdSchedule(){
        return $this->id_schedule;
    }
    public function getIdName(){
        return $this->name;
    }
    public function getIdColor(){
        return $this->color;
    }
    
    // Método toString()
    public function __toString(){
        try{
            return (string) '#'.$this->id_class.' '.$this->id_teacher.' '.$this->id_course.' '.$this->id_schedule.' '.$this->name.' '.$this->color;
        }
        catch (Exception $excepction){
            return '';
        }
    }
}