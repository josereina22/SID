<?php 
if(isset($_GET['id_deportista'])){
	include ('../configuration/conexion.php');
	Conectarse();
	$sql="SELECT * FROM t_deportista
			WHERE t_deportista.id_deportista=".$_GET['id_deportista'];
	$resultado=mysql_query($sql);
	$registro= mysql_fetch_array($resultado);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>SID</title>
<!--link rel="stylesheet" type="text/css" href="../estilos/estilo_dep.css"-->
<script type="text/javascript" src="../jquery/jquery.js"></script>
<style type="text/css">
@import url("../jscalendar/calendar-system.css");.hjh {
	font-size: larger;
}
</style>

<style type="text/css">
#tabs{
  overflow: hidden;
  width: 100%;
  margin: 0;
  padding: 0;
  list-style: none;
}
 
#tabs li{
  float: left;
  margin: 0 .5em 0 0;
}
 
#tabs a{
  position: relative;
  background: #ddd;
  background-image: linear-gradient(to bottom, #fff, #ddd);
  padding: .2em 1em;
  float: left;
  text-decoration: none;
  color: #444;
  text-shadow: 0 1px 0 rgba(255,255,255,.8);
  border-radius: 5px 0 0 0;
  box-shadow: 0 2px 2px rgba(0,0,0,.4);
}
 
#tabs a:hover,
#tabs a:hover::after,
#tabs a:focus,
#tabs a:focus::after{
  background: #fff;
}
 
#tabs a:focus{
  outline: 0;
}
 
#tabs a::after{
  content:'';
  position:absolute;
  z-index: 1;
  top: 0;
  right: -.5em;
  bottom: 0;
  width: 1em;
  background: #ddd;
  background-image: linear-gradient(to bottom, #fff, #ddd);
  box-shadow: 2px 2px 2px rgba(0,0,0,.4);
  transform: skew(10deg);
  border-radius: 0 5px 0 0;
}
 
#tabs #current a,
#tabs #current a::after{
  background: #fff;
  z-index: 3;
}
 
#content
{
    background: #fff;
    padding: 2em;
    /*height: 220px;*/
    position: inherit;
    z-index: 2;
    border-radius: 0 5px 5px 5px;
    box-shadow: 0 -2px 3px -2px rgba(0, 0, 0, .5);
}

</style>

<!-- import the calendar script -->
<script type="text/javascript" src="../jscalendar/calendar.js"></script>
<!-- import the language module -->
<script type="text/javascript" src="../jscalendar/lang/calendar-es.js"></script>
<script type="text/javascript" src="../jscalendar/calendar-setup.js" /></script>
<link rel="stylesheet" type="text/css" href="select_dependientes/select_dependientes.css">
<script type="text/javascript" src="select_dependientes/select_dependientes.js"></script> 
<script type="text/javascript" charset="utf-8">
/*$(function(){
	$('#menu li a').click(function(event){
		var elem = $(this).next();
		if(elem.is('ul')){
			event.preventDefault();
			$('#menu ul:visible').not(elem).slideUp();
			elem.slideToggle();
		}
	});
});*/
</script>

<!--////////////////////////////////////////Nuevo Menu///////////////////////////-->
<script>
$(document).ready(function() {
    $("#content").find("[id^='tab']").hide(); // Ocultar todo el contenido
    $("#tabs li:first").attr("id","current"); // Activar la primera pestaña
    $("#content #tab1").fadeIn(); // Mostrar contenido de primera pestaña
    
    $('#tabs a').click(function(e) {
        e.preventDefault();
        if ($(this).closest("li").attr("id") == "current"){ //detección para la pestaña actual
         return;       
        }
        else{             
          $("#content").find("[id^='tab']").hide(); // Ocultar todo el contenido
          $("#tabs li").attr("id",""); //Restablecer de Identificación
         $(this).parent().attr("id","current"); // Active este id
         $('#' + $(this).attr('name')).fadeIn(); // Mostrar contenido para la ficha actual
        }
    });
});
</script>
<!--//////////////////////////////////////////////////--///////////////////////////-->



