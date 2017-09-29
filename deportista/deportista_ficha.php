<?php session_start();
	//$id_deportista=$_SESSION['id_deportista'];
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>SID</title>
</head>
<body>
<form name="form1" method="post" action="../reportes/pdf_deportista.php">
<?php 
$id_deportista=$_SESSION['id_deportista'];
include ('../configuration/conexion.php');
$link=Conectarse(); 
$result=mysql_query("SELECT * FROM t_deportista WHERE id_deportista = '$id_deportista'"); 
$row=mysql_fetch_array($result);	
$id_deportista= $row["id_deportista"];

?>

<table width="800" border="0" align="center" >
  <tr bgcolor="#75BEF4">
  	<td colspan="3"><div align="center">Datos B&aacute;sicos</div></td>
  </tr>
     <tr>
      <td width="85"><strong>Código:</strong></td>
      <td width="576"><label><?php print $row["id_deportista"];?></label></td>
      <td width="117" rowspan="6"><?php
	  	 if ($row['foto']=="")
		 	{print  "<img src='fotos/sinfoto.png 'border='2' width='129' height='163'>"; }
		 else
			 {print  "<img src='fotos/".$row['foto']."'border='0' width='129' height='163'>"; }
	  		
	  ?>
      </td>
    </tr>
  <tr>
      <td><strong>C&eacute;dula:</strong></td>
      <td><label> <?php print $row["cedula"];?> </label></td>
      
  </tr>
    <tr>
      <td><strong>Nombres:</strong></td>
      <td><label><?php print $row["nombres"];?></label></td>
    </tr>
    <tr>
      <td><strong>Apellidos:</strong></td>
      <td><label><?php print $row["apellidos"];?></label></td>
    </tr>
    <tr>
      <td><strong>Sexo:</strong></td>
      <td>
      <?php
	  	$id_sexo=$row['id_sexo'];
		$sSQL2="SELECT * FROM t_sexo WHERE id_sexo='$id_sexo'";
        $result2=mysql_query($sSQL2);
        $row2=mysql_fetch_array($result2);
        print $row2["sexo"]; 
		
	  ?>   
      </td>
    </tr>
    <tr>
      <td><strong>Edad:</strong></td>
      <td>
          <label><?php 
		  $fecha_nacimiento=$row["fecha_nac"];
		  $dias=explode("-", $fecha_nacimiento, 3);
		  $dias=mktime(0,0,0,$dias[1],$dias[2],$dias[0]);
		  print $edad=(int)((time()-$dias)/31556926);
		  ?></label>
      </td>
    </tr>
</table>

<table width="800" border="0" align="center">
  <tr>
  	<td colspan="4" bgcolor="#75BEF4"> <div align="center">Direccion de Residencia</div></td>
  </tr>
  <tr>
    <td width="200"><strong>Municipio</strong></td>
    <td width="200">
    <?php
		if ($row["id_municipio"]==6){
			print $row["otro_municipio"];
			}
		else{
			$link=Conectarse(); 
			$sSQL2="SELECT * FROM t_municipio WHERE id_municipio='$row[id_municipio]'";
			$result2=mysql_query($sSQL2);
			desconectarse();
			$row2=mysql_fetch_array($result2);
			print $row2["municipio"];
		}
    ?>
    </td>
    <td width="200"><strong>Urbanizaci&oacute;n</strong></td>
    <td width="200">
    <?php
		if ($row["id_urbanizacion"]){
			print $row["otra_urbanizacion"];
		}
		else{
	    $link=Conectarse(); 
	  	$sSQL2="SELECT * FROM t_urbanizacion WHERE id_urbanizacion='$row[id_urbanizacion]'";
        $result2=mysql_query($sSQL2);
		desconectarse();
		$row2=mysql_fetch_array($result2);
        print $row2["urbanizacion"];}
    ?>
    </td>
  </tr>
  <tr>
    <td><strong>Av/Calle</strong></td>
    <td><label><?php print $row["av_calle"];?></label></td>
    <td><strong>Edf./Res/Casa</strong></td>
    <td><label><?php print $row["edf_res_casa"];?></label></td>
  </tr>
  <tr>
    <td><strong>Telf. Casa:</strong></td>
    <td><label><?php print $row["tlf_casa"];?></label></td>
    <td><strong>Telf. Trabajo</strong></td>
    <td><label><?php print $row["tlf_trabajo"];?></label></td>
  </tr>
  <tr>
    <td><strong>Celular 1</strong></td>
    <td><label><?php print $row["celular1"];?></label></td>
    <td><strong>Celular 2</strong></td>
    <td><label><?php print $row["celular2"];?></label></td>
  </tr>
  <tr>
    <td><strong>Correo 1</strong></td>
    <td><label><?php print $row["correo1"];?></label></td>
    <td><strong>Correo 2</strong></td>
    <td><label><?php print $row["correo2"];?></label></td>
  </tr>
