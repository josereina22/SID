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
      <th><div align="right"><a href="disciplinas/disciplina_new.php" class="button-blue1">Nueva Disciplina</a></div></th>
    </tr>
    <tr>
      <th> <table width="900" border="1" cellpadding="3" align="center" id="striped">
        <tr>
          <th>Id</th>
          <th>Disciplina</th>
          <th>Cod. Disciplina</th>
          <th>Estatus</th>
          <th>Editar</th>
        </tr>
        <?php
    include ('configuration/conexion.php');
     conectarse();
	 header('Content-Type: text/html; charset=UTF-8'); 
	 $consulta="SELECT * 
	 			FROM t_disciplina 
				ORDER BY id_disciplina
				";
	
	if (!empty($_POST['buscar'])){
		$buscar=$_POST['buscar'];
		 $consulta="SELECT * 
	 			FROM t_disciplina
				WHERE id_disciplina LIKE '%$buscar%' 
				OR disciplina LIKE '%$buscar%'
				OR abv_disciplina LIKE '%$buscar%'
				ORDER BY id_disciplina
				";
		}	
	
	 $resultados= mysql_query ($consulta) or die("error consulta: ".mysql_error());
	$i=0;
	if (!(@mysql_num_rows ($resultados) == 0))
		{
			while ($campo = mysql_fetch_array($resultados))
			{
				$id_disciplina=$campo['id_disciplina'];
				$disciplina=$campo['disciplina'];
				$abv_disciplina=$campo['abv_disciplina'];
				$estatus=$campo['estatus']; 
	?>
        <tr bgcolor="#CCCCCC">
          <td><?PHP print $id_disciplina?></td>
          <td><?PHP print $disciplina?></td>
          <td><?PHP print $abv_disciplina?></td>

          <td><?PHP  if($estatus==1){
		  	print "ACTIVO";
			}elseif ($estatus==2){
				print "INACTIVO";}
	  ?></td>
          <td height="21"><a href="disciplinas/disciplina_edit.php?id_disciplina=<?php echo $id_disciplina?>"> <img src="imagenes/editar.png" width="30" height="30"></a></td>
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