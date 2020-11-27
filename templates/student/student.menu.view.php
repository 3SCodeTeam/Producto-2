<?php require_once 'student.menu.var.php';require_once 'views/student.var.php';?>
<div class="menu-items-cont">
    <div class="item<?php if(StudentMenu::getProfile()){echo(' selected');}?>">
    <a <?php if(!StudentMenu::getProfile()){echo('href="http://localhost/?controller=student&method=profile"');}?>>Perfil</a></div>
    <div class="item<?php if(StudentMenu::getenrollment()){echo(' selected');}?>">
    <a <?php if(!StudentMenu::getEnrollment()){echo('href="http://localhost/?controller=student&method=enrollment"');}?>>Matrícula</a></div>
    <div class="item<?php if(StudentMenu::getdSchedule()){echo(' selected');}?>">
    <a <?php if(!StudentMenu::getDSchedule()){echo('href="http://localhost/?controller=student&method=dSchedule"');}?>>Diario</a></div>
    <div class="item<?php if(StudentMenu::getwSchedule()){echo(' selected');}?>">
    <a <?php if(!StudentMenu::getwSchedule()){echo('href="http://localhost/?controller=student&method=wSchedule"');}?>>Semanal</a></div>
    <div class="item<?php if(StudentMenu::getmSchedule()){echo(' selected');}?>">
    <a <?php if(!StudentMenu::getmSchedule()){echo('href="http://localhost/?controller=student&method=mSchedule"');}?>>Mensual</a></div>    
</div>