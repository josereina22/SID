<?php session_start(); ?>
<?php
include ("../configuration/conexion.php");
$mysqli = Conectarse();
$seleccion=$_REQUEST["seleccion"];

switch($seleccion)
{
case 1:
		 	$mysqli->query("INSERT INTO t_instalacion VALUES('','$_POST[instalacion]','$_POST[instalacion_corta]', '$_POST[abv_instalacion]', '$_POST[direccion]', '$_POST[director]', '$_POST[coordinador]', '$_POST[telefono1]', '$_POST[telefono2]', '1','')");
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////			
			header('Location: ../instalaciones.php');
		break;	
	case 2:
		$mysqli->query("UPDATE t_instalacion SET instalacion='$_POST[instalacion]', instalacion_corta='$_POST[instalacion_corta]', abv_instalacion='$_POST[abv_instalacion]', direccion='$_POST[direccion]', director='$_POST[director]', coordinador='$_POST[coordinador]', telefono1='$_POST[telefono1]', telefono2='$_POST[telefono2]', estatus='$_POST[estatus]' WHERE id_instalacion= '$_POST[id_instalacion]'");
		header('Location: ../instalaciones.php');
		break;
	case 3:

		break;	
	case 4:

		break;
}
?>