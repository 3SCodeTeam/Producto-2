<?php require_once 'admin.menu.var.php';require_once 'views/admin.var.php';?>
<div class="menu-items-cont">
    <div class="item<?php if(AdminVar::getProfile()){echo(' selected');}?>">
    <a <?php if(!AdminVar::getProfile()){echo('href="http://localhost/?controller=admin&method=profile"');}?>>Perfil</a></div>
    <div class="item<?php if(AdminVar::getTeacher()){echo(' selected');}?>">
    <a <?php if(!AdminVar::getTeacher()){echo('href="http://localhost/?controller=admin&method=teacher"');}?>>Profesores</a></div>
    <div class="item<?php if(AdminVar::getCourses()){echo(' selected');}?>">
    <a <?php if(!AdminVar::getCourses()){echo('href="http://localhost/?controller=admin&method=courses"');}?>>Crusos</a></div>
    <div class="item<?php if(AdminVar::getClasses()){echo(' selected');}?>">
    <a <?php if(!AdminVar::getClasses()){echo('href="http://localhost/?controller=admin&method=classes"');}?>>Asignaturas</a></div>
    <div class="item<?php if(AdminVar::getDelete()){echo(' selected');}?>">
    <a <?php if(!AdminVar::getDelete()){echo('href="http://localhost/?controller=admin&method=delete"');}?>>Eliminar</a></div>    
</div>
    