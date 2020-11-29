<?php

class teachers {
    private $id_teacher;
    private $name;
    private $surname;
    private $telephone;
    private $nif;
    private $email;
  
    // Método constructor
    public function teachers($id_teacher, $name, $surname, $telephone, $nif, $email){
        $this->id_teacher = $id_teacher;
        $this->name = $name;
        $this->surname = $surname;
        $this->telephone = $telephone;
        $this->nif = $nif;
        $this->email = $email;
    }

    // Método constructor vacío
    public function __construct() {

    }

    // Setters
    public function setIdTeacher($id_teacher){
        $this->id_teacher = $id_teacher;
    }
    public function setName($name){
        $this->name = $name;
    }
    public function setSurname($surname){
        $this->surname = $surname;
    }
    public function setTelephone($telephone){
        $this->telephone = $telephone;
    }
    public function setNif($nif){
        $this->nif = $nif;
    }
    public function setEmail($email){
        $this->email = $email;
    }
    
    // Getters
    public function getIdTeacher(){
        return $this->id_teacher;
    }
    public function getName(){
        return $this->name;
    }
    public function getSurname(){
        return $this->surname;
    }
    public function getTelephone(){
        return $this->telephone;
    }
    public function getNif(){
        return $this->nif;
    }
    public function getEmail(){
        return $this->email;
    }
    
    // Método toString()
    public function __toString(){
        try{
            return (string) '#'.$this->id_teacher.' '.$this->name.' '.$this->surname.' '.$this->telephone.' '.$this->nif.' '.$this->email;
        }
        catch (Exception $excepction){
            return '';
        }
    }

    // public function toString(){
    //     try{
    //         return (string) $this->id_teacher.", '".$this->name."', '".$this->surname."', ".$this->telephone.", '".$this->nif."', '".$this->email."'";
    //     }
    //     catch (Exception $excepction){
    //         return '';
    //     }
    // }

    // Método mostrar listado
    // public function getAllTeachers() {
    //     $sql = "SELECT * FROM teachers";
    //     $result = $this->connect()->query($sql);
    //     $numRows = $result->num_rows;
    //     if ($numRows > 0) {
    //         while ($row = $result->fetch_assoc()) {
    //             $data[] = $row;
    //         }
    //         return $data;
    //     }
    // }
}