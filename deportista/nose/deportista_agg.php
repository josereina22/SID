<?php include_once("configuration/conexion.php"); ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>Agregar Deportista</title>
<style type="text/css">
@import url("jscalendar/calendar-system.css");.hjh {
	font-size: larger;
}
</style>
<!-- import the calendar script -->
<script type="text/javascript" src="jscalendar/calendar.js"></script>
<!-- import the language module -->
<script type="text/javascript" src="jscalendar/lang/calendar-es.js"></script>
<script type="text/javascript" src="jscalendar/calendar-setup.js" /></script>

<link href="deportista/menu_deportista.css" rel="stylesheet" type="text/css">
<script src="jquery/jquery.js"></script>
<link rel="stylesheet" type="text/css" href="select_dependientes/select_dependientes.css">
<script type="text/javascript" src="select_dependientes/select_dependientes.js"></script> 
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
</head>
<body>

<ul id="tabs">
    <li><a href="#" name="tab1" title="tab1">Datos B&aacute;sicos</a></li>
    <li><a href="#" name="tab2" title="tab2">Ocupaci&oacute;n </a></li>
    <li><a href="#" name="tab3" title="tab3">Datos del Representante</a></li>
    <li><a href="#" name="tab4" title="tab4">Direcci&oacute;n de Residencia</a></li>
    <li><a href="#" name="tab5" title="tab5">Solicitud / Aprobaci&oacute;n de Cupo</a></li>
    <li><a href="#" name="tab6" title="tab6">Datos Medicos</a></li>
    <li><a href="#" name="tab7" title="tab7">Emergencia</a></li>
</ul>
<div id="content">
<form name="form_dp" action="case_deportista.php" method="POST"  enctype="multipart/form-data">
    <div id="tab1">
<table width="700" border="0">
  <tr>
    <td width="159" align="right" bgcolor="#999999">C&eacute;dula:</td>
      <td width="295" bgcolor="#999999"><input name="cedula" type="text" id="cedula" onKeyPress="return isNumberKey(event)" maxlength="10">
        *</td>
      <td width="232" rowspan="5" bgcolor="#999999"><div align="center"><strong>FOTO</strong></div>
      <input type="file" name="foto" id="foto" /></td>
  </tr>
    <tr bgcolor="#D8D8D8">
      <td align="right">Nombres:</td>
      <td><input name="nombres" type="text" id="nombres" size="30" maxlength="30">
        *</td>
    </tr>
    <tr>
      <td align="right" bgcolor="#999999">Apellidos:</td>
      <td bgcolor="#999999"><p>
          <input name="apellidos" type="text" id="apellidos" size="30" maxlength="30">
        *</p></td>
    </tr>
    <tr bgcolor="#D8D8D8">
      <td align="right">Sexo:</td>
      <td>
      <?php
	    $link=Conectarse(); 
	  	$sSQL="SELECT * FROM t_sexo";
        $result=mysql_query($sSQL);
		desconectarse();
        echo "<select name='sexo' id='sexo'>";
        echo "<option value='0'>Seleccione</option>";
          //Generamos el menu desplegable
          while ($row=mysql_fetch_array($result))
          {echo '<option value='.$row["id_sexo"].'>'.$row["sexo"].'</option>';} 
		  echo '</select>';
	  ?>   
      *</td>
    </tr>
    <tr>
      <td align="right" bgcolor="#999999">Fecha de Nacimiento:</td>
      <td bgcolor="#999999">
           <input name="fecha_nac" type="text" id="fecha_nac" size="30" maxlength="15" readonly/>	
         <img src="jscalendar/img.gif" id="seleci" />
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
    <td width="160" height="28" bgcolor="#999999">Ocupaci&oacute;n</td>
    <td width="169" bgcolor="#999999">
    <?php
	    $link=Conectarse(); 
	  	$sSQL="SELECT * FROM t_ocupacion";
        $result=mysql_query($sSQL);
		desconectarse();
        echo "<select name='ocupacion' id='ocupacion'>";
        echo "<option value='0'>Seleccione</option>";
          //Generamos el menu desplegable
          while ($row=mysql_fetch_array($result))
          {echo '<option value='.$row["id_ocupacion"].'>'.$row["ocupacion"].'</option>';} 
		  echo '</select>';
	  ?>  
    </td>
    <td width="163" bgcolor="#999999"><span id="sub2">
      <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tbody>
          <tr>
            <td><div align="right">Otra ocupaci&oacute;n </div></td>
          </tr>
        </tbody>
      </table>
    </span></td>
    <td width="180" bgcolor="#999999">
    <input type="text" name="otra_ocupacion" id="otra_ocupacion"> </td>
  </tr>
  <tr bgcolor="#D8D8D8">
    <td>Grado de Instrucci&oacute;n</td>
    <td><?php
	    $link=Conectarse(); 
	  	$sSQL="SELECT * FROM t_grado_instruccion";
        $result=mysql_query($sSQL);
		desconectarse();
        echo "<select name='grado_instruccion' id='grado_instruccion'>";
        echo "<option value='0'>Seleccione</option>";
          //Generamos el menu desplegable
          while ($row=mysql_fetch_array($result))
          {echo '<option value='.$row["id_grado_instruccion"].'>'.$row["grado_instruccion"].'</option>';} 
		  echo '</select>';
	  ?></td>
    <td><span id="sub3">
      <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tbody>
          <tr>
            <td><div align="right">Empresa donde trabaja</div></td>
          </tr>
        </tbody>
      </table>
    </span></td>
    <td><input type="text" name="emp_trabaja" id="emp_trabaja"></td>
  </tr>
  <tr>
    <td bgcolor="#999999"><span id="sub1">Instituci&oacute;n donde estudia</span></td>
    <td colspan="3" bgcolor="#999999"><?php
	    $link=Conectarse(); 
	  	$sSQL="SELECT * FROM t_institucion";
        $result=mysql_query($sSQL);
		desconectarse();
        echo "<select name='institucion' id='institucion'>";
        echo "<option value='0'>Seleccione</option>";
          //Generamos el menu desplegable
          while ($row=mysql_fetch_array($result))
          {echo '<option value='.$row["id_institucion"].'>'.$row["institucion"].'</option>';} 
		  echo '</select>';
	  ?>
    
    </td>
  </tr>
  <tr bgcolor="#D8D8D8">
    <td>Grado o A&ntilde;o que Cursa</td>
    <td colspan="3">
    <?php
	    $link=Conectarse(); 
	  	$sSQL="SELECT * FROM t_grado";
        $result=mysql_query($sSQL);
		desconectarse();
        echo "<select name='grado' id='grado'>";
        echo "<option value='0'>Seleccione</option>";
          //Generamos el menu desplegable
          while ($row=mysql_fetch_array($result))
          {echo '<option value='.$row["id_grado"].'>'.$row["grado"].'</option>';} 
		  echo '</select>';
	  ?></td>
  </tr>
