<?php session_start(); ?>
<?php
include ("../configuration/conexion.php");
$mysqli = Conectarse ();
$seleccion=$_REQUEST["seleccion"];

switch($seleccion)
{
case 1:
		$mysqli->query("INSERT INTO t_cancha VALUES('','$_POST[cancha]', '$_POST[abv_cancha]', '$_POST[id_instalacion]',  '1')") or die("error en Incluir: ".mysql_error());
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////			
			header('Location: ../canchas.php');
		break;	
	case 2:
		$mysqli->query("UPDATE t_cancha SET cancha='$_POST[cancha]', abv_cancha='$_POST[abv_cancha]', id_instalacion='$_POST[id_instalacion]', status='$_POST[estatus]' WHERE id_cancha= '$_POST[id_cancha]'") or die("error en Actualizar: ".mysql_error());
		header('Location: ../canchas.php');
		break;
	case 3:

		break;	
	case 4:

		break;
}
?>