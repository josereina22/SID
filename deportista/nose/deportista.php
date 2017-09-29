<?php
	$conexion = new mysqli('localhost','root','','bd_sid',3306);
	$cedula = $_POST['cedula'];
	$consulta = "SELECT nombres, apellidos, foto FROM t_deportista WHERE cedula= '$cedula'";

	$result = $conexion->query($consulta);
	$respuesta = new stdClass();
	if($result->num_rows > 0){
		$fila = $result->fetch_array();
		$respuesta->nombres = utf8_encode($fila['nombres']);
		$respuesta->apellidos = $fila['apellidos'];
		$respuesta->foto = $fila['foto'];		
	}
	echo json_encode($respuesta);

?>