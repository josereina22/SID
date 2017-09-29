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
<a name="arriba"></a>
<form name="form1" method="post" action="">
  <table width="900" border="0" cellpadding="3" align="center" id="table">
    <tr>
      <th> <input type="text" name="buscar" id="buscar">
        <input type="submit" name="button" id="button" value="Buscar"></th>
    </tr>
    <tr>
      <th><div align="right"><a href="entrenadores/entrenador_new.php" class="button-blue1">Nuevo(a) Entrenador(a)</a></div></th>
    </tr>
    <tr>
      <th> <table width="900" border="1" cellpadding="3" align="center" id="striped">
        <tr>
          <th>Id</th>
          <th>Estatus</th>
          <th>Nombres</th>
          <th>Apellidos</th>
          <th>Sexo</th>
          <th>Usuario</th>
          <th>Cargo</th>
          <th>Editar</th>
          <th>Clases</th>
          <th>Horario</th>
        </tr>
        <?php
    include ('configuration/conexion.php');
     conectarse();
	 //header('Content-Type: text/html; charset=ISO-8859-1'); 
	 $consulta="SELECT * 
	 			FROM t_entrenador 
	 			WHERE id_entrenador<>0
				ORDER BY id_tipo_usuario, nombres LIMIT 500
				";
	
	if (!empty($_POST['buscar'])){
		$buscar=$_POST['buscar'];
		 $consulta="SELECT * 
	 			FROM t_entrenador
				WHERE id_entrenador LIKE '%$buscar%' 
				OR nombres LIKE '%$buscar%'
				OR apellidos LIKE '%$buscar%'
				OR usuario LIKE '%$buscar%'
				ORDER BY id_tipo_usuario LIMIT 100
				";
		}	
	
	$resultados= mysql_query ($consulta) or die("error consulta: ".mysql_error());
	$i=0;
	if (!(@mysql_num_rows ($resultados) == 0))
		{
			while ($campo = mysql_fetch_array($resultados))
			{
				$id_entrenador=$campo['id_entrenador'];
				$estatus=$campo['estatus'];
				$nombres=$campo['nombres'];
				$apellidos=$campo['apellidos'];
				$id_sexo=$campo['sexo'];
	?>
        <tr bgcolor="#CCCCCC">
          <td><?PHP print $id_entrenador?></td>
          <td><?PHP  if($estatus==1){
		  	print "ACTIVO";
			}elseif ($estatus==2){
				print "INACTIVO";}
	  ?></td>
          <td><?PHP echo $nombres?></td>
          <td><?PHP echo $apellidos?></td>
          <td><?PHP  if($id_sexo==1){
		  	print "Masculino";
			}elseif ($id_sexo==2){
				print "Femenino";}
	  ?></td>
      		<td><?PHP echo $campo['usuario']?></td>
            <td><?PHP 
			 $consulta="SELECT * FROM t_tipo_usuario WHERE id_tipo_usuario=$campo[id_tipo_usuario]";
			  $result= mysql_query ($consulta);
			  $row = mysql_fetch_array($result);
			   print $row['tipo_usuario'];
			?></td>
            
          <td height="21"><a href="entrenadores/entrenador_edit.php?id_entrenador=<?php echo $id_entrenador?>#arriba"> <img src="imagenes/editar.png" width="30" height="30"></a></td>
          <?php 
		  	if ($row['id_tipo_usuario']== 3 OR $row['id_tipo_usuario']==2)
			{
		  ?>
          <td height="21">
             <a href="clases/clase_consulta.php?id_entrenador=<?php echo $id_entrenador?>#arriba"><img src="imagenes/deportes.jpg" width="30" height="25"></a>
	  </td>
      <td height="21">
             <a href="horario/horario_entrenador.php?id_entrenador=<?php echo $id_entrenador?>#arriba"><img src="imagenes/horario.png" width="40" height="40"></a>
	  </td>
        <?php } else {?>
        	<td height="21"> </td>
            <td height="21"> </td>
       <?php } ?>
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