</table>
</div>
<div id="tab3">
<table width="700" border="0">
  <tr bgcolor="#D8D8D8">
    <td colspan="2">Solo en Caso de menores de 18 a&ntilde;os</td>
  </tr>
  <tr bgcolor="#999999">
    <td width="160">Nombres</td>
    <td width="325"><input type="text" name="nombre_repres" id="nombre_repres"></td>
  </tr>
  <tr bgcolor="#D8D8D8">
    <td>Apellidos</td>
    <td><input type="text" name="apellido_repres" id="apellido_repres"></td>
  </tr>
  <tr bgcolor="#999999">
    <td>Parentesco</td>
    <td><input type="text" name="parentesco" id="parentesco"></td>
  </tr>
  <tr bgcolor="#D8D8D8">
    <td>Ocupaci&oacute;n</td>
    <td><?php
	    $link=Conectarse(); 
	  	$sSQL="SELECT * FROM t_ocupacion";
        $result=mysql_query($sSQL);
		desconectarse();
        echo "<select name='ocupacion_repres' id='ocupacion_repres'>";
        echo "<option value='0'>Seleccione</option>";
          //Generamos el menu desplegable
          while ($row=mysql_fetch_array($result))
          {echo '<option value='.$row["id_ocupacion"].'>'.$row["ocupacion"].'</option>';} 
		  echo '</select>';
	  ?>
    </td>
  </tr>
  <tr bgcolor="#999999">
    <td>Grado de Instrucci&oacute;n</td>
    <td><?php
	    $link=Conectarse(); 
	  	$sSQL="SELECT * FROM t_grado_instruccion";
        $result=mysql_query($sSQL);
		desconectarse();
        echo "<select name='grado_instruccion_repres' id='grado_instruccion_repres'>";
        echo "<option value='0'>Seleccione</option>";
          //Generamos el menu desplegable
          while ($row=mysql_fetch_array($result))
          {echo '<option value='.$row["id_grado_instruccion"].'>'.$row["grado_instruccion"].'</option>';} 
		  echo '</select>';
	  ?></td>
  </tr>
  <tr bgcolor="#D8D8D8">
    <td>Empresa donde Trabaja</td>
    <td><input type="text" name="empresa_repres" id="empresa_repres"></td>
  </tr>
