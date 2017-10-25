<?php session_start(); ?>
<?php
include ("../configuration/conexion.php");
$mysqli=Conectarse();
$seleccion=$_REQUEST["seleccion"];

switch($seleccion)
{
	case 1:
		$mysqli->query("INSERT INTO t_disciplina VALUES('','$_POST[disciplina]', '$_POST[abv_disciplina]', '1')") or die("error en Incluir: ".mysql_error());
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////			
		header('Location: ../disciplinas.php');
		break;	
	case 2:
		$mysqli->query("UPDATE t_disciplina SET disciplina='$_POST[disciplina]', abv_disciplina='$_POST[abv_disciplina]', estatus='$_POST[estatus]' WHERE id_disciplina= '$_POST[id_disciplina]'") or die("error en Actualizar: ".mysql_error());
		header('Location: ../disciplinas.php');
		break;
	case 3:

		break;	
	case 4:

		break;
}
?>