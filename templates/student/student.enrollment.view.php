<?php
echo('HOLA');
include_once 'includes/autoloader.inc.php';
require_once('student.enrollment.var.php');

$mod = new CoursesMod();
$courses = $mod->getByStatus(1);

echo('<br><div class="student-enrollment main-container">');
echo('<form class="student-enrollment form" id="student-enrollment" method="POST" action="/?controller=student&method=PostEnrollment">');

echo('<table class="student-enrollment course-table"><tbody>');
echo('<tr>
<th>Nombre</th>
<th>Inicio</th>
<th>Fin</th>        
<th>Descripción</th>
</tr>');

foreach($courses as $course){
    echo('<tr>');
    echo('<td><input type="radio" id="id_course" name="id_course" value="'.$course->id_course.'"><span>'.utf8_encode($course->name).'</span></td>');
    echo('<td><span>'.$course->date_start.'</span></td>');
    echo('<td><span>'.$course->date_end.'</span></td>');            
    echo('<td><span class="course-cell description">'.$course->description.'</span></td>');
    echo('</tr>');
}
echo('<input type="submit" value="Matricularse"/>');
echo('</tbody></table></form></div><br>');
    
if(isset(StudentEnrollment::$errormsg)){echo('<div class="errmsg">'.StudentEnrollment::$errormsg.'</div>');StudentEnrollment::$errormsg=null;}