</table>
</div>
<div id="tab4">
<table width="700" border="0">
  <tr bgcolor="#999999">
    <td width="70">Municipio</td>
    <td width="266">
    <?php
	    $link=Conectarse(); 
	  	$sSQL="SELECT * FROM t_municipio";
        $result=mysql_query($sSQL);
		desconectarse();
        echo "<select name='municipio' id='municipio' onChange='cargaContenido(this.id)'>>";
        echo "<option value='0'>Seleccione</option>";
          //Generamos el menu desplegable
          while ($row=mysql_fetch_array($result))
          {echo '<option value='.$row["id_municipio"].'>'.$row["municipio"].'</option>';} 
		  echo '</select>';
	  ?>
    </td>
    <td width="136">Otro Municipio</td>
    <td width="200"><input type="text" name="otro_municipio" id="otro_municipio"></td>
  </tr bgcolor="#D8D8D8">
  <tr bgcolor="#D8D8D8">
    <td >Urbanizaci&oacute;n</td>
    <td>
        <select disabled="disabled" name="urbanizacion" id="urbanizacion">
          <option value ="-">Selecciona opci&oacute;n...
          </select>
    </td>
    <td>Otra Urbanizaci&oacute;n</td>
    <td><input type="text" name="otra_urbanizacion" id="otra_urbanizacion"></td>
  </tr>
  <tr bgcolor="#999999">
    <td>Av/Calle</td>
    <td><input type="text" name="calle" id="calle"></td>
    <td>Edf./Res/Casa</td>
    <td><input type="text" name="casa_res" id="casa_res"></td>
  </tr>
  <tr bgcolor="#D8D8D8">
    <td>Telf. Casa:</td>
    <td><input type="text" name="tlf_casa" id="tlf_casa"></td>
    <td>Telf. Trabajo</td>
    <td><input type="text" name="tlf_trabajo" id="tlf_trabajo"></td>
  </tr>
  <tr bgcolor="#999999">
    <td>Celular 1</td>
    <td><input type="text" name="celular1" id="celular1"></td>
    <td>Celular 2</td>
    <td><input type="text" name="celular2" id="celular2"></td>
  </tr>
  <tr bgcolor="#D8D8D8">
    <td>Correo 1</td>
    <td><input type="text" name="correo1" id="correo1"></td>
    <td>Correo 2</td>
    <td><input type="text" name="correo2" id="correo2"></td>
  </tr>
</table>
</div>
<div id="tab5">
<table width="700" border="0">
  <tr bgcolor="#999999">
    <td width="227">Inscripci&oacute;n Realizada</td>
    <td width="463"><select name="inscripcion_realizada" id="inscripcion_realizada">
      <option value="" selected>Seleccione</option>
      <option value="1">Si</option>
      <option value="2">No</option>
    </select></td>
  </tr>
  <tr bgcolor="#D8D8D8">
    <td>Fecha</td>
    <td><input type="text" name="fecha_realizada" id="fecha_realizada"></td>
  </tr>
  <tr bgcolor="#999999">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr bgcolor="#D8D8D8">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr bgcolor="#999999">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr bgcolor="#D8D8D8">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr bgcolor="#999999">
    <td>Tipo de Inscripci&oacute;n</td>
    <td><?php
	    $link=Conectarse(); 
	  	$sSQL="SELECT * FROM t_tipo_inscripcion";
        $result=mysql_query($sSQL);
		desconectarse();
        echo "<select name='tipo_inscripcion' id='tipo_inscripcion'>";
        echo "<option value='0'>Seleccione</option>";
          //Generamos el menu desplegable
          while ($row=mysql_fetch_array($result))
          {echo '<option value='.$row["id_tipo_inscripcion"].'>'.$row["tipo_inscripcion"].'</option>';} 
		  echo '</select>';
	  ?></td>
  </tr>
  <tr bgcolor="#D8D8D8">
    <td>Carta de Residencia (Vencimiento)</td>
    <td>
    <input name="fecha_residencia" type="text" id="fecha_residencia" size="30" maxlength="15" readonly/>	
         <img src="jscalendar/img.gif" id="selecresid" />
         <script type='text/javascript'>
            Calendar.setup({
            inputField: 'fecha_residencia',
            ifFormat:   '%Y-%m-%d',
            button:     'selecresid'
            });
         </script>
    </td>
  </tr>
  <tr bgcolor="#999999">
    <td>Observaciones</td>
    <td><textarea name="observasiones_inscripcion" cols="55" rows="4" id="observasiones_inscripcion"></textarea></td>
  </tr>
