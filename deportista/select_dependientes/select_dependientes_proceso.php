<?php
// Array que vincula los IDs de los selects declarados en el HTML con el nombre de la tabla donde se encuentra su contenido
$listadoSelects=array(
"municipio"=>"t_municipio",
"urbanizacion"=>"t_urbanizacion"
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
	 include("../../configuration/conexion.php");
	$mysqli = Conectarse();
	$consulta = $mysqli->query("SELECT id_urbanizacion, urbanizacion FROM $tabla WHERE id_municipio='$opcionSeleccionada'") or die('error');

	// Comienzo a imprimir el select
	echo "<select class='select-style gender' name='".$selectDestino."' id='".$selectDestino."' onChange='cargaContenido(this.id)'>";
	echo "<option value='0'>Seleccione</option>";
	while($registro = $consulta->fetch_array())
	{
		// Convierto los caracteres conflictivos a sus entidades HTML correspondientes para su correcta visualizacion
//		$registro[1]=htmlentities($registro[1]);
		// Imprimo las opciones del select
		
		echo "<option value='".$registro[1]."'>".utf8_encode($registro[1])."</option>";
	}			
	echo "</select>";
}
?>
