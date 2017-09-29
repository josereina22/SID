<?php
header('Content-Type: text/html; charset=UTF-8');	

// Establecer la zona horaria predeterminada a usar. Disponible desde PHP 5.1
date_default_timezone_set('UTC');

//Imprimimos la fecha actual dandole un formato
$fecha_inscr= date("Y-m-d");
print $fecha_inscr; print '<br>';
include ("../configuration/conexion.php");
$link=Conectarse();
$mensaje=0;
//*****************SI ENTRO POR EL LINK DE INSCRIBIR*****************************************************************/
if (isset($_GET['id_deportista']))
{
	print $id_deport=$_GET['id_deportista'];
	print '<br>';
	print $cod_class=$_GET['cod_clase'];
	print '<br>';
	
	
	//PARA PERMITIR MAXIMO DE CUATRO INSCRIPCIONES ACTIVAS
	$sqli="SELECT * FROM t_inscrito WHERE id_deportista= '$id_deport' AND estatus=1";
	$resultadoi=mysql_query($sqli);
	$rowi= mysql_fetch_array($resultadoi);
	if(mysql_num_rows($resultadoi)<4)
	{
		// PARA SABER SI YA EL ATLETA ESTA INSCRITO Y ACTIVO
		$sql="SELECT * FROM t_inscrito WHERE id_deportista= '$id_deport' AND cod_clase='$cod_class' AND estatus=1";
		$resultado=mysql_query($sql);
		$row= mysql_fetch_array($resultado);
		if(mysql_num_rows($resultado)==0)
		{
			print "No Hay";
			mysql_query("INSERT INTO t_inscrito Values('','$id_deport','$cod_class', '$fecha_inscr', '1', '')") or die("error en Incluir: ".mysql_error());
			//para sumar inscrito y restar disponible 
			mysql_query("UPDATE t_clase SET inscrito=(inscrito+1), disponible=(disponible-1)  WHERE cod_clase= '$cod_class'") or die("error en Actualizar: ".mysql_error());
			//para activar el deportista
			mysql_query("UPDATE t_deportista SET estatus =1 WHERE id_deportista= '$id_deport'") or die("error en Actualizar: ".mysql_error());
			print 'INSCRITO';
		}
		else
		{
			print "Ya Este Atleta esta Inscrito en la Clase y Esta Activo";
			$mensaje=1;
		}
	}//fin de maximo a cuatro
	else{
		print "Maximo hasta Cuatro Disciplina por atleta";
		$mensaje=2;	
	}
		
		
		
	
	
	
	
	
	
	
	$id_deport="";
}//cierro el if $_GET['id_deportista']
//************************************************************************************************************************/


//*****************SI ENTRO POR LA LISTA DE STATUS*****************************************************************/

