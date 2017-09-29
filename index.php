<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<title>SID</title>
	<link rel="shortcut icon" href="imagenes/icon.ico" type="image/ico" />
	<style type="text/css">
		body,html{
			background-color: #285CA8;
			height:100%; /*Siempre es necesario cuando trabajamos con alturas*/
			overflow: hidden;
		}
		#inferior{
		color: #FFF;
		position:absolute; /*El div será ubicado con relación a la pantalla*/
		left:0px; /*A la derecha deje un espacio de 0px*/
		right:0px; /*A la izquierda deje un espacio de 0px*/
		bottom:0px; /*Abajo deje un espacio de 0px*/
		height:185px; /*alto del div*/
		z-index:0;
		float:right;
		 }	
		.centrar
		{
			position: absolute;
			/*nos posicionamos en el centro del navegador*/
			top:50%;
			left:50%;
			/*determinamos una anchura*/
			width:450px;
			/*indicamos que el margen izquierdo, es la mitad de la anchura*/
			margin-left:-225px;
			/*determinamos una altura*/
			/*height:300px;
			/*indicamos que el margen superior, es la mitad de la altura*/
			margin-top:-50px;
			border:0px solid #808080;
			padding:5px;
		}
	</style>
	<link rel="stylesheet" type="text/css" href="estilos/formularios.css" media="all" />
</head>
<body>
<div>
	<div align="center"><img src="imagenes/chacao_TRANS.png"></div>
	<div align="center">
		<label style="font:28px Georgia, 'Times New Roman', Times, serif; color:#FFF">
			Sistema Información de Deportes
		</label>
  	</div>
	<div class="centrar">
  		<div class="form">
  		  <form name="form1"  METHOD="POST">
  			<table width="318" border="0" align="center">
    			<tr> 
      				<th colspan="2">
	      				<label style="font:28px Georgia, 'Times New Roman', Times, serif";>
	  						<div align="center">Ingreso de Usuarios</div>
						</label>
						<br>	
					</th>
				</tr>
				<tr>
					<th width="162"><div align="right">Usuario:</div></th>
					<td width="144"><input type="text" name="usu" id="usuario" /></td>
				</tr>
				<tr>
				    <th width="162" height="26"><div align="right">Contrase&ntilde;a:</div></th>
				    <td width="144"><input type="password" name="contra" id="contrasena" /></td>
     			</tr>
     			<tr>
     				<td height="47" colspan="2">
     					<label>
     				    	<div align="center">
     				    		<INPUT  class="buttom" name="enviar" TYPE="submit" id="enviar" VALUE="Entrar" />
     				   		 </div>
     				   	</label>
     				</td>
     			</tr>
     		</table>  
		  </form>
		</div>
	</div>
  	<div id="inferior" ><img src="imagenes/pie_TRANSPARENTE.png" width="799" height="185" align="right"></div>
</div>
</body>
</html>

<?php
// pregunto si usu viene mediente el metodo POST, es decir le dimos click a "entrar"
if (!(empty ($_POST['usu'])))
{	
	include ("configuration/conexion.php");
	$link=Conectarse(); 
	$usuario=$_POST['usu'];
	//$contra=;
	//$passwordcodificado4 = $_POST['contra']; //Encriptacion nivel 1
	$passwordcodificado = md5 ($_POST['contra']); //Encriptacion nivel 1
	$passwordcodificado2 = crc32($passwordcodificado); //Encriptacion nivel 1
	$passwordcodificado3 = crypt($passwordcodificado2, "xtemp"); //Encriptacion nivel 2
	$passwordcodificado4 = sha1("xtemp".$passwordcodificado3); //Encriptacion nivel 3


    $_SESSION['usu']=$usuario;	
	$consulta="SELECT * FROM t_entrenador WHERE usuario='$usuario' AND contrasena='$passwordcodificado4'";
	$resultados= mysql_query ($consulta) or die("error consulta: ".mysql_error());
	if (!(@mysql_num_rows($resultados)==0))
	{			
   	   $row = mysql_fetch_array($resultados);
	   $id_tipo_usuario= $row["id_tipo_usuario"];
	   $_SESSION['id_tipo_usuario']=$id_tipo_usuario;
	   if ($id_tipo_usuario==2){ //si es coordinador mi llevo el ide del mismo en session
	   	$_SESSION['id_coordinador']=$row["id_entrenador"]; 
	   }
	   
		 ?>
         <script type="text/javascript">
			window.location="principal.php";
		 </script>
	    <?php
	}	
	else
	{ 
	  ?>
       <script type="text/javascript">
	        alert("Usuario o Contraseña Incorrecta");
			document.getElementById('usuario').focus();
			//window.location="index.php";
	   </script>
	  <?php
	  session_destroy();
    }
}
?>
