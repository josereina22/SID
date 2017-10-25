<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
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
      <th><div align="right"><a href="instalaciones/instalacion_new.php" class="button-blue1">Nueva Instalaci&oacute;n</a></div></th>
    </tr>
    <tr>
      <th> <table width="900" border="1" cellpadding="3" align="center" id="striped">
        <tr>
          <th>Id</th>
          <th>Instalaci&oacute;n</th>
          <th>C&oacute;digo</th>
          <th>Direcci&oacute;n</th>
          <th>Director</th>
          <th>Coordinador</th>
          <th>T&eacute;lefono 1</th>
          <th>T&eacute;lefono 2</th>
          <th>Estatus</th>
          <th>Editar</th>
        </tr>
        <?php
    include ('configuration/conexion.php');
     $mysqli = Conectarse();
	 header('Content-Type: text/html; charset=ISO-8859-1'); 
	 $consulta="SELECT * 
	 			FROM t_instalacion 
				ORDER BY id_instalacion
				";
	
	if (!empty($_POST['buscar'])){
		$buscar=$_POST['buscar'];
		 $consulta="SELECT * 
	 			FROM t_instalacion
				WHERE id_instalacion LIKE '%$buscar%' 
				OR instalacion LIKE '%$buscar%'
				OR abv_instalacion LIKE '%$buscar%'
				OR director LIKE '%$buscar%'
				OR coordinador LIKE '%$buscar%'
				OR telefono1 LIKE '%$buscar%'
				ORDER BY id_instalacion
				";
		}	
	
	$resultados= $mysqli->query($consulta);
	$i=0;
	if (!($resultados->num_rows == 0))
		{
			while ($campo = $resultados->fetch_array())
			{
				$id_instalacion=$campo['id_instalacion'];
				$instalacion=$campo['instalacion'];
				$abv_instalacion=$campo['abv_instalacion'];
				$direccion=$campo['direccion'];
				$director=$campo['director'];
				$coordinador=$campo['coordinador'];
				$telefono1=$campo['telefono1'];
				$telefono2=$campo['telefono2'];
				$estatus=$campo['estatus']; 
	?>
        <tr bgcolor="#CCCCCC">
          <td><?PHP print $id_instalacion?></td>
          <td><?PHP print $instalacion?></td>
          <td><?PHP print $abv_instalacion?></td>
          <td><?PHP print $direccion?></td>
          <td><?PHP print $director?></td>
      	  <td><?PHP print $coordinador?></td>
          <td><?PHP print $telefono1?></td>
          <td><?PHP print $telefono2?></td>
          <td><?PHP  if($estatus==1){
		  	print "ACTIVO";
			}elseif ($estatus==2){
				print "INACTIVO";}
	  ?></td>
          <td height="21"><a href="instalaciones/instalacion_edit.php?id_instalacion=<?php echo $id_instalacion?>"> <img src="imagenes/editar.png" width="30" height="30"></a></td>
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