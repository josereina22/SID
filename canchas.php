<html>
<head>
<!--meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /-->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title></title>
<link type="text/css" href="estilos/tablas_report.css" rel="stylesheet" />
<link type="text/css" href="estilos/boton_report.css" rel="stylesheet" />

<script type="text/javascript" src="jquery/jquery.js"></script>
<script type="text/javascript" src="estilos/tablas_report.js"></script>
</head>
<body>

<form name="form1" method="post" action="">
  <table width="900" border="0" cellpadding="3" align="center" id="table">
    <tr>
      <th> <input type="text" name="buscar" id="buscar">
        <input type="submit" name="button" id="button" value="Buscar"></th>
    </tr>
    <tr>
      <th><div align="right"><a href="canchas/cancha_new.php" class="button-blue1">Nueva Cancha</a></div></th>
    </tr>
    <tr>
      <th> <table width="900" border="1" cellpadding="3" align="center" id="striped">
        <tr>
          <th>Id</th>
          <th>Cancha</th>
          <th>Instalaci&oacuten</th>
          <th>Estatus</th>
          <th>Editar</th>
          <th>Horario Cancha</th>
        </tr>
        <?php
    include ('configuration/conexion.php');
     conectarse();
	 header('Content-Type: text/html; charset=UTF-8'); 
	 $consulta="SELECT id_cancha, cancha, instalacion, t_cancha.status 
	 			FROM t_cancha, t_instalacion
				WHERE  t_cancha.id_instalacion= t_instalacion.id_instalacion
				ORDER BY instalacion
				";
	
	if (!empty($_POST['buscar'])){
		$buscar=$_POST['buscar'];
		 $consulta="SELECT id_cancha, cancha, instalacion, t_cancha.status 
	 			FROM t_cancha, t_instalacion
				WHERE t_cancha.id_instalacion= t_instalacion.id_instalacion
				AND ((cancha LIKE '%$buscar%' )
				OR (instalacion LIKE '%$buscar%'))
				ORDER BY instalacion
				";
		}	
	
	 $resultados= mysql_query ($consulta) or die("error consulta: ".mysql_error());
	$i=0;
	if (!(@mysql_num_rows ($resultados) == 0))
		{
			while ($campo = mysql_fetch_array($resultados))
			{
				$id_cancha=$campo['id_cancha'];
				$cancha=$campo['cancha'];
				$instalacion=$campo['instalacion'];
				$status=$campo['status']; 
	?>
        <tr bgcolor="#CCCCCC">
          <td><?PHP print $id_cancha?></td>
          <td><?PHP print $cancha?></td>
          <td><?PHP print $instalacion?></td>
          <td><?PHP  if($status==1){
		  	print "ACTIVO";
			}elseif ($status==2){
				print "INACTIVO";}
	  ?></td>
          <td height="21"><a href="canchas/cancha_edit.php?id_cancha=<?php echo $id_cancha?>"> <img src="imagenes/editar.png" width="30" height="30"></a></td>
          <td>
          <a href="horario/horario_cancha.php?id_cancha=<?php echo $id_cancha?>"><img src="imagenes/horario.png" width="40" height="40"></a>
          </td>
        </tr>
        <?php
	 $i++;
			}
		}
	else
	{echo "no se consigio registro";}
	?>
      </table>
        <?php
    echo "TOTAL DE REGISTRO ENCONTRADO="," ", $i;
  ?>
      </th>
    </tr>
  </table>
</form>
</body>
</html>