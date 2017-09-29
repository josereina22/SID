<?php
$conexion = new mysqli('localhost','root','','bd_sid',3306);
$cedula = $_GET['term'];
$consulta = "SELECT cedula FROM t_deportista WHERE cedula LIKE '%$cedula%'";

$result = $conexion->query($consulta);

if($result->num_rows > 0){
	while($fila = $result->fetch_array()){
		$cedulas[] = $fila['cedula'];		
	}
	echo json_encode($cedulas);
	exit;
}
?>