<?php session_start(); ?>
<html>
<head>

<style>
table {
    /*width: 100%;
    border-collapse: collapse;*/
}

table, td, th {
   /* border: 1px solid black;
    /*padding: 5px;*/
}

th {text-align: left;}
</style>
</head>
<body>

<?php
header('Content-Type: text/html; charset=UTF-8');
$q = intval($_GET['q']);
$id_deportista=$_SESSION['id_deportista'];
$edad=$_SESSION['edad'];
$id_sexo=$_SESSION['id_sexo'];
//print $id_sexo; 
include ('../configuration/conexion.php');
$link=Conectarse();
$sSQL="SELECT * 
	   FROM t_clase, t_disciplina, t_horario, t_instalacion 
	   WHERE  t_clase.id_disciplina=$q
	   AND(edad_min <=$edad AND edad_max>=$edad) 
	   AND (sexo=$id_sexo OR sexo=3)
	   AND t_clase.id_disciplina = t_disciplina.id_disciplina 
	   AND t_clase.cod_clase=t_horario.cod_clase 
	   AND t_clase.id_instalacion=t_instalacion.id_instalacion
	   GROUP BY t_horario.cod_clase";

	 //$sSQL3="SELECT * FROM t_clase, t_disciplina WHERE (edad_min <=$edad AND edad_max>=$edad) AND t_clase.id_disciplina= t_disciplina.id_disciplina GROUP BY t_clase.id_disciplina";

$result=mysql_query($sSQL); 
if (!mysql_num_rows($result)==0)
{
	echo "<table>
<tr>
<th style='border: 1px solid black;'>Instalación</th>
<th style='border: 1px solid black;'>Días</th>
<th style='border: 1px solid black;'>Hora</th>
<th style='border: 1px solid black;'>Código</th>
<th style='border: 1px solid black;'>Capacidad</th>
<th style='border: 1px solid black;'>Inscrito</th>
<th style='border: 1px solid black;'>Disponible</th>
<th style='border: 1px solid black;'>Inscribir</th>
</tr>";
	}	
while ($row=mysql_fetch_array($result))
          {
			  print "<tr>";
			  print "<td style='border: 1px solid black;'>" . $row['instalacion'] . "</td>";
			  print "<td style='border: 1px solid black;'>" . $row['semanas'] . "</td>";
			  print "<td style='border: 1px solid black;'>" . $row['hora_inicio'] . "</td>";
			  print "<td style='border: 1px solid black;'>" . $row['cod_clase']."</td>";
			  $cod_clase=$row['cod_clase'];
			  print "<td style='border: 1px solid black;'>" . $row['capacidad'] . "</td>";
			  print "<td style='border: 1px solid black;'>" . $row['inscrito'] . "</td>";
			  print "<td style='border: 1px solid black;'>" . $row['disponible'] . "</td>";
			  print "<td style='border: 1px solid black;'>"?><a href="../clases/inscripcion.php?id_deportista=<?php print $id_deportista?>&cod_clase=<?php print $cod_clase?>">Inscribir</a><?php print "</td>";
			  print "</tr>";
			}
echo "</table>";
//mysqli_close($con);
?>
</body>
</html>