<?php require_once 'student.menu.var.php'?>
<div class="menu-items-cont">
    <div class="item<?php if(StudentMenu::$menu=='profile'){echo(' selected');}?>">Perfil</div>
    <div class="item<?php if(StudentMenu::$menu=='enrollemnt'){echo(' selected');}?>">Nueva Matrícula</div>
    <div class="item<?php if(StudentMenu::$menu=='daily'){echo(' selected');}?>">Diario</div>
    <div class="item<?php if(StudentMenu::$menu=='weekly'){echo(' selected');}?>">Semanal</div>
    <div class="item<?php if(StudentMenu::$menu=='monthly'){echo(' selected');}?>">Mensual</div>
    <div class="item button"><</div>        
    <div class="item button">></div>    
</div>