<?php
// Array que vincula los IDs de los selects declarados en el HTML con el nombre de la tabla donde se encuentra su contenido
$listadoSelects=array(
"id_instalacion"=>"t_instalacion",
"id_cancha"=>"t_cancha"
);

function validaSelect($selectDestino)
{
	// Se valida que el select enviado via GET exista
	global $listadoSelects;
	if(isset($listadoSelects[$selectDestino])) return true;
	else return false;
}

function validaOpcion($opcionSeleccionada)
{
	// Se valida que la opcion seleccionada por el usuario en el select tenga un valor numerico
	if(is_numeric($opcionSeleccionada)) return true;
	else return false;
}

$selectDestino=$_GET["select"];
$opcionSeleccionada=$_GET["opcion"];

//$_SESSION['$selectDestino'];
if(validaSelect($selectDestino) && validaOpcion($opcionSeleccionada))
{
	$tabla=$listadoSelects[$selectDestino];
	 include("../configuration/conexion.php");
	$mysqli=Conectarse();
	$consulta=$mysqli->query("SELECT id_cancha, cancha FROM $tabla WHERE id_instalacion='$opcionSeleccionada'") or die(mysql_error());
	
	// Comienzo a imprimir el select
	echo "<select class='select-style' name='".$selectDestino."' id='".$selectDestino."' onChange='cargaContenido(this.id)'>";
	echo "<option value='0'>Seleccione</option>";
	while($registro=$consulta->fetch_array())
	{
		// Convierto los caracteres conflictivos a sus entidades HTML correspondientes para su correcta visualizacion
		//$registro[1]=htmlentities($registro[1]);
		// Imprimo las opciones del select
		echo "<option value='".$registro['id_cancha']."'>".($registro['cancha'])."</option>";
	}			
	echo "</select>";
}
?>