</head>
<body>
<form name="form_dp" action="case_deportista.php" method="POST"  enctype="multipart/form-data">
<ul id="tabs">
    <li><a href="#" name="tab1" title="tab1">Datos B&aacute;sicos</a></li>
    <li><a href="#" name="tab2" title="tab2">Direcci&oacute;n de Residencia</a></li>
    <li><a href="#" name="tab3" title="tab3">Ocupaci&oacute;n</a></li>
    <li><a href="#" name="tab4" title="tab4">Datos del Representante</a></li>
    <li><a href="#" name="tab5" title="tab5">Datos Medicos</a></li>
    <li><a href="#" name="tab6" title="tab6">Emergencia</a></li>
</ul>


<div id="content">
    <div id="tab1" >

<table width="700" border="0">
  <tr>
    <td align="right"><label for="cedula">Cédula:</label></td>
      <td>
      <input name="id_deportista" type="hidden" id="id_deportista" value="<?php print $registro['id_deportista']?>" >
      <input name="cedula" type="text" id="cedula" value="<?php print $registro['cedula']?>" maxlength="10">
        *</td>
      <td rowspan="5">
        <img src="<?php print "fotos/".$registro['foto']?>" width="115" height="140">
        <input name="foto" type="file" id="foto" size="25" hidden="hidden" />  
        </td>
  </tr>
    <tr>
      <td align="right"><label for="nombres">Nombres:</label></td>
      <td><input name="nombres" type="text" id="nombres" value="<?php print $registro['nombres']?>"size="25" maxlength="25">
        *</td>
    </tr>
    <tr>
      <td align="right">Apellidos:</td>
      <td><input name="apellidos" type="text" id="apellidos" value="<?php print $registro['apellidos']?>"size="25" maxlength="25">
        *</td>
    </tr>
    <tr>
      <td align="right">Sexo:</td>
      <td>
      <?php
	  	
	    $link=Conectarse(); 
	  	$sSQL="SELECT * FROM t_sexo";
        $result=mysql_query($sSQL);
		desconectarse();
		$i=1;
	  ?>
        <select name="sexo" id="sexo">
        <option value="0">Seleccione</option>
         <?php //Generamos el menu desplegable
          while ($row=mysql_fetch_array($result))
          {?>
          	<option value=<?php print $row["id_sexo"]; if($row["id_sexo"]==$registro["id_sexo"]){?> selected="selected" <?php }?>><?php print $row["sexo"];?></option>
           <?php } ?>
		  </select>*
      </td>
    </tr>
    <tr>
      <td align="right">Fecha de Nacimiento:</td>
      <td>
           <input name="fecha_nac" type="text" id="fecha_nac" value="<?php print $registro['fecha_nac']?>" size="25" maxlength="15" readonly/>	
         <img src="../jscalendar/img.gif" id="seleci" />
         <script type='text/javascript'>
            Calendar.setup({
            inputField: 'fecha_nac',
            ifFormat:   '%Y-%m-%d',
            button:     'seleci'
            });
         </script>
      </td>
    </tr>
</table>

</div>
    <div id="tab2">
		