</table>
</div>
<div id="tab6">
<table width="700" border="0">
  <tr bgcolor="#999999">
    <td width="167">Grupo Sanguineo</td>
    <td colspan="3"><?php
	    $link=Conectarse(); 
	  	$sSQL="SELECT * FROM t_grupo_sanguineo";
        $result=mysql_query($sSQL);
		desconectarse();
        echo "<select name='grupo_sanguineo' id='grupo_sanguineo'>";
        echo "<option value='0'>Seleccione</option>";
          //Generamos el menu desplegable
          while ($row=mysql_fetch_array($result))
          {echo '<option value='.$row["id_grupo_sanguineo"].'>'.$row["grupo_sanguineo"].'</option>';} 
		  echo '</select>';
	  ?>
    
    
    </td>
  </tr>
  <tr bgcolor="#D8D8D8">
    <td>Est&aacute; bajo alg&uacute;n tratamiento m&eacute;dico</td>
    <td colspan="3"><select name="tratamiento_medico" id="tratamiento_medico">
      <option value="0" selected>Selecciones</option>
      <option value="1">Si</option>
      <option value="2">No</option>
    </select></td>
  </tr>
  <tr>
    <td bgcolor="#999999">Especifique</td>
    <td bgcolor="#999999">Tratamiento 1
      <input type="text" name="tratamiento1" id="tratamiento1"></td>
    <td bgcolor="#999999">Tratamiento 2
      <input type="text" name="tratamiento2" id="tratamiento2"></td>
    <td bgcolor="#999999">Tratamiento 3
      <input type="text" name="tratamiento3" id="tratamiento3"></td>
  </tr>
  <tr bgcolor="#D8D8D8">
    <td>Sufre alg&uacute;n padecimiento f&iacute;sico</td>
    <td colspan="3"><select name="padecimiento_fisico" id="padecimiento_fisico">
      <option value="0" selected>Seleccione</option>
      <option value="1">Si</option>
      <option value="2">No</option>
    </select></td>
  </tr>
  <tr bgcolor="#999999">
    <td>Especifique</td>
    <td width="210">Padecimiento 1<input type="text" name="padecimiento1" id="padecimiento1"></td>
    <td width="161">Padecimiento 2<input type="text" name="padecimiento2" id="padecimiento2"></td>
    <td width="144">Padecimiento 3<input type="text" name="padecimiento3" id="padecimiento2"></td>
  </tr>
  <tr bgcolor="#D8D8D8">
    <td>Es al&eacute;rgico a<br></td>
    <td>Al&eacute;rgico 1<input type="text" name="alergico1" id="alergico1"></td>
    <td>Al&eacute;rgico 2<input type="text" name="alergico2" id="alergico2"></td>
    <td>Al&eacute;rgico 3<input type="text" name="alergico3" id="alergico3"></td>
  </tr>
  <tr bgcolor="#999999">
    <td>Posee seguro de HCM y/u otro</td>
    <td><select name="hcm" id="hcm">
      <option value="0" selected>Seleccione</option>
      <option value="1">Si</option>
      <option value="2">No</option>
    </select></td>
    <td>¿Cual?</td>
    <td><input type="text" name="cual_hcm" id="cual_hcm"></td>
  </tr>
  <tr bgcolor="#D8D8D8">
    <td>Est&aacute; afiliado al seguro socia</td>
    <td colspan="3"><select name="ss" id="ss">
      <option value="0" selected>Seleccione</option>
      <option value="1">Si</option>
      <option value="2">No</option>
    </select></td>
  </tr>
  <tr bgcolor="#999999">
    <td>Observaciones</td>
    <td colspan="3"><textarea name="observasiones_medicos" cols="55" rows="4" id="observasiones_medicos"></textarea></td>
  </tr>
</table>
</div>
<div id="tab7">
<table width="700" border="0">
  <tr bgcolor="#999999">
    <td width="344">Nombre</td>
    <td width="340"><input type="text" name="nombre_emerg" id="nombre_emerg"></td>
  </tr>
  <tr bgcolor="#D8D8D8">
    <td>Apellido</td>
    <td><input type="text" name="apellido_emerg" id="apellido_emerg"></td>
  </tr>
  <tr bgcolor="#999999">
    <td>Parentesco</td>
    <td><input type="text" name="parentesco_emerg" id="parentesco_emerg"></td>
  </tr>
  <tr bgcolor="#D8D8D8">
    <td >Ocupaci&oacute;n</td>
    <td><input type="text" name="ocupacion_emerg" id="ocupacion_emerg"></td>
  </tr>
  <tr bgcolor="#999999">
    <td>Telefono Contacto</td>
    <td><input type="text" name="tlf_emerg" id="tlf_emerg"></td>
  </tr>
  <tr bgcolor="#D8D8D8">
    <td>Lugar de Trabajo</td>
    <td><input type="text" name="trabajo_emerg" id="trabajo_emerg"></td>
  </tr>
</table>
</div>
<div>
  <p align="center">
    <input type="submit" name="button" id="button" value="Guardar">
    <input name="seleccion" type="hidden" id="seleccion" value="1"></p>
</div>
</form>
</div>

</body>
</html>