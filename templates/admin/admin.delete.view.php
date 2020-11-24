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