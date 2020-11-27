<div class="admin-profile-container">
    <H2>Datos del usuario<H2>
    <!--
    public $count;
    public $email;
    public $id_user_admin;
    public $name;
    public $pass;
    public $username;
    -->
    <?php
        require_once 'student.menu.var.php';
        include_once 'modules/student.class.php';
        if(!isset($_SESSION)){
            include_once 'modules/student.class.php';
            session_start();
        }
        $user_data = new Student();
        
        echo('<div class="profile-data-container">');
        echo('<div class="profile-data profile-username"><span>Nombre de usuario: </span>'.$_SESSION['user_data']->username.'</div>');
        echo('<div class="profile-data profile-name"><span>Nombre: </span>'.$_SESSION['user_data']->name.'</div>');
        echo('<div class="profile-data profile-email"><span>Apellido: </span>'.$_SESSION['user_data']->surname.'</div>');
        echo('<div class="profile-data profile-email"><span>Email: </span>'.$_SESSION['user_data']->email.'</div>');
        echo('<div class="profile-data profile-email"><span>NIF: </span>'.$_SESSION['user_data']->nif.'</div>');        
        echo('<div class="profile-data profile-email"><span>Teléfono: </span>'.$_SESSION['user_data']->telephone.'</div>');

        echo('</div>');
    ?>
    
    <div class="form-container">
        <div class="selector-container">
            <label for="user_data">Seleccione el campo que desea actualizar:</label><br>
            <select name="user_data_option" id="user_data_selector" form="profile_update" required>                
                <option type="text" value="username">Nombre de usuario</option>                
                <option type="text" value="name">Nombre</option>
                <option type="text" value="username">Apellido</option>
                <option type="text" value="email">Email</option>
                <option type="text" value="username">NIF</option>
                <option type="text" value="username">Teléfono</option>
                <option type="text" value="pass">Contraseña</option>
            </select>                        
        </div>
        <form action="/?controller=student&method=profilePost" method="post" id="profile_update">            
            <input class="profile-form input-field" type="text" id='value' name='value' required>
        <div>
            <input class="profile-form input-button" type="submit" value="Modificar"/>
        </div>                 
        </form>
    </div>
    <?php
        require_once('student.profile.var.php');
        
        if(isset(StudentProfile::$errormsg)){echo('<div class="errmsg">'.StudentProfile::$errormsg.'</div>');StudentProfile::$errormsg=null;}
    ?>

</div>