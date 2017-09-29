<?php
include ('configuration/conexion.php');
conectarse();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>
<body>
Horarios por Canchas
 <table border="1" align="center">
     <tr bgcolor="#5983d8">
	   <td>Instalación</td>
       <td>Cancha</td>
     </tr>
<?php
$consulta="	SELECT instalacion, t_cancha.id_cancha, cancha , nombres, apellidos
			FROM t_instalacion, t_cancha, t_entrenador, t_horario
			WHERE  t_horario.id_instalacion=t_instalacion.id_instalacion 
			AND t_horario.id_cancha= t_cancha.id_cancha
			AND t_horario.id_entrenador= t_entrenador.id_entrenador
			GROUP BY t_horario.id_cancha ";
$resultados= mysql_query ($consulta) or die("error consulta: ".mysql_error());
$i=0;
if(!(@mysql_num_rows ($resultados) == 0))
{
	while ($campo = mysql_fetch_array($resultados))
	{
		$instalacion=$campo['instalacion'];
		$id_cancha=$campo['id_cancha'];
		$cancha=$campo['cancha'];
		$entrenador=$campo['nombres'];
		echo "<tr bgcolor='#CCCCCC'>";
  		   echo "<td height='21'>$instalacion</td>";
		   //echo "<td height='21'>$id_instalacion</td>";
		   echo "<td height='21'>";
			  /* <a href="actualizar_sop.php?cod_soport=<?php echo $cod_soport?>">Actualizar</a>*/
			   echo "<a href='horario_cancha_lis.php?id_cancha=$id_cancha'>$cancha</a>";
		   echo "</td>";
		   //echo "<td height='21'>$entrenador</td>";		   
		echo "</tr>";
	}
}
?>
</table>
</body>
</html>