<?php session_start(); ?>
<?php
include ("../configuration/conexion.php");
$mysqli = Conectarse ();
$seleccion=$_REQUEST["seleccion"];

switch($seleccion)
{
case 1:
	//para ingresar nuevo entrenador
	$passwordcodificado = md5 ($_POST['password']); //Encriptacion nivel 1
	$passwordcodificado2 = crc32($passwordcodificado); //Encriptacion nivel 1
	$passwordcodificado3 = crypt($passwordcodificado2, "xtemp"); //Encriptacion nivel 2
	$passwordcodificado4 = sha1("xtemp".$passwordcodificado3); //Encriptacion nivel 3
	// Aqui será demasiado dificil poder llegar a la password verdadera ya que por ejemplo, podrian desencriptar el md5 pero aún faltaria demasiado.
	print $passwordcodificado4;
	//exit;

	$mysqli->query("INSERT INTO t_entrenador VALUES('','$_POST[nombres]','$_POST[apellidos]', '$_POST[sexo]', '$_POST[email]', '$_POST[usuario]', '$passwordcodificado4', '$_POST[cargo]','$_POST[coordinador]','1')") or die("error en Incluir: ".mysql_error());
	
	header('Location: ../entrenadores.php');
	break;	
case 2:
	if (!empty($_POST['password'])){
		$passwordcodificado = md5 ($_POST['password']); //Encriptacion nivel 1
		$passwordcodificado2 = crc32($passwordcodificado); //Encriptacion nivel 1
		$passwordcodificado3 = crypt($passwordcodificado2, "xtemp"); //Encriptacion nivel 2
		$passwordcodificado4 = sha1("xtemp".$passwordcodificado3); //Encriptacion nivel 3
		$contrasena="contrasena='".$passwordcodificado4."',";
	}else{
		$contrasena="";
	}

	
	// Aqui será demasiado dificil poder llegar a la password verdadera ya que por ejemplo, podrian desencriptar el md5 pero aún faltaria demasiado.
	$mysqli->query("UPDATE t_entrenador SET nombres='$_POST[nombres]', apellidos='$_POST[apellidos]', sexo='$_POST[sexo]', email='$_POST[email]', usuario='$_POST[usuario]', $contrasena id_tipo_usuario='$_POST[cargo]', coordinado_por='$_POST[coordinador]', estatus='$_POST[estatus]' WHERE id_entrenador= '$_POST[id_entrenador]'") OR  die("error en Actualizar: ".mysql_error());
		header('Location: ../entrenadores.php');
	break;
case 3:

	break;	
case 4:

		break;
}
?>