<table width="700" border="0">
  <tr>
    <td>Municipio</td>
    <td>
    <?php
	    $link=Conectarse(); 
	  	$sSQL="SELECT * FROM t_municipio";
        $result=mysql_query($sSQL);
		desconectarse();
	?>
        <select name="municipio" id="municipio" onChange="cargaContenido(this.id)">
        <option value='0'>Seleccione</option>
   <?php //Generamos el menu desplegable
          while ($row=mysql_fetch_array($result))
		  {?>
          	<option value=<?php print $row["id_municipio"]; if($row["id_municipio"]==$registro["id_municipio"]){?> selected="selected" <?php }?>><?php print $row["municipio"];?></option>
           <?php } ?>
	  </select>
    </td>
    <td>Otro Municipio</td>
    <td><input type="text" name="otro_municipio" id="otro_municipio" value="<?php print $registro['otro_municipio']?>"></td>
  </tr>
  <tr>
    <td>Urbanizaci&oacute;n</td>
    <td>
       <!-- <select name="urbanizacion" id="urbanizacion">
          <option value ="-">Selecciona opci&oacute;n...
          </select> -->
      <?php
	    $link=Conectarse(); 
	  	$sSQL="SELECT * FROM t_urbanizacion";
        $result=mysql_query($sSQL);
		desconectarse();
	?>
        <select name='urbanizacion' id='urbanizacion' onChange='cargaContenido(this.id)'>
        <option value='0'>Seleccione</option>
   <?php //Generamos el menu desplegable
          while ($row=mysql_fetch_array($result))
		  {?>
          	<option value=<?php print $row["id_urbanizacion"]; if($row["id_urbanizacion"]==$registro["id_urbanizacion"]){?> selected="selected" <?php }?>><?php print $row["urbanizacion"];?></option>
           <?php } ?>
	  </select>
    </td>
    <td>Otra Urbanizaci&oacute;n</td>
    <td><input type="text" name="otra_urbanizacion" id="otra_urbanizacion" value="<?php print $registro['otra_urbanizacion']?>"></td>
  </tr>
  <tr>
    <td>Av/Calle</td>
    <td><input type="text" name="calle" id="calle" value="<?php print $registro['av_calle']?>"></td>
    <td>Edf./Res/Casa</td>
    <td><input type="text" name="casa_res" id="casa_res" value="<?php print $registro['edf_res_casa']?>"></td>
  </tr>
  <tr>
    <td>Telf. Casa:</td>
    <td><input type="text" name="tlf_casa" id="tlf_casa" value="<?php print $registro['tlf_casa']?>"></td>
    <td>Telf. Trabajo</td>
    <td><input type="text" name="tlf_trabajo" id="tlf_trabajo" value="<?php print $registro['tlf_trabajo']?>"></td>
  </tr>
  <tr>
    <td>Celular 1</td>
    <td><input type="text" name="celular1" id="celular1" value="<?php print $registro['celular1']?>"></td>
    <td>Celular 2</td>
    <td><input type="text" name="celular2" id="celular2" value="<?php print $registro['celular2']?>"></td>
  </tr>
  <tr>
    <td>Correo 1</td>
    <td><input type="text" name="correo1" id="correo1" value="<?php print $registro['correo1']?>"></td>
    <td>Correo 2</td>
    <td><input type="text" name="correo2" id="correo2" value="<?php print $registro['correo2']?>"></td>
  </tr>
</table>
        
</div>
    <div id="tab3">
		

