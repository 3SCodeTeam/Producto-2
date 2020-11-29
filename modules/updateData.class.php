<?php
include_once 'modules/admin.class.php';
include_once 'modules/usersAdmin.mod.class.php';
include_once 'modules/students.mod.class.php';
include_once 'includes/autoloader.inc.php';

class updateData{
    public $err;
    private $dataStore;    
    private $mod;
    private $userId;
    private $param;
    

    public function __construct(

    ){}

    public function updateAdminData(){
        $this->mod = new usersAdminMod();
        $this->userId = $_SESSION['user_data']->id_user_admin;
        if(!$this->initDataUpdate()){
            return false;
        };
        switch ($this->param) {
            case 'email': return $this->checkEmail();                            
            case 'name': return $this->checkName();            
            case 'username': return $this->checkUsername();
            case 'pass': return $this->checkPass();
        }
    }
    public function updateStudentData(){
        $this->mod = new Students();
        $this->userId = $_SESSION['user_data']->id;
        if(!$this->initDataUpdate()){
            return false;
        };
        switch ($this->param) {
            case 'email':
                return $this->checkEmail();
            case 'name':
                return $this->checkName();            
            case 'username':
                return $this->checkUsername();
            case 'nif':
                if($_SESSION['user_data'] === $this->dataStore){
                    $this->res = "El valor propuesto y el actual son identicos.";
                    return false;
                }
                $res = $this->mod->getByUsername($this->dataStore);
                if(count($res) > 0){
                    $this->res = "No se puede actualizar. Este NIF ya ha sido registrado.";
                    return false;
                }
                //updateValueById($attribute, $new_value, $id)
                if($this->mod->updateValueById('nif',$this->dataStore, $this->userId)>0){
                    $this->err = "Datos actualizados";
                    $_SESSION['user_data'] = $this->dataStore;
                    return true;
                }
                $this->err = "Error al escribir en la base de datos. No se ha relizado ningún cambio.";
                return false;
            case 'surname':
                if($_SESSION['user_data']->surname === $this->dataStore){
                    $this->res = "El valor propuesto y el actual son identicos.";
                    return false;
                }                
                //updateValueById($attribute, $new_value, $id)
                if($this->mod->updateValueById('surname',$this->dataStore, $this->userId)>0){
                    $this->err = "Datos actualizados";
                    $_SESSION['user_data']->surname = $this->dataStore;
                    return true;
                }
                $this->err = "Error al escribir en la base de datos. No se ha relizado ningún cambio.";
                return false;                
            case 'telephone':
                if($_SESSION['user_data'] === $this->dataStore){
                    $this->res = "El valor propuesto y el actual son identicos.";
                    return false;
                }                
                //updateValueById($attribute, $new_value, $id)
                if($this->mod->updateValueById('telephone',$this->dataStore, $this->userId)>0){
                    $this->err = "Datos actualizados";
                    $_SESSION['user_data'] = $this->dataStore;
                    return true;
                }
                $this->err = "Error al escribir en la base de datos. No se ha relizado ningún cambio.";
                return false;
            case 'pass':
                return $this->checkPass();
                
        }
    }
    private function checkUsername(){
        if($_SESSION['user_data']->username === $this->dataStore){
            $this->err = "El valor propuesto y el actual son identicos.";
            return false;
        }
        $res = $this->mod->getByUsername($this->dataStore);        
        if(count($res) > 0){
            $this->err = "No se puede actualizar. Este nombre de usuario ya ha sido registrada.";
            return false;
        }
        //updateValueById($attribute, $new_value, $id)
        if($this->mod->updateValueById('username',$this->dataStore, $this->userId)>0){
            $this->err = "Datos actualizados";
            $_SESSION['user_data']->username = $this->dataStore;
            return true;
        }
        $this->err = "Error al escribir en la base de datos. No se ha relizado ningún cambio.";
        return false;
    }
    private function checkName(){
        if($_SESSION['user_data']->name === $this->dataStore){
            $this->err = "El valor propuesto y el actual son identicos.";
            return false;
        }                        
        if($this->mod->updateValueById('name', $this->dataStore, $this->userId)>0){
            $this->err = "Datos actualizados";            
            $_SESSION['user_data']->name = $this->dataStore;
            return true;
        }
        $this->err = "Error al escribir en la base de datos. No se ha relizado ningún cambio.";
        return false;
    }
    private function checkEmail(){
        if($_SESSION['user_data']->email === $this->dataStore){
            $this->err = "El valor propuesto y el actual son identicos.";
            return false;
        }
        $res = $this->mod->getByEmail($this->dataStore);
        if(count($res) > 0){
            $this->err = "Esta dirección de correo ya ha sido registrada.";
            return false;
        }
        //updateValueById($attribute, $new_value, $id)        
        if($this->mod->updateValueById('email', $this->dataStore, $this->userId)>0){
            $this->err = "Datos actualizados";
            $_SESSION['user_data']->email = $this->dataStore;            
            return true;
        }
        $this->err = "Error al escribir en la base de datos. No se ha relizado ningún cambio.";
        return false;
    }
    private function checkPass(){
        $res = $this->mod->getById($this->userId);
        if(count($res) == 0){
            $this->err = "Error al ejecutar la consulta. No se ha podido realizar la actualización.";
            return false;
        }
        if($res[0]->pass == $this->dataStore){
            $this->err = "El valor propuesto y el actual son identicos.";
            return false;
        }
        if($this->mod->updateValueById('pass',$this->dataStore, $this->userId)>0){            
            $this->err = "Contraseña actualizada.";
            return true;
        }
        $this->err = "Error al escribir en la base de datos. No se ha relizado ningún cambio.";
        return false;

    }
    private function initDataUpdate(){
        $this->param=$_POST['user_data_option'];        
        if(strlen($_POST['value'])<1){
            $this->err = "Error. El formulario no contiene ningún dato.";
            return false;
        }
        switch($this->param){
            case 'pass': 
                if(strlen($_POST['value'])<6){
                    $this->err = "Error: la nueva contrseñea debe tener al menos 6 caracteres.";
                    return false;
                }
                $this->dataStore = crypt($_POST['value'],'$6$Nodejesquemeentiendan.Guardameelsecreto.');                
                break;
            default:
                $this->dataStore = $_POST['value'];
        }
        return true;
    }
}
?>