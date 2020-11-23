<?php require_once 'admin.menu.var.php'?>
<div class="menu-items-cont">
    <div class="item<?php if(AdminMenu::$menu=='profile'){echo(' selected');}?>"><a href="http://localhost/?controller=admin&method=profile">Perfil</a></div>
    <div class="item<?php if(AdminMenu::$menu=='teachers'){echo(' selected');}?>"><a href="http://localhost/?controller=admin&method=teacher">Profesores</a></div>
    <div class="item<?php if(AdminMenu::$menu=='Courses'){echo(' selected');}?>"><a href="http://localhost/?controller=admin&method=courses">Crusos</a></div>
    <div class="item<?php if(AdminMenu::$menu=='Classes'){echo(' selected');}?>"><a href="http://localhost/?controller=admin&method=classes">Asignaturas</a></div>
    <div class="item<?php if(AdminMenu::$menu=='Delete'){echo(' selected');}?>"><a href="http://localhost/?controller=admin&method=delete">Eliminar</a></div>    
</div>
