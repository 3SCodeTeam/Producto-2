<?php
require_once('config.php');

/*******************************/
/**** FUNCIONES PARA MYSQL *****/
/*******************************/

function mysql_Conectar()
{
	$c = mysqli_connect(DB_SERVER, DB_USER, DB_PWD, DB_SCHEMA);
	if(!$c) {
		die('Error de conexion ('.msqli_connect_errno().') '.mysqli_connect_error());
	}
	return $c;
}

function mysql_Consultar($conexion, $consulta)
{
	$resultado = mysqli_query($conexion, $consulta);
	if(!$resultado) {
		die('Error: '.mysqli_error($conexion));
	}
	return $resultado;
}

function mysql_Recuperar($resultado)
{
	return mysqli_fetch_array($resultado, MYSQLI_ASSOC);
}

function mysql_Liberar($resultado)
{
	mysqli_free_result($resultado);
}

function mysql_Desconectar($conexion)
{
	mysqli_close($conexion);
}

?>