</table>
<table width="800" border="0" align="center">
  <tr>
    <td colspan="2" bgcolor="#75BEF4"><div align="center">Ocupacion </div></td>
  </tr>
  <tr>
    <td width="400"><strong>Ocupaci&oacute;n</strong></td>
    <td width="400"><?php
		if ($row["id_ocupacion"]==0){
			 print $row["otra_ocupacion"];
		}
		else{
			$link=Conectarse(); 
			$sSQL2="SELECT * FROM t_ocupacion WHERE id_ocupacion='$row[id_ocupacion]'";
			$result2=mysql_query($sSQL2);
			desconectarse();
			$row2=mysql_fetch_array($result2);
			print $row2["ocupacion"];}
	  ?></td>
  </tr>
  <tr>
    <td><strong>Grado de Instrucci&oacute;n</strong></td>
    <td><?php
	    $link=Conectarse(); 
	  	$sSQL2="SELECT * FROM t_grado_instruccion WHERE id_grado_instruccion='$row[id_grado_instruccion]'";
        $result2=mysql_query($sSQL2);
		desconectarse();
		$row2=mysql_fetch_array($result2);
        print $row2["grado_instruccion"];
	  ?></td>
  </tr>
  <tr>
  
    <td><strong>Empresa donde trabaja</strong></td>
    <td><label><?php print $row["emp_trabaja"];?></label></td>
  </tr>
  <tr>
    <td><strong>Instituci&oacute;n donde estudia</strong></td>
    <td colspan=""><?php
	    $link=Conectarse(); 
	  	$sSQL2="SELECT * FROM t_institucion WHERE id_institucion='$row[id_institucion]'";
        $result2=mysql_query($sSQL2);
		desconectarse();
		$row2=mysql_fetch_array($result2);
        print $row2["institucion"];
	  ?></td>
  </tr>
  <tr>
    <td><strong>Grado o A&ntilde;o que Cursa</strong></td>
    <td colspan=""><?php
	    $link=Conectarse(); 
	  	$sSQL2="SELECT * FROM t_grado WHERE id_grado='$row[id_grado]'";
        $result2=mysql_query($sSQL2);
		desconectarse();
		$row2=mysql_fetch_array($result2);
        print $row2["grado"];
	  ?></td>
  </tr>