if(isset($_POST['estatus_inscrito']))
{
	$id_inscrito=$_POST['id_inscrito'];//obtengo el id segun el inscrito
	$estatus_inscrito=$_POST['estatus_inscrito']; //obtengo el status del inscrito
	$cod_clase=$_POST['cod_clase']; //obtengo el id de la clase
	//$id_deportista=$_SESSION['id_deportista'];
	//PARA Obtener el ID del Deportista
	$sql="SELECT * FROM t_inscrito WHERE id_inscrito= '$id_inscrito'";
	$resultado=mysql_query($sql);
	$row= mysql_fetch_array($resultado);
	$id_deportista=$row['id_deportista'];
	
	/*////////////////////////////////////////////////////////////////////////////////////////////////////////////////////*/	
	// PARA SABER SI YA EL ATLETA ESTA INSCRITO Y ACTIVO
	$sql="SELECT * FROM t_inscrito WHERE id_deportista= '$id_deportista' AND cod_clase='$cod_clase' AND estatus=1";
	$resultado=mysql_query($sql);
	$row= mysql_fetch_array($resultado);
	if(mysql_num_rows($resultado)==0)
	{
		if ($estatus_inscrito==1){
			//PARA PERMITIR MAXIMO DE CUATRO INSCRIPCIONES ACTIVAS
			$sqli="SELECT * FROM t_inscrito WHERE id_deportista= '$id_deportista' AND estatus=1";
			$resultadoi=mysql_query($sqli);
			$rowi= mysql_fetch_array($resultadoi);
			if(mysql_num_rows($resultadoi)<4)
			{
				mysql_query("UPDATE t_inscrito SET estatus ='$estatus_inscrito' WHERE id_inscrito= '$id_inscrito'") or die("error en Actualizar: ".mysql_error());
				//para sumar inscrito y restar disponible 
				mysql_query("UPDATE t_clase SET inscrito=(inscrito+1), disponible=(disponible-1) WHERE cod_clase= '$cod_clase'") or die("error en Actualizar: ".mysql_error());
				//para limpiar fecha de retiro
				mysql_query("UPDATE t_inscrito SET fecha_retiro='' WHERE id_inscrito= '$id_inscrito'") or die("error en Actualizar: ".mysql_error());
			}
			else{
				$mensaje=2;
			}//fin menor a 4
		}
		else{
			mysql_query("UPDATE t_inscrito SET estatus ='$estatus_inscrito' WHERE id_inscrito= '$id_inscrito'") or die("error en Actualizar: ".mysql_error());
			//para restar inscrito y sumar disponible 
			mysql_query("UPDATE t_clase SET inscrito=(inscrito-1), disponible=(disponible+1) WHERE cod_clase= '$cod_clase'") or die("error en Actualizar: ".mysql_error());
			//para colocar fecha de retiro
			mysql_query("UPDATE t_inscrito SET fecha_retiro='$fecha_inscr' WHERE id_inscrito= '$id_inscrito'") or die("error en Actualizar: ".mysql_error());
			} //fin de maximo 4
	}
	else
	{
		if ($estatus_inscrito==2){
					mysql_query("UPDATE t_inscrito SET estatus ='$estatus_inscrito' WHERE id_inscrito= '$id_inscrito'") or die("error en Actualizar: ".mysql_error());
					//para restar inscrito y sumar disponible 
					mysql_query("UPDATE t_clase SET inscrito=(inscrito-1), disponible=(disponible+1) WHERE cod_clase= '$cod_clase'") or die("error en Actualizar: ".mysql_error());
					//para colocar fecha de retiro
					mysql_query("UPDATE t_inscrito SET fecha_retiro='$fecha_inscr' WHERE id_inscrito= '$id_inscrito'") or die("error en Actualizar: ".mysql_error());
				}
		else{
			print "Ya Este Atleta esta Inscrito en la Clase y Esta Activo";
			$mensaje=1;
		}
	}
/*////////////////////////////////////////////////////////////////////////////////////////////////////////////////////*/
	
	//OBTENGO EL ID DEPORTISTA SEGUN EL ID DEL INSCRITO QUE ESTE ACTIVO
	$sql="SELECT t_inscrito.estatus FROM t_deportista, t_inscrito 
			WHERE t_inscrito.id_deportista=$id_deportista 
			AND t_inscrito.id_deportista=t_deportista.id_deportista 
			AND t_inscrito.estatus=1";
	$resultado=mysql_query($sql);
	//para activar o desactivar EL STATUS deportista segun si tiene algun deporte inscrito o no
	if(mysql_num_rows($resultado)==0)
	{
		mysql_query("UPDATE t_deportista SET estatus =2 WHERE id_deportista=$id_deportista") 
		or die("error en Actualizar: ".mysql_error());
	}
	else
	{
		mysql_query("UPDATE t_deportista SET estatus =1 WHERE id_deportista= $id_deportista") 
		or die("error en Actualizar: ".mysql_error());
	}
}// cierro if $_POST['estatus_inscrito']
//************************************************************************************************************************/
header('Location: ../deportista/deportista_agg3.php?mensaje='.$mensaje);
?>
