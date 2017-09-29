<?php session_start();?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>SID</title>
<link rel="stylesheet" type="text/css" href="../estilos/estilo_dep.css">
<script type="text/javascript" src="../jquery/jquery.js"></script>
<style type="text/css">
@import url("../jscalendar/calendar-system.css");.hjh {
	font-size: larger;
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
<!--////////////////para auto llenar formulario////////////////--///////////////-->
	<script type="text/javascript" src="../deportista/ajax.js"></script>
	<script type="text/javascript">

	var ajax = new sack();
	var currentcedula=false;
	function getDeportistaData()
	{
		var cedula = document.getElementById('cedula').value.replace(/[^0-9]/g,'');
		if(cedula.length<=9 && cedula!=currentcedula){
			currentcedula = cedula
			ajax.requestFile = 'getDeportista.php?getcedula='+cedula;	// Specifying which file to get
			ajax.onCompletion = showDeportistaData;	// Specify function that will be executed after file has been found
			ajax.runAJAX();		// Execute AJAX function			
		}
		
	}
	
	function showDeportistaData()
	{
		var formObj = document.forms['form_dp'];	
		eval(ajax.response);
	}
	
	
	function initFormEvents()
	{
		document.getElementById('cedula').onblur = getDeportistaData;
		document.getElementById('cedula').focus();
	}
	
	
	window.onload = initFormEvents;
	</script>
<!--//////////////////////////////////////////////////--///////////////////////////-->


</head>
<body>


<form name="form_dp" action="case_deportista.php" method="POST"  enctype="multipart/form-data">
<ul id="menu">
<li><a href="#">Datos B&aacute;sicos</a>
	<ul>

<table width="700" border="0">
  <tr>
    <td align="right"><label for="cedula">Cédula:</label></td>
      <td><input name="cedula" type="text" id="cedula" maxlength="10">
        *</td>
      <td rowspan="5"><div align="center"><strong>FOTO</strong></div>
      <img  name="fotos" id="fotos" >
	  <input name="foto" type="file" id="foto" size="25" />      

      </td>
  </tr>
    <tr>
      <td align="right"><label for="nombres">Nombres:</label></td>
      <td><input name="nombres" type="text" id="nombres" size="25" maxlength="25">
        *</td>
    </tr>
    <tr>
      <td align="right">Apellidos:</td>
      <td><input name="apellidos" type="text" id="apellidos" size="25" maxlength="25">
        *</td>
    </tr>
    <tr>
      <td align="right">Sexo:</td>
      <td>
      <?php
	  	include ('../configuration/conexion.php');
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
      <td align="right">Fecha de Nacimiento:</td>
      <td>
           <input name="fecha_nac" type="text" id="fecha_nac" size="25" maxlength="15" readonly/>	
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
	
	</ul>
</li>


<li><a href="#">Direcci&oacute;n de Residencia</a>
	<ul>
		
<table width="700" border="0">
  <tr>
    <td>Municipio</td>
    <td>
    <?php
	    $link=Conectarse(); 
	  	$sSQL="SELECT * FROM t_municipio";
        $result=mysql_query($sSQL);
		desconectarse();
        echo "<select name='municipio' id='municipio' onChange='cargaContenido(this.id)'>";
        echo "<option value='0'>Seleccione</option>";
          //Generamos el menu desplegable
          while ($row=mysql_fetch_array($result))
          {echo '<option value='.$row["id_municipio"].'>'.$row["municipio"].'</option>';} 
		  echo '</select>';
	  ?>
    </td>
    <td>Otro Municipio</td>
    <td><input type="text" name="otro_municipio" id="otro_municipio"></td>
  </tr>
  <tr>
    <td>Urbanizaci&oacute;n</td>
    <td>
    <!--
        <select disabled="disabled" name="urbanizacion" id="urbanizacion">
          <option value ="-">Selecciona opci&oacute;n...</option>
          </select>  -->
          
          <?php
	    $link=Conectarse(); 
	  	$sSQL="SELECT * FROM t_urbanizacion";
        $result=mysql_query($sSQL);
		desconectarse();
        echo "<select name='urbanizacion' id='urbanizacion'>";
        echo "<option value='0'>Seleccione</option>";
          //Generamos el menu desplegable
          while ($row=mysql_fetch_array($result))
          {echo '<option value='.$row["id_urbanizacion"].'>'.$row["urbanizacion"].'</option>';} 
		  echo '</select>';
	  ?>
    </td>
    <td>Otra Urbanizaci&oacute;n</td>
    <td><input type="text" name="otra_urbanizacion" id="otra_urbanizacion"></td>
  </tr>
  <tr>
    <td>Av/Calle</td>
    <td><input type="text" name="calle" id="calle"></td>
    <td>Edf./Res/Casa</td>
    <td><input type="text" name="casa_res" id="casa_res"></td>
  </tr>
  <tr>
    <td>Telf. Casa:</td>
    <td><input type="text" name="tlf_casa" id="tlf_casa"></td>
    <td>Telf. Trabajo</td>
    <td><input type="text" name="tlf_trabajo" id="tlf_trabajo"></td>
  </tr>
  <tr>
    <td>Celular 1</td>
    <td><input type="text" name="celular1" id="celular1"></td>
    <td>Celular 2</td>
    <td><input type="text" name="celular2" id="celular2"></td>
  </tr>
  <tr>
    <td>Correo 1</td>
    <td><input type="text" name="correo1" id="correo1"></td>
    <td>Correo 2</td>
    <td><input type="text" name="correo2" id="correo2"></td>
  </tr>
</table>
        
	</ul>
</li>



<li><a href="#">Ocupaci&oacute;n</a>
	<ul>
		

<table width="700" border="0">
  <tr>
    <td>Ocupaci&oacute;n</td>
    <td>
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
    <td>
       <div align="right">Otra ocupaci&oacute;n </div></td>
    </td>
    <td>
    <input type="text" name="otra_ocupacion" id="otra_ocupacion"> </td>
  </tr>
  <tr>
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
    <td><div align="right">Empresa donde trabaja</div></td>
    </td>
    <td><input type="text" name="emp_trabaja" id="emp_trabaja"></td>
  </tr>
  <tr>
    <td><span id="sub1">Instituci&oacute;n donde estudia</span></td>
    <td colspan="3"><?php
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
  <tr>
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
	</ul>
</li>

<li><a href="#">Datos del Representante</a>
	<ul>
		
<table width="700" border="0">
  <tr>
    <td colspan="2" align="center">Solo en Caso de menores de 18 a&ntilde;os</td>
  </tr>
  <tr>
    <td>Nro. Cedula</td>
    <td><input type="text" name="cedula_repres" id="cedula_repres"></td>
  </tr>
  <tr>
    <td>Nombres</td>
    <td><input type="text" name="nombre_repres" id="nombre_repres"></td>
  </tr>
  <tr>
    <td>Apellidos</td>
    <td><input type="text" name="apellido_repres" id="apellido_repres"></td>
  </tr>
  <tr>
    <td>Parentesco</td>
    <td><input type="text" name="parentesco" id="parentesco"></td>
  </tr>
  <tr>
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
  <tr>
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
  <tr>
    <td>Empresa donde Trabaja</td>
    <td><input type="text" name="empresa_repres" id="empresa_repres"></td>
  </tr>
</table>
        
	</ul>
</li>

<li><a href="#">Datos Medicos</a>
   <ul>
  <table width="700" border="0">
    <tr>
      <td>Grupo Sanguineo</td>
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
    <tr>
      <td>Est&aacute; bajo alg&uacute;n tratamiento m&eacute;dico</td>
      <td colspan="3"><select name="tratamiento_medico" id="tratamiento_medico">
        <option value="0" selected>Selecciones</option>
        <option value="1">Si</option>
        <option value="2">No</option>
      </select></td>
    </tr>
    <tr>
      <td>Especifique</td>
      <td>Tratamiento 1
        <input type="text" name="tratamiento1" id="tratamiento1"></td>
      <td>Tratamiento 2
        <input type="text" name="tratamiento2" id="tratamiento2"></td>
      <td>Tratamiento 3
        <input type="text" name="tratamiento3" id="tratamiento3"></td>
    </tr>
    <tr>
      <td>Sufre alg&uacute;n padecimiento f&iacute;sico</td>
      <td colspan="3"><select name="padecimiento_fisico" id="padecimiento_fisico">
        <option value="0" selected>Seleccione</option>
        <option value="1">Si</option>
        <option value="2">No</option>
      </select></td>
    </tr>
    <tr>
      <td>Especifique</td>
      <td>Padecimiento 1        <input type="text" name="padecimiento1" id="padecimiento1"></td>
      <td>Padecimiento 2        <input type="text" name="padecimiento2" id="padecimiento2"></td>
      <td>Padecimiento 3        <input type="text" name="padecimiento3" id="padecimiento2"></td>
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
      <td>Al&eacute;rgico  1<input type="text" name="alergico1" id="alergico1"></td>
      <td>Al&eacute;rgico 2<input type="text" name="alergico2" id="alergico2"></td>
      <td>Al&eacute;rgico 3<input type="text" name="alergico3" id="alergico3"></td>
    </tr>
    <tr>
      <td>Posee seguro de HCM y/u otro</td>
      <td><select name="hcm" id="hcm">
        <option value="0" selected>Seleccione</option>
        <option value="1">Si</option>
        <option value="2">No</option>
      </select></td>
      <td>¿Cual?</td>
      <td><input type="text" name="cual_hcm" id="cual_hcm"></td>
    </tr>
    <tr>
      <td>Est&aacute; afiliado al seguro socia</td>
      <td colspan="3"><select name="ss" id="ss">
        <option value="0" selected>Seleccione</option>
        <option value="1">Si</option>
        <option value="2">No</option>
      </select></td>
    </tr>
    <tr>
      <td>Observaciones</td>
      <td colspan="3"><textarea name="observasiones_medicos" cols="55" rows="4" id="observasiones_medicos"></textarea></td>
    </tr>
  </table>
  </ul>
  </li>
<li><a href="#">Emergencia</a>
	<ul>

<table width="700" border="0">
  <tr>
    <td>Nombres</td>
    <td><input type="text" name="nombre_emerg" id="nombre_emerg"></td>
  </tr>
  <tr>
    <td>Apellidos</td>
    <td><input type="text" name="apellido_emerg" id="apellido_emerg"></td>
  </tr>
  <tr>
    <td>Parentesco</td>
    <td><input type="text" name="parentesco_emerg" id="parentesco_emerg"></td>
  </tr>
  <tr>
    <td >Ocupaci&oacute;n</td>
    <td><input type="text" name="ocupacion_emerg" id="ocupacion_emerg"></td>
  </tr>
  <tr>
    <td>Telefono Contacto</td>
    <td><input type="text" name="tlf_emerg" id="tlf_emerg"></td>
  </tr>
  <tr>
    <td>Lugar de Trabajo</td>
    <td><input type="text" name="trabajo_emerg" id="trabajo_emerg"></td>
  </tr>
</table>
  	</ul>
</li>
</ul>

<div>
  <p align="center">
    <input type="submit" name="button" id="button" value="Guardar">
    <input name="seleccion" type="hidden" id="seleccion" value="1"></p>
</div>
</form>
</body>

</html>