</table>
<?php if ($row["id_representante"]<>"0"){ ?>
<table width="800" border="0" align="center">
  <tr>
      <td colspan="2" bgcolor="#75BEF4">Datos del Representante (Solo en Caso de menores de 18 a&ntilde;os)</td>
  </tr>
    <tr>
      <td width="400"><strong>Nro. Cedula</strong></td>
      <td width="400"><?php 
		$link=Conectarse(); 
	  	$sSQL2="SELECT * FROM t_representante WHERE cedula_representante='$row[id_representante]'";
        $result2=mysql_query($sSQL2);
		desconectarse();
		$row2=mysql_fetch_array($result2);
        print $row2["cedula_representante"];?></td>
    </tr>
    <tr>
      <td><strong>Nombres</strong></td>
      <td><label><?php print $row2["nombre_representante"];?></label></td>
    </tr>
    <tr>
      <td><strong>Apellidos</strong></td>
      <td><label><?php print $row2["apellido_representante"];?></label></td>
    </tr>
    <tr>
      <td><strong>Parentesco</strong></td>
      <td><label><?php print $row2["parentesco"];?></label></td>
    </tr>
    <tr>
      <td><strong>Ocupaci&oacute;n</strong></td>
      <td><?php
    	$link=Conectarse(); 
	  	$sSQL3="SELECT * FROM t_ocupacion WHERE id_ocupacion='$row2[id_ocupacion]'";
        $result3=mysql_query($sSQL3);
		desconectarse();
		$row3=mysql_fetch_array($result3);
        print $row3["ocupacion"];
	  ?></td>
    </tr>
    <tr>
      <td><strong>Grado de Instrucci&oacute;n</strong></td>
      <td><?php
	
		$link=Conectarse(); 
	  	$sSQL3="SELECT * FROM t_grado_instruccion WHERE id_grado_instruccion='$row2[id_grado_instruccion]'";
        $result3=mysql_query($sSQL3);
		desconectarse();
		$row3=mysql_fetch_array($result3);
        print $row3["grado_instruccion"];
	  ?></td>
    </tr>
    <tr>
      <td><strong>Empresa donde Trabaja</strong></td>
      <td><label><?php print $row2["empresa_trabaja"];?></label></td>
    </tr>
</table>
<?php } ?>
  <table width="800" border="0" align="center">
    <tr>
   	  <td colspan="4" bgcolor="#75BEF4">
       	<div align="center">Datos Medicos </div></td>
    </tr>
    <tr>
      <td width="220"><strong>Grupo Sanguineo</strong></td>
      <td colspan="3"><?php
	    $link=Conectarse(); 
	  	$sSQL2="SELECT * FROM t_grupo_sanguineo WHERE id_grupo_sanguineo='$row[id_grupo_sanguineo]'";
        $result2=mysql_query($sSQL2);
		desconectarse();
		$row2=mysql_fetch_array($result2);
        print $row2["grupo_sanguineo"];
	  ?>
      </td>
    </tr>
    <tr>
      <td><strong>Est&aacute; bajo alg&uacute;n tratamiento m&eacute;dico</strong></td>
      <td colspan="3"><?php if ($row['tratamiento_medico']==1) 
	  {print 'SI';
	  	  print "</td>
		  </tr>
		  <tr>
		  <td><strong>Especifique</strong></td>
		  <td>Tratamiento 1: <label> $row[tratamiento1]</label></td>
		  <td>Tratamiento 2: <label> $row[tratamiento2]</label></td>
    	  <td>Tratamiento 3: <label> $row[tratamiento2]</label>";
	  } elseif ($row['tratamiento_medico']==2) {
		 print 'NO';
	}?>
      </td>
    </tr>
    <tr>
      <td><strong>Sufre alg&uacute;n padecimiento f&iacute;sico</strong></td>
      <td colspan="3"><?php if ($row['pad_fisico']==1)
	   {print 'SI';
	   	print "</td>
		  </tr>
		  <tr>
		  <td><strong>Especifique</strong></td>
		  <td>Tratamiento 1: <label> $row[padecimiento1]</label></td>
		  <td>Tratamiento 2: <label> $row[padecimiento2]</label></td>
    	  <td>Tratamiento 3: <label> $row[padecimiento3]</label>";
	   } elseif ($row['pad_fisico']==2) {
		   print 'NO';}
		else {print "No Especifico";} 
		?>
           
      </td>
    </tr>
    <tr>
      <td><strong>Es al&eacute;rgico</strong></td>
      <td colspan="3"><?php if ($row['alergico']==1)
	   {print 'SI';
	   	print "</td>
		  </tr>
		  <tr>
		  <td><strong>Especifique</strong></td>
		  <td>Tratamiento 1: <label> $row[alergico1]</label></td>
		  <td>Tratamiento 2: <label> $row[alergico2]</label></td>
    	  <td>Tratamiento 3: <label> $row[alergico3]</label>";
	   } elseif ($row['pad_fisico']==2) {
		   print 'NO';}
		else {print "No Especifico";} 
		?>         
      </td>
    </tr>
    <tr>
      <td><strong>Posee seguro de HCM y/u otro</strong></td>
      <td><label><?php if ($row['hcm']==1) {print 'SI';} elseif ($row['hcm']==2) {print 'NO';}?></label></td>
      <td>¿Cual?</td>
      <td> <label><?php print $row["cual_hcm"];?></label></td>
    </tr>
    <tr>
      <td><strong>Est&aacute; afiliado al seguro socia</strong></td>
      <td colspan="3"><label><?php if ($row['ss']==1) {print 'SI';} elseif ($row['ss']==2) {print 'NO';}?></label></td>
    </tr>
    <tr>
      <td><strong>Observaciones</strong></td>
      <td colspan="3"><label><?php print $row["obs_medicos"];?></label></td>
    </tr>
  </table>

<table width="800" border="0" align="center">
  <tr>
    <td colspan="2" bgcolor="#75BEF4"><div align="center">Emergencia</div></td>
  </tr>
  <tr>
    <td width="400" ><strong>Nombres</strong></td>
    <td width="400"><label><?php print $row["nombre_emerg"];?></label></td>
  </tr>
  <tr>
    <td><strong>Apellidos</strong></td>
    <td><label><?php print $row["apellido_emerg"];?></label></td>
  </tr>
  <tr>
    <td><strong>Parentesco</strong></td>
    <td><label><?php print $row["parentesco_emerg"];?></label></td>
  </tr>
  <tr>
    <td ><strong>Ocupaci&oacute;n</strong></td>
    <td><label><?php print $row["ocupacion_emerg"];?></label></td>
  </tr>
  <tr>
    <td><strong>Telefono Contacto</strong></td>
    <td><label><?php print $row["tlf_emerg"];?></label></td>
  </tr>
  <tr>
    <td><strong>Lugar de Trabajo</strong></td>
    <td><label><?php print $row["trabajo_emerg"];?></label></td>
  </tr>
