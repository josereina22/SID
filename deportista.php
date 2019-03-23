<html>
<head>
<!--meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" /-->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title></title>
<link type="text/css" href="estilos/tablas_report.css" rel="stylesheet" />
<link type="text/css" href="estilos/boton_report.css" rel="stylesheet" />

<script type="text/javascript" src="jquery/jquery.js"></script>
<script type="text/javascript" src="estilos/tablas_report.js"></script>
</head>
<body>

<form name="form1" method="post" action="">
  <table width="1000" border="0" cellpadding="3" align="center" id="table">
    <tr>
      <th> <input type="text" name="buscar" id="buscar">
        <input type="submit" name="button" id="button" value="Buscar"></th>
    </tr>
    <tr>
      <th><div align="right"><a href="deportista/deportista_agg2.php" class="button-blue">Nuevo Atleta</a></div></th>
    </tr>
    <tr>
      <th> <table width="1000" border="1" cellpadding="3" align="center" id="striped">
        <tr>
          <th>Editar</th>
          <th>Carnet</th>
          <th>Status</th>
          <th>C&eacute;dula</th>
          <th>Nombres y Apellidos</th>
          <th>C&oacute;digos</th>
          <th>Inscribir</th>
          <th colspan="2">Constancia</th>
        </tr>
        <?php
    include ('configuration/conexion.php');
     $mysqli=Conectarse();
	 //header('Content-Type: text/html; charset=ISO-8859-1'); 
	 //header('Content-Type: text/html; charset=UTF-8'); 
	 $consulta="SELECT * 
	 			FROM t_deportista 
				ORDER BY id_deportista DESC LIMIT 500
				";
	
	if (!empty($_POST['buscar'])){
		$buscar=$_POST['buscar'];
		 $consulta="SELECT * 
	 			FROM t_deportista
				WHERE id_deportista LIKE '%$buscar%' 
				OR cedula LIKE '%$buscar%'
				OR nombres LIKE '%$buscar%'
				OR apellidos LIKE '%$buscar%'
				ORDER BY id_deportista DESC LIMIT 100
				";
		}	
	
	$resultados = $mysqli->query($consulta);
	$i=0;
	if (!($resultados->num_rows == 0))
		{
			while ($campo = $resultados->fetch_array())
			{
				$id_deportista=$campo['id_deportista'];
				$estatus=$campo['estatus'];
				$cedula=$campo['cedula'];
				$nombres=$campo['nombres'];
				$apellidos=$campo['apellidos'];
				$id_sexo=$campo['id_sexo'];
	?>
        <tr bgcolor="">
          <td height="21"><div align="center"><a href="deportista/deportista_edit.php?id_deportista=<?php echo $id_deportista?>"> <img src="imagenes/editar.png" width="30" height="30" title="Editar Atleta"></a></div></td>
          <td><?PHP print $id_deportista?></td>
          <td><?PHP  if($estatus==1){
		  	print "ACTIVO";
			}elseif ($estatus==2){
				print "INACTIVO";}
	  ?></td>
          <td><?PHP echo $cedula?></td>
          <td><?PHP echo utf8_encode($nombres)," ",utf8_encode($apellidos)?></td>
          <td><?PHP 
	  	$consul_clases="SELECT * FROM t_inscrito, t_estatus_inscrito WHERE id_deportista='$id_deportista' AND id_estatus_inscrito=estatus ORDER BY estatus, fecha_inscripcion LIMIT 4";
		$result_clases= $mysqli->query($consul_clases);
		$x=1;
		while ($campo = $result_clases->fetch_array()){
				if ($campo['id_estatus_inscrito']==1)
				{print "<label style='color:blue'>";}
				else {print "<label style='color:red'>";}
				print $x.") ".utf8_encode($campo["cod_clase"])." ".$campo["estatus_inscrito"];
				print "</label>";
				print "<BR>";
				$x++;
			}
	  ?></td>
          
          <td height="21"><div align="center"><a href="deportista/deportista_agg3.php?id_deportista=<?php echo $id_deportista?>"><img src="imagenes/inscribir.png" width="30" height="30" align="middle" title="inscribir Clases"></a></div></td>
          <td height="21"><div align="center"><a href="reportes/pdf_deportista.php?id_deportista=<?php echo $id_deportista?>" target="_blank"><img src="imagenes/pdf_usu.png" width="30" height="30" align="middle" title="Constancia para el Atleta"></a></div></td>
          <td height="21"><div align="center"><a href="reportes/pdf_deportista_int.php?id_deportista=<?php echo $id_deportista?>" target="_blank"><img src="imagenes/pdf.png" width="30" height="30" align="middle" title="Constancia Interna"></a></div></td>
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