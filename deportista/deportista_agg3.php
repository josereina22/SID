<?php session_start();
	//$id_deportista=$_SESSION['id_deportista'];
?>
<html>
<head>
<!--meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" /-->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>SID</title>
<link rel="stylesheet" type="text/css" href="../estilos/estilo_dep.css">
<link rel="stylesheet" type="text/css" href="../estilos/formularios.css" media="all" />
<script type="text/javascript" src="../jquery/jquery.js"></script>
<style type="text/css">
@import url("../jscalendar/calendar-system.css");.hjh {
	font-size: larger;
}
</style>
<!---***************** Formato para la tabla de  reportes ***************************-->
<link type="text/css" href="../estilos/tablas_report.css" rel="stylesheet" />
<script type="text/javascript" src="../estilos/tablas_report.js"></script>
<!-- ***********************************************************************-->

<!-- import the calendar script -->
<script type="text/javascript" src="../jscalendar/calendar.js"></script>
<!-- import the language module -->
<script type="text/javascript" src="../jscalendar/lang/calendar-es.js"></script>
<script type="text/javascript" src="../jscalendar/calendar-setup.js" /></script>
<link rel="stylesheet" type="text/css" href="../select_dependientes/select_dependientes.css">
<script type="text/javascript" src="../select_dependientes/select_dependientes.js"></script> 
<script type="text/javascript" charset="utf-8">
$(function(){
	$('#menu li a').click(function(event){
		var elem = $(this).next();
		if(elem.is('ul')){
			event.preventDefault();
			$('#menu ul:visible').not(elem).slideUp();
			elem.slideToggle();
		}
	});
});
</script>

