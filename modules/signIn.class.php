<?php
include_once 'includes/autoloader.inc.php';
require_once 'modules/students.mod.class.php';
class SignIn {

    private $date_registered;
    private $email;
    private $name;
    private $nif;
    private $pass;
    private $pass_check;
    private $surname;
    private $telephone;
    private $username;
    private $errmsg;
    private $mod;


    public function __construct(){
        $this->name = $_POST['name'];
        $this->surname= $_POST['surname'];        
        $this->telephone =$_POST['telephone'];
        $this->date_registered = date("Y/m/d h:m:s");
        $this->pass_check = $_POST['password_check'];
        $this->mod = new Students();
    }

    public function newStudent(){        
        if(!$this->checkUsername()){
            $this->error();
        }else{
            if(!$this->checkEmail()){
                $this->error();
            }else{
                if(!$this->checkNif()){
                   $this->error();
                }else{
                    if(!$this->checkPasswordLength()){
                        $this->error();
                    }else{                                                
                        $res = $this->mod->insertValues($this->date_registered, $this->email, $this->name, $this->nif, $this->password, $this->surname, $this->telephone,$this->username);
                        if($res>0){
                            require_once('controllers/logIn.ctrl.php');
                            $controller = new LogInController();
                            return $controller -> error('¡Usuario registrado! Inicie sesión.');
                        }else{
                            $this->error('Error desconocido al generar el registro. Pongase en contacto con el administrador.');
                        }
                        
                    }
                }
            }
        }
    }

    private function checkUsername(){
        if(ctype_alnum($_POST['username'])){
            $res = $this->mod->getByUsername($_POST['username']);
            if(strlen($_POST['username'])<6){
                $this->errmsg ="El nombre de usuario no cumple las especificaciones.";
                return false;
            }
            if(isset($res[0]->id)){ //Verificamos q el nombre no existe.
                $this->errmsg = 'Este usuario ya está registrado.';
                return false;
            }
            $this->username = $_POST['username'];
            return true;         
        }  
        $this->errmsg ="Nombre de usuario no válido.";
        return false;
    }

    private function checkEmail(){        
        $res = $this->mod->getByUsername($_POST['email']);
        if(isset($res[0]->id)){ //Verificamos q el email no existe.
            $this->errmsg ='Este email ya está en uso.';
            return false;
        }
        if(strlen($_POST['email'])<4&&!substr($_POST['email'],-4).includes('.')){
            $this->errmsg ='Este email es inválido.';
            return false;
        }
        $this->email = $_POST['email'];
        return true;
    }
    private function checkNif(){
        if(strlen($_POST['nif']>9)||ctype_alnum(substr($_POST['nif'],-1))){
            $this->nif = $_POST['nif'];
            return true;
        }        
        $this->errmsg = 'NIF incorrecto';
        return false;
    }
    private function checkPasswordLength(){
        if(strlen($_POST['password'])<6){
            $this->errmsg = 'La contraseña debe tener al menos 6 caracteres.';
            return false;
        }
        if($_POST['password_check']!=$_POST['password']){
            $this->errmsg ='Las contraseñas no coinciden.';
            return false;
        }        
        $this->password = crypt($_POST['password'],'$6$Nodejesquemeentiendan.Guardameelsecreto.');
        return true;
    }

    private function error($err=NULL){
        require_once('views/signin.var.php');
        if(isset($this->errmsg)){
            SignInvar::$errormsg = $this->errmsg;
        }
        if(isset($err)){
            SignInvar::$errormsg = $err;
        }
        require_once('views/signin.view.php');
    }
}
?>