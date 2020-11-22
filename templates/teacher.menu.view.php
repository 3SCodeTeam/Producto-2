<?php require_once 'student.menu.var.php'?>
<div class="menu-items-cont">
    <div class="item<?php if(TeacherMenu::$menu=='profile'){echo(' selected');}?>">Perfil</div>    
    <div class="item<?php if(TeacherMenu::$menu=='daily'){echo(' selected');}?>">Diario</div>
    <div class="item<?php if(TeacherMenu::$menu=='weekly'){echo(' selected');}?>">Semanal</div>
    <div class="item<?php if(TeacherMenu::$menu=='monthly'){echo(' selected');}?>">Mensual</div>
    <div class="item button"><</div>        
    <div class="item button">></div>    
</div>