<script>
function MostrarClases(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","../clases/obtenerclases.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>

</head>
<body>
<?php 

$id_deportista=$_SESSION['id_deportista'];
if(isset($_GET['id_deportista'])){
	$id_deportista=$_GET['id_deportista'];
	$_SESSION['id_deportista']=$id_deportista;
}


include ('../configuration/conexion.php');
$mysqli=Conectarse(); 
$result=$mysqli->query("SELECT * FROM t_deportista WHERE id_deportista = '$id_deportista'"); 
$row=$result->fetch_array();	
$id_deportista= $row["id_deportista"];

?>



<table width="700" border="0"  align="center" bgcolor="#6594D1">
  <tr>
  	<td colspan="3"><h2 align="center">Datos B&aacute;sicos</h2></td>
  </tr>
     <tr>
      <th><div align="right">C&oacute;digo:</div></th>
      <td><label><?php print $row["id_deportista"];?></label></td>
      <td rowspan="6"><input name="foto" type="file" id="foto" value="<?php print $row["foto"];?>" size="25"  hidden=""/>
      
	  <?php
	  	 if ($row['foto']=="")
		 	{print  "<img src='fotos/sinfoto.png 'border='2' width='129' height='163'>"; }
		 else
			 {print  "<img src='fotos/".$row['foto']."'border='0' width='129' height='163'>"; }
	  		
	  ?>
      </td>
    </tr>
  <tr>
      <th><div align="right">C&eacute;dula:</div></th>
    <td><label> <?php print $row["cedula"];?> </label></td>
      
  </tr>
    <tr>
      <th><div align="right">Nombres:</div></th>
      <td><label><?php print $row["nombres"];?></label></td>
    </tr>
    <tr>
      <th><div align="right">Apellidos:</div></th>
      <td><label><?php print $row["apellidos"];?></label></td>
    </tr>
    <tr>
      <th><div align="right">Sexo:</div></th>
      <td>
      <?php
	  	$id_sexo=$row['id_sexo'];
		$sSQL2="SELECT * FROM t_sexo WHERE id_sexo='$id_sexo'";
        $result2=$mysqli->query($sSQL2);
        $row2=$result2->fetch_array();
        print $row2["sexo"]; 
		
	  ?>   
      </td>
    </tr>
    <tr>
      <th><div align="right">Edad:</div></th>
      <td>
        <label><?php
      setlocale(LC_TIME, 'es_VE'); # Localiza en español es_Venezuela
      date_default_timezone_set('America/Caracas');
      //date_default_timezone_set(); 
		  $fecha_nacimiento=$row["fecha_nac"];
		  $dias=explode("-", $fecha_nacimiento, 3);
		  $dias=mktime(0,0,0,$dias[1],$dias[2],$dias[0]);
		  print $edad=(int)((time()-$dias)/31556926);
		  ?></label>
      </td>
    </tr>
</table>
<ul id="menu"  style="display:none">
<li><a href="#">Otros Datos</a>
	<ul>
<table width="700" border="0">
  <tr>
    <td>Municipio</td>
    <td>
    <?php
	    $link=Conectarse(); 
	  	$sSQL2="SELECT * FROM t_municipio WHERE id_municipio='$row[id_municipio]'";
        $result2=$mysqli->query($sSQL2);
		$row2=$result2->fetch_array();
        print $row2["municipio"];
    ?>
    </td>
    <td>Otro Municipio</td>
    <td><label><?php print $row["otro_municipio"];?></label></td>
  </tr>
  <tr>
    <td>Urbanizaci&oacute;n</td>
    <td>
    <?php
	    $link=Conectarse(); 
	  	$sSQL2="SELECT * FROM t_urbanizacion WHERE id_urbanizacion='$row[id_urbanizacion]'";
        $result2=$mysqli->query($sSQL2);
		$row2=$result2->fetch_array();
        print $row2["urbanizacion"];
    ?>
    </td>
    <td>Otra Urbanizaci&oacute;n</td>
    <td><label><?php print $row["otra_urbanizacion"];?></label></td>
  </tr>
  <tr>
    <td>Av/Calle</td>
    <td><label><?php print $row["av_calle"];?></label></td>
    <td>Edf./Res/Casa</td>
    <td><label><?php print $row["edf_res_casa"]." Nor. ".$row["nro_cas_res"];?></label></td>
  </tr>
  <tr>
    <td>Telf. Casa:</td>
    <td><label><?php print $row["tlf_casa"];?></label></td>
    <td>Telf. Trabajo</td>
    <td><label><?php print $row["tlf_trabajo"];?></label></td>
  </tr>
  <tr>
    <td>Celular 1</td>
    <td><label><?php print $row["celular1"];?></label></td>
    <td>Celular 2</td>
    <td><label><?php print $row["celular2"];?></label></td>
  </tr>
  <tr>
    <td>Correo 1</td>
    <td><label><?php print $row["correo1"];?></label></td>
    <td>Correo 2</td>
    <td><label><?php print $row["correo2"];?></label></td>
  </tr>
</table>
        


<li><a href="#">Ocupaci&oacute;n</a>		
<table width="700" border="0">
  <tr>
    <td>Ocupaci&oacute;n</td>
    <td>
    <?php
	  	$sSQL2="SELECT * FROM t_ocupacion WHERE id_ocupacion='$row[id_ocupacion]'";
        $result2=$mysqli->query($sSQL2);
		$row2=$result2->fetch_array();
        print $row2["ocupacion"];
	  ?>  
    </td>
    <td>
       <div align="right">Otra ocupaci&oacute;n </div></td>
    </td>
    <td>
    <label><?php print $row["otra_ocupacion"];?></label> </td>
  </tr>
  <tr>
    <td>Grado de Instrucci&oacute;n</td>
    <td><?php
	    $link=Conectarse(); 
	  	$sSQL2="SELECT * FROM t_grado_instruccion WHERE id_grado_instruccion='$row[id_grado_instruccion]'";
        $result2=$mysqli->query($sSQL2);
		$row2=$result2->fetch_array();
        print $row2["grado_instruccion"];
	  ?></td>
    <td><div align="right">Empresa donde trabaja</div></td>
    </td>
    <td><label><?php print $row["emp_trabaja"];?></label></td>
  </tr>
  <tr>
    <td><span id="sub1">Instituci&oacute;n donde estudia</span></td>
    <td colspan="3"><?php
	    $link=Conectarse(); 
	  	$sSQL2="SELECT * FROM t_institucion WHERE id_institucion='$row[id_institucion]'";
        $result2=$mysqli->query($sSQL2);
		$row2=$result2->fetch_array();
        print $row2["institucion"];
	  ?>
    </td>
  </tr>
  <tr>
    <td>Grado o A&ntilde;o que Cursa</td>
    <td colspan="3">
    <?php
	    $link=Conectarse(); 
	  	$sSQL2="SELECT * FROM t_grado WHERE id_grado='$row[id_grado]'";
        $result2=$mysqli->query($sSQL2);
		$row2=$result2->fetch_array();
        print $row2["grado"];
	  ?></td>
  </tr>
</table> 
</li>


<li><a href="#">Datos del Representante</a>
<table width="700" border="0">
  <tr>
    <td colspan="2" align="center">Solo en Caso de menores de 18 a&ntilde;os</td>
  </tr>
  <tr>
    <td>Nro. Cedula</td>
    <td>
    <?php 
	  	$sSQL2="SELECT * FROM t_representante WHERE cedula_representante='$row[cedula_representante]'";
        $result2=$mysqli->query($sSQL2);
		$row2=$result2->fetch_array();
        print $row2["cedula_representante"];?></td>
  </tr>
  <tr>
    <td>Nombres</td>
    <td><label><?php print $row2["nombre_representante"];?></label></td>
  </tr>
  <tr>
    <td>Apellidos</td>
    <td><label><?php print $row2["apellido_representante"];?></label></td>
  </tr>
  <tr>
    <td>Parentesco</td>
    <td><label><?php print $row2["parentesco"];?></label></td>
  </tr>
  <tr>
    <td>Ocupaci&oacute;n</td>
    <td><?php
    	$link=Conectarse(); 
	  	$sSQL3="SELECT * FROM t_ocupacion WHERE id_ocupacion='$row2[id_ocupacion]'";
        $result3=$mysqli->query($sSQL3);
		$row3=$result3->fetch_array();
        print $row3["ocupacion"];
	  ?>
    </td>
  </tr>
  <tr>
    <td>Grado de Instrucci&oacute;n</td>
    <td><?php
	
	  	$sSQL3="SELECT * FROM t_grado_instruccion WHERE id_grado_instruccion='$row2[id_grado_instruccion]'";
        $result3=$mysqli->query($sSQL3);
		$row3=$result3->fetch_array();
        print $row3["grado_instruccion"];
	  ?></td>
  </tr>
  <tr>
    <td>Empresa donde Trabaja</td>
    <td><label><?php print $row2["empresa_trabaja"];?></label></td>
  </tr>
</table> 
</li>

<li><a href="#">Datos Medicos</a>
  <table width="700" border="0">
    <tr>
      <td>Grupo Sanguineo</td>
      <td colspan="3"><?php
	    $link=Conectarse(); 
	  	$sSQL2="SELECT * FROM t_grupo_sanguineo WHERE id_grupo_sanguineo='$row[id_grupo_sanguineo]'";
        $result2=$mysqli->query($sSQL2);
		$row2=$result2->fetch_array();
        print $row2["grupo_sanguineo"];
	  ?>
      </td>
    </tr>
    <tr>
      <td>Est&aacute; bajo alg&uacute;n tratamiento m&eacute;dico</td>
      <td colspan="3"><label><?php if ($row['tratamiento_medico']==1) {print 'SI';} elseif ($row['tratamiento_medico']==2) {print 'NO';}?></label>
      </td>
    </tr>
    <tr>
      <td>Especifique</td>
      <td>Tratamiento 1: <label><?php print $row["tratamiento1"];?></label></td>
      <td>Tratamiento 2: <label><?php print $row["tratamiento2"];?></label></td>
      <td>Tratamiento 3: <label><?php print $row["tratamiento3"];?></label></td>
    </tr>
    <tr>
      <td>Sufre alg&uacute;n padecimiento f&iacute;sico</td>
      <td colspan="3"><label><?php if ($row['pad_fisico']==1) {print 'SI';} elseif ($row['pad_fisico']==2) {print 'NO';}?></label></td>
    </tr>
    <tr>
      <td>Especifique</td>
      <td>Padecimiento 1: <label><?php print $row["padecimiento1"];?></label></td>
      <td>Padecimiento 2: <label><?php print $row["padecimiento2"];?></label></td>
      <td>Padecimiento 3: <label><?php print $row["padecimiento3"];?></label></td>
    </tr>
    <tr>
      <td>Eres Al&eacute;rgico</td>
      <td colspan="3"><label><?php if ($row['alergico']==1) {print 'SI';} elseif ($row['alergico']==2) {print 'NO';}?></label></td>
    </tr
    ><tr>
      <td>Especifique<br></td>
      <td>Al&eacute;rgico 1: <label><?php print $row["alergico1"];?></label></td>
      <td>Al&eacute;rgico 2: <label><?php print $row["alergico2"];?></label></td>
      <td>Al&eacute;rgico 3: <label><?php print $row["alergico3"];?></label></td>
    </tr>
    <tr>
      <td>Posee seguro de HCM y/u otro</td>
      <td><label><?php if ($row['hcm']==1) {print 'SI';} elseif ($row['hcm']==2) {print 'NO';}?></label></td>
      <td>¿Cual?</td>
      <td> <label><?php print $row["cual_hcm"];?></label></td>
    </tr>
    <tr>
      <td>Est&aacute; afiliado al seguro socia</td>
       <td><label><?php if ($row['ss']==1) {print 'SI';} elseif ($row['ss']==2) {print 'NO';}?></label></td>
    </tr>
    <tr>
      <td>Observaciones</td>
      <td><label><?php print $row["obs_medicos"];?></label></td>
      <td> Fecha de Vencimiento (constancia)</td>
      <td><label><?php print $row["vence_cm"];?></label></td>
    </tr>
  </table>
  </li>
<li><a href="#">Emergencia</a>

<table width="500" border="0">
  <tr>
    <td>Nombres</td>
    <td><label><?php print $row["nombre_emerg"];?></label></td>
  </tr>
  <tr>
    <td>Apellidos</td>
    <td><label><?php print $row["apellido_emerg"];?></label></td>
  </tr>
  <tr>
    <td>Parentesco</td>
    <td><label><?php print $row["parentesco_emerg"];?></label></td>
  </tr>
  <tr>
    <td >Ocupaci&oacute;n</td>
    <td><label><?php print $row["ocupacion_emerg"];?></label></td>
  </tr>
  <tr>
    <td>Telefono Contacto</td>
    <td><label><?php print $row["tlf_emerg"];?></label></td>
  </tr>
  <tr>
    <td>Lugar de Trabajo</td>
    <td><label><?php print $row["trabajo_emerg"];?></label></td>
  </tr>
</table>
  	</ul>
</li>
</ul>
<?php 
//para saber cuantas clases tiene inscrita el deportista
	  	$sSQL3="SELECT  id_inscrito, fecha_inscripcion, t_clase.cod_clase, instalacion_corta, cancha, disciplina, 
						semanas, t_clase.hora_inicio, fecha_retiro, t_inscrito.estatus
				FROM t_inscrito, t_clase, t_instalacion, t_cancha, t_disciplina, t_horario
				WHERE id_deportista=$id_deportista
				AND t_clase.cod_clase =t_inscrito.cod_clase
				AND t_clase.id_instalacion=t_instalacion.id_instalacion
				AND t_clase.id_cancha =t_cancha.id_cancha
				AND t_clase.id_disciplina =t_disciplina.id_disciplina
				AND t_clase.cod_clase =t_horario.cod_clase
				GROUP BY t_clase.cod_clase, t_inscrito.estatus
				ORDER BY t_inscrito.estatus
				LIMIT 4
				";
        $result3=$mysqli->query($sSQL3);
if($result3->num_rows>0){
?>
        <table align="center" border="1" width="700" id="striped">
					<tr>
                    	<th>Fecha Inscripci&oacute;n</th>
						<th>Clase</th>
						<th>Instalaci&oacute;n</th>
						<th>Cancha</th>
						<th>Disciplina</th>
						<th>D&iacute;as</th>
						<th>Hora</th>
						<th>Retiro</th>
                        <th>Estatus</th>
					</tr>
<?php		
          while ($row3=$result3->fetch_array())
          { ?>
			<tr>
				<td><?php print $row3['fecha_inscripcion'];?></td>
                <td><?php print $row3['cod_clase'];?></td>
				<td><?php print $row3['instalacion_corta'];?></td>
				<td><?php print $row3['cancha'];?></td>
				<td><?php print $row3['disciplina'];?></td>
				<td><?php print $row3['semanas'];?></td>
				<td><?php print $row3['hora_inicio'];?></td>
				<td><?php print $row3['fecha_retiro'];?></td>
                <td>
                	<form name="form_dp" action="../clases/inscripcion.php" method="POST" >
                    <select class="select-style" name="estatus_inscrito" id="estatus_inscrito" style="width:100" onChange="this.form.submit()" >
						<?php
				
							$sSQL4="SELECT * FROM t_estatus_inscrito";
        					$result4=$mysqli->query($sSQL4);
				
							while ($row4=$result4->fetch_array())
							{
								?><option value=<?php print $row4['id_estatus_inscrito'];if($row4['id_estatus_inscrito']==$row3['estatus']){ ?> selected='selected' <?php } ?>><?php print $row4['estatus_inscrito'];?></option><?php }?>
				    </select>
                    <input name="id_inscrito" type="hidden" id="id_inscrito" value="<?php print $row3['id_inscrito'];?>">
                    <input name="cod_clase" type="hidden" id="cod_clase" value="<?php print $row3['cod_clase'];?>">
                    </form>
                </td>
			</tr>  
           <?php } ?>
     </table>
<?php	   }  ?>
		  
<div  class="form" style="width:700px;">
<form name="form_dp" action="case_deportista.php" method="POST"  enctype="multipart/form-data" target="_blank">
		
<table width="700" border="0" align="center">
  <tr>
    <th><div align="right">Disciplina</div></th>
    <td>
    
    <?php
	    $link=Conectarse(); 
		$_SESSION['edad']=$edad;
		$_SESSION['id_sexo']=$id_sexo;
	  	$sSQL3="SELECT * 
				FROM t_clase, t_disciplina 
				WHERE (edad_min <=$edad AND edad_max>=$edad) 
				AND t_clase.id_disciplina= t_disciplina.id_disciplina 
				GROUP BY t_clase.id_disciplina, t_clase.sexo";
        $result3=$mysqli->query($sSQL3);
	?>
        <select class="select-style" name="tipo_inscripcion" id="tipo_inscripcion" onChange="MostrarClases(this.value)">
        <option value='0'>Seleccione</option>
   <?php //Generamos el menu desplegable
          while ($row3=$result3->fetch_array())
		  {
			  if ($row3["sexo"]==$id_sexo or $row3["sexo"]==3)
			   	{
					?>
          	<option value=<?php print $row3["id_disciplina"];?>><?php print $row3["disciplina"];?></option>
           <?php }//cierro if de sexo
		   	}//cierro while ?>
	  </select>
    </td>
  </tr>
  
 <tr> 
 	<th colspan="2">
    <div align="right"><br>
    </div>
    <div id="txtHint">
      <div align="right"><b></b></div>
    </div>
    </th>
 </tr> 
  
  <tr>
    <th><div align="right">Tipo de Inscripci&oacute;n</div></th>
    <td><?php
	    $link=Conectarse(); 
	  	$sSQL="SELECT * FROM t_tipo_inscripcion";
        $result=$mysqli->query($sSQL);
	?>
        <select class="select-style" name="tipo_inscripcion" id="tipo_inscripcion">
        <option value='0'>Seleccione</option>
   <?php //Generamos el menu desplegable
          while ($row2=$result->fetch_array())
		  {?>
          	<option value=<?php print $row2["id_tipo_inscripcion"]; if($row2["id_tipo_inscripcion"]==$row["id_tipo_inscripcion"]){?> selected="selected" <?php }?>><?php print $row2["tipo_inscripcion"];?></option>
           <?php } ?>
	  </select>
      </td>
  </tr>
  <tr>
    <th><div align="right">Fecha de Vencimiento (Constancia)</div></th>
    <td>
    <input name="fecha_const_tipo" type="text" id="fecha_const_tipo" value="<?php print $row["fecha_const_tipo"];?>" size="30" maxlength="15" readonly/>	
         <img src="../jscalendar/img.gif" id="selecresid" />
         <script type='text/javascript'>
            Calendar.setup({
            inputField: 'fecha_const_tipo',
            ifFormat:   '%Y-%m-%d',
            button:     'selecresid'
            });
         </script>
    </td>
  </tr>
  <tr>
    <th bgcolor=""><div align="right">Observaciones es para Usos Interno</div></th>
    <td><textarea name="observasiones_inscripcion" cols="55" rows="4" id="observasiones_inscripcion"><?php print $row["obs_inscripcion"];?></textarea></td>
  </tr>
</table>
<div>
  <p align="center">
    <input class="buttom" type="submit" name="button" id="button" value="Guardar">
    <input name="seleccion" type="hidden" id="seleccion" value="2"></p>
</div>
</form>
</div> <!-- Clase From-->
<?php
	if (isset($_GET['mensaje']))
		{if ($_GET['mensaje']==1){print "<script>alert('Ya el Atleta está Inscrito en la Clase y Está Activo')</script>";}
		 if ($_GET['mensaje']==2){print "<script>alert('Máximo hasta Cuatro (4) Disciplinas Activa por atleta')</script>";}
		}
?>
</body>
</html>