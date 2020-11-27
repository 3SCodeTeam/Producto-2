<?php

$req = parse_url($_SERVER['REQUEST_URI']);
echo implode($req);
echo "NNNNNNNNNNN";
echo ($_SERVER['REQUEST_URI']);

switch($req){
    case '/' :
    case '':
        echo $req;
    case '/prueba':
        echo 'prueba';
        echo $req;
        echo $_SERVER['REQUEST_URI'];
    break;
}


?>