<table width="700" border="0">
  <tr>
    <td>Ocupaci&oacute;n</td>
    <td>
    <?php
	    $link=Conectarse(); 
	  	$sSQL="SELECT * FROM t_ocupacion";
        $result=mysql_query($sSQL);
		desconectarse();
	?>
        <select name='ocupacion' id='ocupacion'>
        <option value='0'>Seleccione</option>
   <?php //Generamos el menu desplegable
          while ($row=mysql_fetch_array($result))
		  {?>
          	<option value=<?php print $row["id_ocupacion"]; if($row["id_ocupacion"]==$registro["id_ocupacion"]){?> selected="selected" <?php }?>><?php print $row["ocupacion"];?></option>
           <?php } ?>
	  </select>
    </td>
    <td>
       <div align="right">Otra ocupaci&oacute;n </div></td>
    </td>
    <td>
    <input type="text" name="otra_ocupacion" id="otra_ocupacion" value="<?php print $registro['otra_ocupacion']?>"> </td>
  </tr>
  <tr>
    <td>Grado de Instrucci&oacute;n</td>
    <td>
	<?php
	    $link=Conectarse(); 
	  	$sSQL="SELECT * FROM t_grado_instruccion";
        $result=mysql_query($sSQL);
		desconectarse();
	?>
        <select name='grado_instruccion' id='grado_instruccion'>
        <option value='0'>Seleccione</option>
   <?php //Generamos el menu desplegable
          while ($row=mysql_fetch_array($result))
		  {?>
          	<option value=<?php print $row["id_grado_instruccion"]; if($row["id_grado_instruccion"]==$registro["id_grado_instruccion"]){?> selected="selected" <?php }?>><?php print $row["grado_instruccion"];?></option>
           <?php } ?>
	  </select>
    </td>
    <td><div align="right">Empresa donde trabaja</div></td>
    </td>
    <td><input type="text" name="emp_trabaja" id="emp_trabaja" value="<?php print $registro['emp_trabaja']?>"></td>
  </tr>
  <tr>
    <td><span id="sub1">Instituci&oacute;n donde estudia</span></td>
    <td colspan="3"><?php
	    $link=Conectarse(); 
	  	$sSQL="SELECT * FROM t_institucion";
        $result=mysql_query($sSQL);
		desconectarse();
	?>
        <select name='institucion' id='institucion'>
        <option value='0'>Seleccione</option>
   <?php //Generamos el menu desplegable
          while ($row=mysql_fetch_array($result))
		  {?>
          	<option value=<?php print $row["id_institucion"]; if($row["id_institucion"]==$registro["id_institucion"]){?> selected="selected" <?php }?>><?php print $row["institucion"];?></option>
           <?php } ?>
	  </select>
    </td>
  </tr>
  <tr>
    <td>Grado o A&ntilde;o que Cursa</td>
    <td colspan="3">
    <?php
	    $link=Conectarse(); 
	  	$sSQL="SELECT * FROM t_grado";
        $result=mysql_query($sSQL);
		desconectarse();
	?>
        <select name='grado' id='grado'>
        <option value='0'>Seleccione</option>
   <?php //Generamos el menu desplegable
          while ($row=mysql_fetch_array($result))
		  {?>
          	<option value=<?php print $row["id_grado"]; if($row["id_grado"]==$registro["id_grado"]){?> selected="selected" <?php }?>><?php print $row["grado"];?></option>
           <?php } ?>
	  </select></td>
  </tr>
</table>

</div>
    <div id="tab4">
		
<table width="700" border="0">
  <tr>
    <td colspan="2" align="center">Solo en Caso de menores de 18 a&ntilde;os</td>
  </tr>
  <tr>
    <td>Nro. Cedula</td>
    <td><input type="text" name="cedula_repres" id="cedula_repres" value="<?php print $registro['id_representante']?>"></td>
  </tr>
  <?php
   $link=Conectarse(); 
  	$sqlr="SELECT * FROM t_representante
			WHERE id_deportista=".$_GET['id_deportista'];
	$resultador=mysql_query($sqlr);
	$registror= mysql_fetch_array($resultador);
	desconectarse();
  ?>
  
  <tr>
    <td>Nombres</td>
    <td><input type="text" name="nombre_repres" id="nombre_repres" value="<?php print $registror['nombre_representante']?>"></td>
  </tr>
  <tr>
    <td>Apellidos</td>
    <td><input type="text" name="apellido_repres" id="apellido_repres" value="<?php print $registror['apellido_representante']?>"></td>
  </tr>
  <tr>
    <td>Parentesco</td>
    <td><input type="text" name="parentesco" id="parentesco" value="<?php print $registror['parentesco']?>"></td>
  </tr>
  <tr>
    <td>Ocupaci&oacute;n</td>
    <td>
	<?php
	    $link=Conectarse(); 
	  	$sSQL="SELECT * FROM t_ocupacion";
        $result=mysql_query($sSQL);
		desconectarse();
	?>
        <select name='ocupacion_repres' id='ocupacion_repres'>
        <option value='0'>Seleccione</option>
   <?php //Generamos el menu desplegable
          while ($row=mysql_fetch_array($result))
		  {?>
          	<option value=<?php print $row["id_ocupacion"]; if($row["id_ocupacion"]==$registror["id_ocupacion"]){?> selected="selected" <?php }?>><?php print $row["ocupacion"];?></option>
           <?php } ?>
	  </select>
    </td>
  </tr>
  <tr>
    <td>Grado de Instrucci&oacute;n</td>
    <td>
	<?php
	    $link=Conectarse(); 
	  	$sSQL="SELECT * FROM t_grado_instruccion";
        $result=mysql_query($sSQL);
		desconectarse();
	?>
        <select name='grado_instruccion_repres' id='grado_instruccion_repres'>
        <option value='0'>Seleccione</option>
   <?php //Generamos el menu desplegable
          while ($row=mysql_fetch_array($result))
		  {?>
          	<option value=<?php print $row["id_grado_instruccion"]; if($row["id_grado_instruccion"]==$registror["id_grado_instruccion"]){?> selected="selected" <?php }?>><?php print $row["grado_instruccion"];?></option>
           <?php } ?>
	  </select>
	  </td>
  </tr>
  <tr>
    <td>Empresa donde Trabaja</td>
    <td><input type="text" name="empresa_repres" id="empresa_repres" value="<?php print $registror['empresa_trabaja']?>"></td>
  </tr>
