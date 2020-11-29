<?php
    include_once 'includes/autoloader.inc.php';
    include_once 'modules/classes.mod.class.php';
    include_once 'modules/teachers.mod.class.php';
    include_once 'modules/courses.mod.class.php';
    include_once 'admin.classes.var.php';
    include_once 'includes/utils.inc.php';
    /*
        Formulario selección curso y profesor.
        Determinará un periodo, el del curso, del que devolverémos las horas libres del profesor por día de la semana.
        Devovlerá un listado de los días de la semana que tengan horas libres y un form list con las horas libres por día.
    */
    if(AdminClasses::$status == 'init'){
        $mod = new CoursesMod();        
        $courses = $mod->getByStatus(1);
        $mod = new TeachersMod();  
        $teachers = $mod->getAll();
        
        if(count($courses)>0 && count($teachers)>0){}
        //SELECTOR CURSO
        echo('<div class="form-container courses-teachers"><div>');        
        echo('<form id="courses-teachers" method="POST" action="/?controller=admin&method=PostClassInit">');
        echo('<div class="courses-container selector">');        
        
        echo('<label for="courses">Curso: </label>');
        echo('<select form="courses-teachers" id="courses" name="courses" size=1>');
        
        foreach($courses as $item){
            echo('<option value="'.$item->id_course.'">'.$item->name.'</option>');
        }
        echo('<option value="none" selected>------</option>');
        echo('</select></div>');
        
        //SELECTOR PROFESOR
        echo('<div class="teachers-container selector">');
        echo('<label for="teachers">Profesor: </label>');
        echo('<select form="courses-teachers" id="teachers" name="teachers" size=1');        
        foreach($teachers as $item){
            echo('<option value="'.$item->id_teacher.'">'.$item->surname.', '.$item->name.' ('.$item->email.')</option>');
        }
        echo('<option value="none" selected>------</option>');        
        echo('</select></div>');

        //<span style="background-color:'.$c.'">
        echo('<div class="colors-container selector">');
        echo('<label for="colors">Color: </label>');
        echo('<select form="courses-teachers" id="colors" name="colors" size=1');        
        foreach(Utils::$listOfColors as $c){
            echo('<option value="'.$c.'">'.$c.'</option>');
        }        
        echo('</select></div>');
        echo('<br><br><label>Nombre: </label><input type="text" id="name" name="name" required/>');          
        echo('<br><br><input type="submit" value="Nueva asignatura"/>');
        echo('</form></div></div>');

        //LISTADO DE CLASES EXISTENTES
        /*
            $class_day;
            $class_name;            
            $class_color;
            $course_name;
            $techer_email;
            $teacher_name;
            $teacher_surname;
            $time_start;
            $time_end;
        */
        $mod=new ClassesMod();
        $classes = $mod->getbyDOW();        
        if(count($classes)>0){
            echo('<div class="list-classes-container">');
            echo('<table style="width:75%"><tbody>');
            echo('<tr>');
            //echo('<th>Día</th>');
            echo('<th>Nombre</th><th>Color</th><th>Curso</th><th>Profesor</th>');
            //echo('<th>Inicio</th><th>Fin</th>');
            echo('</tr>');            
            foreach($classes as $item){
                echo('<tr class="row class">');                
                //echo('<td class="col dow">'.AdminClasses::getDayByName($item->class_day).'</td>');
                echo('<td class="col name">'.$item->class_name.'</td><td class="col color">'.$item->class_color.'</td>');
                echo('<td class="col course">'.$item->course_name.'</td>');
                echo('<td class="col teacher">'.$item->teacher_surname.', '.$item->teacher_name.' (<a href="mailto:'.$item->teacher_email.'">'.$item->teacher_email.'</a>)</td>');
                //echo('<td class="col time start">'.$item->time_start.'</td><td class="col time end">'.$item->time_end.'</td>');
                echo('</tr>');
            }
            echo('</tbody></table></div>');
        }else{
            echo('No existen clases programadas. ¿A que estás esperando?');
               }
    }

    if(isset(AdminClasses::$errormsg)){echo('<div class="errmsg">'.AdminClasses::$errormsg.'</div>');AdminClasses::$errormsg=null;}else
    {
    
    /*
        Formulario selección día y hora por días de la semana.
    */
    if(AdminClasses::$status == 'classes'){       
        
        echo('<div class="list-schedule-container">');
        echo('<form action ="/?controller=admin&method=PostClassNew" method="POST" id="newClass">');        
        echo('<table class="form-schedule">');
        
        //CABECERA DE LA TABLA
        echo('<tr>');
        foreach(AdminClasses::$dow as $d){
            echo('<th>');
            echo('<span>'.$d.'<span>');
            echo('</th>');            
        }        
        echo('</tr>');
        
        foreach(AdminClasses::$hours as $h){
            echo('<tr>');            
            foreach(AdminClasses::$dow as $d){
                $freeHours = AdminClasses::getListOfFreeHours($d);
                if($d==='HORA'){
                    echo('<td>'.$h.'</td>');
                }else{
                    if(in_array($h, $freeHours)){
                        echo('<td class=col "'.$d.'"><input type="radio" value="'.$h.'" name="'.$d.'">'.$h.'</input></td>');
                    }else{
                        echo('<td class=col "'.$d.'"><input type="radio" value="'.$h.'" name="'.$d.'" disabled>'.$h.'</input></td>');
                    }
                }
            }
            echo('</tr>');
        }
        
        echo('</table>');
        echo('<input type="hidden" id="teacher_id" name="teacher_id" value="'.AdminClasses::$selectedTeacherId.'"/>');
        echo('<input type="hidden" id="course_id" name="course_id" value="'.AdminClasses::$selectedCourseId.'"/>');
        echo('<input type="hidden" id="time_start" name="time_start" value="'.AdminClasses::$selectedCourseStartDate.'"/>');
        echo('<input type="hidden" id="time_end" name="time_end" value="'.AdminClasses::$selectedCourseEndDate.'"/>');
        echo('<input type="hidden" id="end" name="name" value="'.AdminClasses::$selectedName.'"/>');
        echo('<input type="hidden" id="color" name="color" value="'.AdminClasses::$selectedColor.'"/>');

        echo('<input type="submit" value="Crear clases"/></from></div>');
        
    }

    }
?>