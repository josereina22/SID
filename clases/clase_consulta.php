<?php session_start(); ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<!--meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /-->
<title>Documento sin título</title>
<link type="text/css" href="../estilos/tablas_report.css" rel="stylesheet" />
<link type="text/css" href="../estilos/boton_report.css" rel="stylesheet" />
<script type="text/javascript" src="../jquery/jquery.js"></script>
<script type="text/javascript" src="../estilos/tablas_report.js"></script>

</head>
<body>
<a name="arriba"></a>
<table width="900" border="1" cellpadding="3" align="center" id="striped">
  <tr>
  	<th>Detalle</th>
    <th width="140">C&oacute;digo (Clase)</th>
    <th>Disciplina</th>
    <th>Categoria</th>
    <th>Sexo</th>
    <th width="130">Dias</th>
    <th>Horario</th>
    <th>Instalaci&oacute;n</th>
    <th width="70">Cancha</th>
    <th>Cap.</th>
    <th>Insc.</th>
    <th>Disp.</th>
  </tr>
<?php
	include("../configuration/conexion.php");
	Conectarse();
  header('Content-Type: text/html; charset=UTF-8');      
$usuario=$_SESSION['usu'];
if (isset($_GET['id_entrenador']))
{
	$id_entrenador=$_GET['id_entrenador'];
	$sql="SELECT * FROM t_entrenador WHERE id_entrenador=$id_entrenador";
	$consulta=mysql_query($sql);
	$fila=mysql_fetch_assoc($consulta);
	$usuario=$fila['usuario'];
	print $nombres=$fila['nombres']." ".$apellidos=$fila['apellidos'];
	}
	

	$sql="SELECT * FROM t_entrenador, t_clase, t_disciplina, t_instalacion, t_cancha, t_horario
			WHERE t_entrenador.id_entrenador=t_clase.id_entrenador
			AND t_disciplina.id_disciplina=t_clase.id_disciplina
			AND t_instalacion.id_instalacion=t_clase.id_instalacion
			AND t_cancha.id_cancha=t_clase.id_cancha
			AND t_horario.cod_clase=t_clase.cod_clase
			AND usuario='$usuario'
			GROUP BY t_horario.cod_clase";
	$consulta=mysql_query($sql);
	while ($fila=mysql_fetch_assoc($consulta)){		
?>
  <tr>
  	<td><a href="clase_entrenador.php?cod_clase=<?php echo $fila["cod_clase"]?>" target="cuerpo"><label style="background:#AEE4FF; border-radius:3px">Detalle</label></a></td>
    <td><?php print $fila["cod_clase"]?></td>
    <td><?php print $fila["disciplina"]?></td>
    <td><?php print $fila["edad_min"]."-".$fila["edad_max"]?></td>
    <td><?php if ($fila["sexo"]==1)print"Masculino"; elseif ($fila["sexo"]==2)print"Femenino"; elseif ($fila["sexo"]==3)print"Mixto";?></td>
    <td><?php print $fila["semanas"]?></td>
    <td><div align="center"><?php print $fila["hora_inicio"]." a ".$fila["hora_fin"];?>
    </div></td>
    <td><?php print $fila["instalacion"]?></td>
    <td><?php print $fila["cancha"]?></td>
    <td><?php print $fila["capacidad"]?></td>
    <td><?php print $fila["inscrito"]?></td>
    <td><?php print $fila["disponible"]?></td>
  </tr>
<?php  
  }
 ?>
</table>

</body>
</html>