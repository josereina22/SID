<?php session_start(); ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<link rel="stylesheet" type="text/css" href="estilos/formularios.css" media="all" />
</head>
<body>
<div  class="form" style="width:470px;">
<form action="" method="post">
<table width="450" border="0" cellpadding="1">
  <tr>
    <th colspan="2">Cambio de Contraseña</th>
  </tr>
  <tr>
    <th width="200"><div align="right">Contraseña Actual:</div></th>
    <td width="200">
    <input type="password" name="contra_actual" id="contra_actual"></td>
  </tr>
  <tr>
    <th><div align="right">Contraseña Nueva:</div></th>
    <td>
    <input type="password" name="contra_nueva" id="contra_nueva"></td>
  </tr>
  <tr>
    <th><div align="right">Confirmar Contraseña:</div></th>
    <td><label for="textfield3"></label>
    <input type="password" name="contra_confir" id="contra_confir"></td>
  </tr>
  <tr>
    <td colspan="2"><div align="center">
      <input type="submit" name="button" id="button" value="Cambiar" class="buttom">
    </div></td>
  </tr>
</table>
</form>
<?php
include ("configuration/conexion.php");
$mysqli = Conectarse();
// pregunto si la variable pass viene mediente el metodo POST, es decir le dimos click a "Cambiar"
if (!(empty ($_POST['contra_actual'])))
{
	$usuario=$_SESSION['usu'];
	$contra=$_POST['contra_actual'];
	$passwordcodificado = md5 ($_POST['contra_actual']); //Encriptacion nivel 1
	$passwordcodificado2 = crc32($passwordcodificado); //Encriptacion nivel 1
	$passwordcodificado3 = crypt($passwordcodificado2, "xtemp"); //Encriptacion nivel 2
	$passwordcodificado4 = sha1("xtemp".$passwordcodificado3); //Encriptacion nivel 3
	$consulta="SELECT * FROM t_entrenador WHERE usuario='$usuario' AND contrasena='$passwordcodificado4'";
	$resultados= $mysqli->query($consulta);
	if (!($resultados->num_rows == 0))
	{
		$contra_nueva=$_POST['contra_nueva'];
		$contra_confir=$_POST['contra_confir'];			
		if ($contra_confir=="" or $contra_nueva==""){
			print "contraseña no debe estar en blanco";
		}//cierro el if <>
		else{
			if($contra_nueva==$contra_confir){
				$mysqli->query("UPDATE t_entrenador SET contrasena='$contra_confir' WHERE usuario ='$usuario'");
				print "Registro Actualizado";
			} //cierro el if =
			else{
				print "Las Contraseñas No Coinciden";
			}//cierro el else del =
		}//cierro el else <>
	}// cierro el if de registro encontrados
	else
	{ 
	  //print "contraseña Actual MALA";
	  ?>
      
       <script type="text/javascript">
	        alert("Contraseña Actual Incorrecta");
			document.getElementById('usuario').focus();
			//window.location="index.php";
	   </script>
	  <?php
    }//cierro  el else de registro encontrado
}//cierro el post
?>
</div>
</body>
</html>