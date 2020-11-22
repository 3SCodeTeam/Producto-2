<?php require_once 'student.menu.var.php'?>
<div class="menu-items-cont">
    <div class="item<?php if(AdmintMenu::$menu=='profile'){echo(' selected');}?>">Perfil</div>
    <div class="item<?php if(AdmintMenu::$menu=='teachers'){echo(' selected');}?>">Profesores</div>
    <div class="item<?php if(AdmintMenu::$menu=='Courses'){echo(' selected');}?>">Crusos</div>
    <div class="item<?php if(AdmintMenu::$menu=='Classes'){echo(' selected');}?>">Asignaturas</div>
    <div class="item<?php if(AdmintMenu::$menu=='Delete'){echo(' selected');}?>">Eliminar</div>
    <div class="item button"><</div>        
    <div class="item button">></div>    
</div>