<div class="admin-course-container">
    <H2>Nuevo curso<H2>

    <div class="form-container">
        <form action="http://localhost/?controller=admin&method=coursePost" method="post">
            <div class="techer-form-inputs-container">
                <div class="curse-input">
                <label for="name">Nombre del curso</label><br>
                <input class="course-form-input" type="text" name="name" placeholder="Nombre del curso" required/>
                </div><div class="curse-input">
                <label for="date_start">Inicio</label><br>
                <input class="course-form-input" type="date" name="date_start" placeholder="Fecha de inicio del curso" required/>
                </div><div class="curse-input">
                <label for="date_end">Fin</label><br>
                <input class="course-form-input" type="date" name="date_end" placeholder="Fecha fin de curso" required/>
                </div><div class="curse-input description">
                <label for="description">Descripción</label><br>
                <input class="course-form-input description" type="textarea" name="description" placeholder="Descripción..." required/>
                </div>
            </div>        
            <div>
                <input class="course-form-input-button" type="submit" value="Añadir"/>
            </div>                 
        </form>
    </div>
    <div class="msg-container">
    <?php
        require_once('admin.courses.var.php');
        
        if(isset(AdminCourses::$errormsg)){echo('<div class="errmsg">'.AdminCourses::$errormsg.'</div>');AdminCourses::$errormsg=null;}
    ?>
    </div>       
</div>