</table>
  	</ul>
</li>
</ul>
<?php 
//para saber cuantas clases tiene inscrita el deportista
		$link=Conectarse(); 
	  	$sSQL3="SELECT  id_inscrito, fecha_inscripcion, t_clase.cod_clase, instalacion, cancha, disciplina, 
						semanas, t_clase.hora_inicio, fecha_retiro, t_inscrito.estatus
				FROM t_inscrito, t_clase, t_instalacion, t_cancha, t_disciplina, t_horario
				WHERE id_deportista=$id_deportista
				AND t_clase.cod_clase =t_inscrito.cod_clase
				AND t_clase.id_instalacion=t_instalacion.id_instalacion
				AND t_clase.id_cancha =t_cancha.id_cancha
				AND t_clase.id_disciplina =t_disciplina.id_disciplina
				AND t_clase.cod_clase =t_horario.cod_clase
				GROUP BY t_clase.cod_clase
				";
        $result3=mysql_query($sSQL3);
		desconectarse();
if(mysql_num_rows($result3)>0){
?>
<table align="center" border="0" width="800">
					<tr>
                   	  <td colspan="9" bgcolor="#75BEF4"><div align="center">Solicitud de Cupo</div></td>
                  </tr>
          <tr bgcolor="75BEF4">
                    	<td><div align="center"><strong>Fecha Inscripción</strong></div></td>
						<td><div align="center"><strong>Clase</strong></div></td>
						<td><div align="center"><strong>Instalación</strong></div></td>
						<td><div align="center"><strong>Cancha</strong></div></td>
						<td><div align="center"><strong>Disciplina</strong></div></td>
						<td><div align="center"><strong>Días</strong></div></td>
						<td><div align="center"><strong>Hora</strong></div></td>
						<!--td><div align="center"><strong>Retiro</strong></div></td-->
                        <td><div align="center"><strong>Estatus</strong></div></td>
					</tr>
<?php		
          while ($row3=mysql_fetch_array($result3))
          { ?>
			<tr bgcolor="#CCCCCC">
				<td><?php print $row3['fecha_inscripcion'];?></td>
                <td><?php print $row3['cod_clase'];?></td>
				<td><?php print $row3['instalacion'];?></td>
				<td><?php print $row3['cancha'];?></td>
				<td><?php print $row3['disciplina'];?></td>
				<td><?php print $row3['semanas'];?></td>
				<td><?php print $row3['hora_inicio'];?></td>
				<!--td><?php /*print $row3['fecha_retiro'];*/?></td-->
                <td>
						<?php
							$link=Conectarse(); 
							$sSQL4="SELECT * FROM t_estatus_inscrito WHERE id_estatus_inscrito=$row3[estatus]";
        					$result4=mysql_query($sSQL4);
							desconectarse();
							$row4=mysql_fetch_array($result4);
							print $row4['estatus_inscrito'];
						?>
                </td>
			</tr>  
           <?php } ?>
     </table>
<?php	   }  ?>
		  


		
<table width="800" border="0" align="center">
  <tr>
    <td width="400"><strong>Tipo de Inscripci&oacute;n</strong></td>
    <td width="400"><?php
	    $link=Conectarse(); 
	  	$sSQL="SELECT * FROM t_tipo_inscripcion WHERE id_tipo_inscripcion=$row[id_tipo_inscripcion]";
        $result=mysql_query($sSQL);
		desconectarse();
		$row2=mysql_fetch_array($result);
		print $row2["tipo_inscripcion"];?>
      </td>
  </tr>
  <tr>
    <td><strong>Carta de Residencia (Vencimiento)</strong></td>
    <td>
    <?php print $row["fecha_carta_resi"];?>
    </td>
  </tr>
  <tr>
    <td><strong>Observaciones:</strong></td>
    <td><?php print $row["obs_inscripcion"];?></td>
  </tr>
</table>
<div>
  <p align="center">
    <input type="submit" name="button" id="button" value="Imprimir">
    <input name="seleccion" type="hidden" id="seleccion" value="2"></p>
  
  </form>
</div>
</body>
</html>