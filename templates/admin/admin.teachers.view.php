<div class="admin-teacher-container">
    <H2>Nuevo profesor<H2>

    <div class="form-container">
        <form action="http://localhost/?controller=admin&method=teacherPost" method="post">
            <div class="techer-form-inputs-container">
                <input class="teacher-form-input" type="text" name="name" placeholder="Nombre del profesor" required/>
                <input class="teacher-form-input" type="text" name="surname" placeholder="Apellido" required/>
                <input class="teacher-form-input" type="email" name="email" placeholder="Email" required/>
                <input class="teacher-form-input" type="text" name="nif" placeholder="NIF" required/>                
                <input class="teacher-form-input" type="text" name="telephone" placeholder="Teléfono"required/>
            </div>
        
            <div>
                <input class="teacher-form-input-button" type="submit" value="Añadir"/>
            </div>                 
        </form>
    </div>
    <?php
        require_once('admin.teachers.var.php');
        
        if(isset(AdminTeachers::$errormsg)){echo('<div class="errmsg">'.AdminTeachers::$errormsg.'</div>');AdminTeachers::$errormsg=null;}
    ?>
    <div class="table-teachers-div">
        <?php
            require_once('admin.teachers.view.list.php');
            $list = new ListOfTeachers("list-teachers");
            $list->tableOfTeachers();
        ?>
    </div>
    

</div>