</table>
        
</div>
    <div id="tab5">
    
  <table width="700" border="0">
    <tr>
      <td>Grupo Sanguineo</td>
      <td colspan="3">
	  <?php
	    $link=Conectarse(); 
	  	$sSQL="SELECT * FROM t_grupo_sanguineo";
        $result=mysql_query($sSQL);
		desconectarse();
	?>
        <select name='grupo_sanguineo' id='grupo_sanguineo'>
        <option value='0'>Seleccione</option>
   <?php //Generamos el menu desplegable
          while ($row=mysql_fetch_array($result))
		  {?>
          	<option value=<?php print $row["id_grupo_sanguineo"]; if($row["id_grupo_sanguineo"]==$registro["id_grupo_sanguineo"]){?> selected="selected" <?php }?>><?php print $row["grupo_sanguineo"];?></option>
           <?php } ?>
	  </select>
      </td>
    </tr>
    <tr>
      <td>Est&aacute; bajo alg&uacute;n tratamiento m&eacute;dico</td>
      <td colspan="3">
      <select name="tratamiento_medico" id="tratamiento_medico">
        <option value="0" selected>Selecciones</option>
        <option value="1" <?php if($registro["tratamiento_medico"]==1){?> selected="selected" <?php }?> >Si</option>
        <option value="2" <?php if($registro["tratamiento_medico"]==2){?> selected="selected" <?php }?> >No</option>
      </select></td>
    </tr>
    <tr>
      <td>Especifique</td>
      <td>Tratamiento 1
        <input type="text" name="tratamiento1" id="tratamiento1" value="<?php print $registro['tratamiento1']?>"></td>
      <td>Tratamiento 2
        <input type="text" name="tratamiento2" id="tratamiento2" value="<?php print $registro['tratamiento2']?>"></td>
      <td>Tratamiento 3
        <input type="text" name="tratamiento3" id="tratamiento3" value="<?php print $registro['tratamiento3']?>"></td>
    </tr>
    <tr>
      <td>Sufre alg&uacute;n padecimiento f&iacute;sico</td>
      <td colspan="3"><select name="padecimiento_fisico" id="padecimiento_fisico">
        <option value="0" selected>Seleccione</option>
        <option value="1" <?php if($registro["pad_fisico"]==1){?> selected="selected" <?php }?> >Si</option>
        <option value="2" <?php if($registro["pad_fisico"]==2){?> selected="selected" <?php }?> >No</option>
      </select></td>
    </tr>
    <tr>
      <td>Especifique</td>
      <td>Padecimiento 1        <input type="text" name="padecimiento1" id="padecimiento1" value="<?php print $registro['padecimiento1']?>"></td>
      <td>Padecimiento 2        <input type="text" name="padecimiento2" id="padecimiento2" value="<?php print $registro['padecimiento2']?>"></td>
      <td>Padecimiento 3        <input type="text" name="padecimiento3" id="padecimiento3" value="<?php print $registro['padecimiento3']?>"></td>
    </tr>
    <tr>
      <td>Eres Al&eacute;rgico</td>
      <td colspan="3"><select name="alergico" id="alergico">
        <option value="0" selected>Seleccione</option>
        <option value="1">Si</option>
        <option value="2">No</option>
      </select></td>
    </tr>
    <tr>
      <td>Especifique<br></td>
      <td>Al&eacute;rgico 1<input type="text" name="alergico1" id="alergico1" value="<?php print $registro['alergico1']?>"></td>
      <td>Al&eacute;rgico 2<input type="text" name="alergico2" id="alergico2" value="<?php print $registro['alergico2']?>"></td>
      <td>Al&eacute;rgico 3<input type="text" name="alergico3" id="alergico3" value="<?php print $registro['alergico3']?>"></td></td>
    </tr>
    <tr>
      <td>Posee seguro de HCM y/u otro</td>
      <td><select name="hcm" id="hcm">
        <option value="0" selected>Seleccione</option>
        <option value="1" <?php if($registro["hcm"]==1){?> selected="selected" <?php }?> >Si</option>
        <option value="2" <?php if($registro["hcm"]==2){?> selected="selected" <?php }?> >No</option>
      </select></td>
      <td>¿Cual?</td>
      <td><input type="text" name="cual_hcm" id="cual_hcm"></td>
    </tr>
    <tr>
      <td>Est&aacute; afiliado al seguro socia</td>
      <td colspan="3"><select name="ss" id="ss">
        <option value="0" selected>Seleccione</option>
        <option value="1" <?php if($registro["ss"]==1){?> selected="selected" <?php }?> >Si</option>
        <option value="2" <?php if($registro["ss"]==2){?> selected="selected" <?php }?> >No</option>
      </select></td>
    </tr>
    <tr>
      <td>Observaciones</td>
      <td colspan="3"><textarea name="observasiones_medicos" cols="55" rows="4" id="observasiones_medicos" ><?php print $registro['obs_medicos']?>
      </textarea></td>
    </tr>
  </table>

