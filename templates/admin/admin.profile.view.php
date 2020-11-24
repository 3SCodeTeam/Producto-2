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
    <div class="profile-data-container">
        <div class="profile-data profile-username"><span>Nombre de usuario: </span><?php echo($_SESSION['user_data']->username);?></div>
        <div class="profile-data profile-name"><span>Nombre: </span><?php echo($_SESSION['user_data']->name);?></div>
        <div class="profile-data profile-email"><span>Email: </span><?php echo($_SESSION['user_data']->email);?></div>
    </div>
    
    <div class="form-container">
        <div class="selector-container">
            <label for="user_data">Seleccione el campo que desea actualizar:</label><br>
            <select name="user_data_option" id="user_data_selector" form="profile_update" required>
                <option type="text" value="email">Email</option>
                <option type="text" value="name">Nombre</option>-->
                <option type="text" value="username">Nombre de usuario</option>
                <option type="text" value="pass">Contraseña</option>
            </select>                        
        </div>
        <form action="/?controller=admin&method=profilePost" method="post" id="profile_update">            
            <input class="profile-form input-field" type="text" id='value' name='value'>
        <div>
            <input class="profile-form input-button" type="submit" value="Modificar"/>
        </div>                 
        </form>
    </div>
    <?php
        require_once('admin.profile.var.php');
        
        if(isset(AdminProfile::$errormsg)){echo('<div class="errmsg">'.AdminProfile::$errormsg.'</div>');AdminProfile::$errormsg=null;}
    ?>

</div>