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
                <input class="course-form-input" type="textarea" name="description" placeholder="Descripción..." required/>
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
    <?php
        if(isset(AdminCourses::$selectedCourse)&&AdminCourses::$selectedCourse->active){
            echo('<div class="selected course data">');
            echo('<div class = "course-data">'.'Estado: '.AdminCourses::$selectedCourse->status.'</div>');
            echo('<div class = "course-data">'.'Nombre: '.AdminCourses::$selectedCourse->name.'</div>');
            echo('<div class = "course-data">'.'Empieza: '.AdminCourses::$selectedCourse->date_start.'</div>');
            echo('<div class = "course-data">'.'Finaliza: '.AdminCourses::$selectedCourse->date_end.'</div>');
            echo('<div class = "course-data">'.'Descripción: '.AdminCourses::$selectedCourse->description.'</div>');
            echo('</div>');
            echo('<div class="course-change-status-form">');
            echo('<select form="'.AdminCourses::$selectedCourse->id_course.'">
                    <option class="course-status-option" value="1" selected>Activar</option>
                    <option class="course-status-option" value="1" selected>Activar</option>
                    </select>
                    <form id="'.AdminCourses::$selectedCourse->id_course.'" action="/?controller=admin&method=courseActivation" method="post">
                        <input class="course-activation-button" type="submit" value="Modificar">
                    </form>
                </div>');
        }
    ?>    
</div>