</div>
    <div id="tab6">

<table width="700" border="0">
  <tr>
    <td>Nombres</td>
    <td><input type="text" name="nombre_emerg" id="nombre_emerg" value="<?php print $registro['nombre_emerg']?>"></td>
  </tr>
  <tr>
    <td>Apellidos</td>
    <td><input type="text" name="apellido_emerg" id="apellido_emerg" value="<?php print $registro['apellido_emerg']?>"></td>
  </tr>
  <tr>
    <td>Parentesco</td>
    <td><input type="text" name="parentesco_emerg" id="parentesco_emerg" value="<?php print $registro['parentesco_emerg']?>"></td>
  </tr>
  <tr>
    <td >Ocupaci&oacute;n</td>
    <td><input type="text" name="ocupacion_emerg" id="ocupacion_emerg" value="<?php print $registro['ocupacion_emerg']?>"></td>
  </tr>
  <tr>
    <td>Telefono Contacto</td>
    <td><input type="text" name="tlf_emerg" id="tlf_emerg" value="<?php print $registro['tlf_emerg']?>"></td>
  </tr>
  <tr>
    <td>Lugar de Trabajo</td>
    <td><input type="text" name="trabajo_emerg" id="trabajo_emerg" value="<?php print $registro['trabajo_emerg']?>"></td>
  </tr>
</table>

</div>
</div>

<div>
  <p align="center">
    <input type="submit" name="button" id="button" value="Guardar">
    <input name="seleccion" type="hidden" id="seleccion" value="1"></p>
</div>
</form>
<?php	}
////en caso de que la variable no venga del metodo get
else{
	print "NO";
	exit;
}?>
</body>

</html>
