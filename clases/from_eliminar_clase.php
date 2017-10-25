<?php session_start(); ?>
<html>
<head>
<!--meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /-->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Documento sin título</title>
<link type="text/css" href="../estilos/tablas_report.css" rel="stylesheet" />
<link type="text/css" href="../estilos/boton_report.css" rel="stylesheet" />
<script type="text/javascript" src="../jquery/jquery.js"></script>
<script type="text/javascript" src="../estilos/tablas_report.js"></script>

<script>
function confirmar()
{
  var agree=confirm("Realmente deseas eliminar la Clase? ");
  if (agree) 
     return true ;
  else
  return false;
}
</script> 
</head>
<body>
<form name="form1" method="post" action="">
  <table width="900" border="0" cellpadding="3" align="center" id="table">
    <tr>
      <th> <input type="text" name="buscar" id="buscar">
        <input type="submit" name="button" id="button" value="Buscar"></th>
    </tr>
    <tr>
      <th><!--div align="right"><a href="instalaciones/instalacion_new.php" class="button-blue1">Nueva Instalaci&oacute;n</a></div--></th>
    </tr>
    <tr>
      <th>
      
      
<table width="1000" border="1" cellpadding="3" align="center" id="striped">
  <tr>
    <th width="140">C&oacute;digo (Clase)</th>
    <th>Entrenador</th>
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
    <th>Editar</th>
    <th>Eliminar</th>
  </tr>
<?php
	include("../configuration/conexion.php");
	$mysqli=Conectarse(); 
$usuario=$_SESSION['usu'];
if (isset($_GET['id_entrenador']))
{
	$id_entrenador=$_GET['id_entrenador'];
	$sql="SELECT * FROM t_entrenador WHERE id_entrenador=$id_entrenador";
  $consulta=$mysqli->query($sql);
	$fila=$consulta->fetch_array();
	$usuario=$fila['usuario'];
	print $nombres=$fila['nombres']." ".$apellidos=$fila['apellidos'];
	}
	

	$sql="SELECT * FROM t_entrenador, t_clase, t_disciplina, t_instalacion, t_cancha
			WHERE t_entrenador.id_entrenador=t_clase.id_entrenador
			AND t_disciplina.id_disciplina=t_clase.id_disciplina
			AND t_instalacion.id_instalacion=t_clase.id_instalacion
			AND t_cancha.id_cancha=t_clase.id_cancha
			";
			
			
	if (!empty($_POST['buscar'])){
		$buscar=$_POST['buscar'];
		 $sql="SELECT * FROM t_entrenador, t_clase, t_disciplina, t_instalacion, t_cancha
			WHERE t_entrenador.id_entrenador=t_clase.id_entrenador
			AND t_disciplina.id_disciplina=t_clase.id_disciplina
			AND t_instalacion.id_instalacion=t_clase.id_instalacion
			AND t_cancha.id_cancha=t_clase.id_cancha
			AND (t_clase.cod_clase LIKE '%$buscar%' 
				OR disciplina LIKE '%$buscar%' 
				OR instalacion LIKE '%$buscar%' 
				OR nombres LIKE '%$buscar%'
				OR apellidos LIKE '%$buscar%')
			";
	}
	$consulta=$mysqli->query($sql);
  $xx=0;
	while ($fila=$consulta->fetch_array()){		
    $xx++;
?>
  <tr>  	
    <td><?php print $fila["cod_clase"]?></td>
    <td><?php print $fila["nombres"]." ".$fila["apellidos"]?></td>
    <td><?php print $fila["disciplina"]?></td>
    <td><?php print $fila["edad_min"]."-".$fila["edad_max"]?></td>
    <td><?php if ($fila["sexo"]==1)print"Masculino"; elseif ($fila["sexo"]==2)print"Femenino"; elseif ($fila["sexo"]==3)print"Mixto";?></td>
    <td><?php print $fila["semanas"]?></td>
    <td><?php print $fila["hora_inicio"]." a ".$fila["hora_fin"];?></td>
    <td><?php print $fila["instalacion"]?></td>
    <td><?php print $fila["cancha"]?></td>
    <td><?php print $fila["capacidad"]?></td>
    <td><?php print $fila["inscrito"]?></td>
    <td><?php print $fila["disponible"]?></td>
    <!--td><a href="eliminar_clases.php?cod_clase=<?php echo $fila["cod_clase"]?>" target="cuerpo">Eliminar</a></td-->
   <td><div align="center"><a href="../editar_clases.php?cod_clase=<?php echo $fila["cod_clase"]?>"> <img src="../imagenes/editar.png" width="30" height="30"></a></div></td>
   <td><a onClick= "return confirmar();" href="eliminar_clases.php?cod_clase=<?php echo $fila["cod_clase"]?>"><img src="../imagenes/elim.png" width="35" height="35"></a></td>
  </tr>
<?php  
  }
 ?>
</table>
<?php print $xx;?>

      </th>
    </tr>
  </table>
</form>
</body>
</html>