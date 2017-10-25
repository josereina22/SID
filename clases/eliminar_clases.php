<?php session_start(); 
include ("../configuration/conexion.php");
$mysqli=Conectarse(); 
print $_GET["cod_clase"];
date_default_timezone_set('America/Caracas');
$fecha_retiro= date('Y-m-d');
$mysqli->query("DELETE FROM t_clase WHERE cod_clase='$_GET[cod_clase]'");
$mysqli->query("DELETE FROM t_horario WHERE cod_clase='$_GET[cod_clase]'");
$mysqli->query("UPDATE t_inscrito  SET estatus=2, fecha_retiro='$fecha_retiro' WHERE cod_clase='$_GET[cod_clase]' AND estatus=1");
header('Location: from_eliminar_clase.php');
?>