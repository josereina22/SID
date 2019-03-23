<?php session_start();

if(isset($_GET['id_deportista'])){
	include ('../configuration/conexion.php');
  header('Content-Type: text/html; charset=UTF-8');
    $mysqli=Conectarse();
	$sql="SELECT * FROM t_deportista
			WHERE t_deportista.id_deportista=".$_GET['id_deportista'];
    $resultado = $mysqli->query($sql);
	$registro = $resultado->fetch_array();
?>
<!DOCTYPE html>
<html>
<head>
<!--meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" /-->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="Pragma" content="no-cache">
<title>SID</title>
<!--link rel="stylesheet" type="text/css" href="../estilos/estilo_dep.css"-->
<link rel="stylesheet" type="text/css" href="../estilos/formularios.css" media="all" />

<script type="text/javascript" src="../jquery/jquery.js"></script>
<style type="text/css">
@import url("../jscalendar/calendar-system.css");.hjh {
	font-size: larger;
	z-index:100;
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
    background: #537DB9;
    padding: 2em;
    /*height: 220px;*/
    position: inherit;
    z-index: 2;
    border-radius: 0 5px 5px 5px;
    /*box-shadow: 0 -2px 3px -2px rgba(0, 0, 0, .5);*/
	width:80%;
}

</style>



<!-- import the calendar script -->
<script type="text/javascript" src="../jscalendar/calendar.js"></script>
<!-- import the language module -->
<script type="text/javascript" src="../jscalendar/lang/calendar-es.js"></script>
<script type="text/javascript" src="../jscalendar/calendar-setup.js"></script>
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
    $("#tabs li:first").attr("id","current"); // Activar la primera pesta�a
    $("#content #tab1").fadeIn(); // Mostrar contenido de primera pesta�a
    
    $('#tabs a').click(function(e) {
        e.preventDefault();
        if ($(this).closest("li").attr("id") == "current"){ //detecci�n para la pesta�a actual
         return;       
        }
        else{             
          $("#content").find("[id^='tab']").hide(); // Ocultar todo el contenido
          $("#tabs li").attr("id",""); //Restablecer de Identificaci�n
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


<div id="content" >
<div  class="form">
    <div id="tab1" >
    
<table width="800" border="0">
  <tr>
    <th><label for="cedula"> <div align="right">C&eacute;dula:</div></label></th>
      <td>
       <input name="id_deportista" type="hidden" id="id_deportista" value="<?php print $registro['id_deportista']?>" >
       <input name="cedula" type="text" id="cedula" value="<?php print $registro['cedula']?>" maxlength="10">
      </td>
      <td rowspan="5"><div align="center"><strong>FOTO</strong></div>
        <img src="<?php print "fotos/".$registro['foto']?>" width="115" height="140" > 
        <br>
        <input name="foto" type="file" id="foto" size="25"/>       
      </td>
  </tr>
  <tr>
      <th><label for="nombres"><div align="right">Nombres:</div></label></th>
      <td><input name="nombres" type="text" id="nombres" value="<?php print $registro['nombres']?>"size="25" maxlength="25">*</td>
    </tr>
    <tr>
      <th><div align="right">Apellidos:</div></th>
      <td><input name="apellidos" type="text" id="apellidos" value="<?php print $registro['apellidos']?>"size="25" maxlength="25">
      *</td>
    </tr>
    <tr>
      <th><div align="right">Sexo:</div></th>
      <td>
      <?php
	  	
	    $link=Conectarse(); 
	  	$sSQL="SELECT * FROM t_sexo";
        $result=$mysqli->query($sSQL);
		desconectarse();
		$i=1;
	  ?>
        <select class='select-style gender' name="sexo" id="sexo">
        <option value="0">Seleccione</option>
         <?php //Generamos el menu desplegable
          while ($row=$result->fetch_array())
          {?>
          	<option value=<?php print $row["id_sexo"]; if($row["id_sexo"]==$registro["id_sexo"]){?> selected="selected" <?php }?>><?php print $row["sexo"];?></option>
           <?php } ?>
		  </select>*<br>
      <br></td>
    </tr>
    <tr>
      <th><div align="right">Fecha de Nacimiento:</div></th>
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

<table width="800" border="0">
  <tr>
    <th><div align="right">Municipio</div></th>
    <td>
    <?php
	    $link=Conectarse(); 
	  	$sSQL="SELECT * FROM t_municipio";
        $result=$mysqli->query($sSQL);
		desconectarse();
	?>
        <select class='select-style gender' name="municipio" id="municipio" onChange="cargaContenido(this.id)">
        <option value='0'>Seleccione</option>
   <?php //Generamos el menu desplegable
          while ($row=$result->fetch_array())
		  {?>
          	<option value=<?php print $row["id_municipio"]; if($row["id_municipio"]==$registro["id_municipio"]){?> selected="selected" <?php }?>><?php print $row["municipio"];?></option>
           <?php } ?>
	  </select>
    </td>
    <th><div align="right">Otro Municipio</div></th>
    <td colspan="2"><input type="text" name="otro_municipio" id="otro_municipio" value="<?php print $registro['otro_municipio']?>"></td>
  </tr>
  <tr>
    <th><div align="right">Urbanizaci&oacute;n</div></th>
    <td>
    <!--
        <select disabled="disabled" name="urbanizacion" id="urbanizacion">
          <option value ="-">Selecciona opci&oacute;n...</option>
          </select>  -->
          
         <?php
	    $link=Conectarse(); 
	  	$sSQL="SELECT * FROM t_urbanizacion";
        $result=$mysqli->query($sSQL);
		desconectarse();
	?>
        <select class='select-style gender' name='urbanizacion' id='urbanizacion' onChange='cargaContenido(this.id)'>
        <option value='0'>Seleccione</option>
   <?php //Generamos el menu desplegable
          while ($row=$result->fetch_array())
		  {?>
          	<option value=<?php print $row["id_urbanizacion"]; if($row["id_urbanizacion"]==$registro["id_urbanizacion"]){?> selected="selected" <?php }?>><?php print $row["urbanizacion"];?></option>
           <?php } ?>
	  </select>
    </td>
    <th><div align="right">Otra Urbanizaci&oacute;n</div></th>
    <td colspan="2"><input type="text" name="otra_urbanizacion" id="otra_urbanizacion" value="<?php print $registro['otra_urbanizacion']?>"></td>
  </tr>
  <tr>
    <th><div align="right">Av/Calle</div></th>
    <td><input type="text" name="calle" id="calle" value="<?php print $registro['av_calle']?>"></td>
    <th><div align="right">Edf./Res/Casa</div></th>
    <td width="65"><input type="text" name="casa_res" id="casa_res" value="<?php print $registro['edf_res_casa']?>" style="width:130px"></td>
    <td width="66"><div align="right"><strong>Nro</strong>
      <input name="nro_cas_res" type="text" id="nro_cas_res" value="<?php print $registro['nro_cas_res']?>" style="width:50px"></div></td>
  </tr>
  <tr>
    <th><div align="right">Telf. Casa:</div></th>
    <td><input type="text" name="tlf_casa" id="tlf_casa" value="<?php print $registro['tlf_casa']?>"></td>
    <th><div align="right">Telf. Trabajo</div></th>
    <td colspan="2"><input type="text" name="tlf_trabajo" id="tlf_trabajo" value="<?php print $registro['tlf_trabajo']?>"></td>
  </tr>
  <tr>
    <th><div align="right">Celular 1</div></th>
    <td><input type="text" name="celular1" id="celular1" value="<?php print $registro['celular1']?>"></td>
    <th><div align="right">Celular 2</div></th>
    <td colspan="2"><input type="text" name="celular2" id="celular2" value="<?php print $registro['celular2']?>"></td>
  </tr>
  <tr>
    <th><div align="right">Correo 1</div></th>
    <td><input type="text" name="correo1" id="correo1" value="<?php print $registro['correo1']?>"></td>
    <th><div align="right">Correo 2</div></th>
    <td colspan="2"><input type="text" name="correo2" id="correo2" value="<?php print $registro['correo2']?>"></td>
  </tr>
</table>
        
</div>
    <div id="tab3">

<table width="800" border="0">
  <tr>
    <th><div align="right">Ocupaci&oacute;n</div></th>
    <td>
    <?php
	    $link=Conectarse(); 
	  	$sSQL="SELECT * FROM t_ocupacion";
        $result=$mysqli->query($sSQL);
		desconectarse();
	?>
        <select class='select-style gender' name='ocupacion' id='ocupacion'>
        <option value='0'>Seleccione</option>
   <?php //Generamos el menu desplegable
          while ($row=$result->fetch_array())
		  {?>
          	<option value=<?php print $row["id_ocupacion"]; if($row["id_ocupacion"]==$registro["id_ocupacion"]){?> selected="selected" <?php }?>><?php print $row["ocupacion"];?></option>
           <?php } ?>
	  </select>  
    </td>
    <th><div align="right">Otra ocupaci&oacute;n </div></th>
    </td>
    <td>
    <input type="text" name="otra_ocupacion" id="otra_ocupacion" value="<?php print $registro['otra_ocupacion']?>"> </td>
  </tr>
  <tr>
    <th><div align="right">Grado de Instrucci&oacute;n</div></th>
    <td>
	<?php
	    $link=Conectarse(); 
	  	$sSQL="SELECT * FROM t_grado_instruccion";
        $result=$mysqli->query($sSQL);
		desconectarse();
	?>
        <select class='select-style gender' name='grado_instruccion' id='grado_instruccion'>
        <option value='0'>Seleccione</option>
   <?php //Generamos el menu desplegable
          while ($row=$result->fetch_array())
		  {?>
          	<option value=<?php print $row["id_grado_instruccion"]; if($row["id_grado_instruccion"]==$registro["id_grado_instruccion"]){?> selected="selected" <?php }?>><?php print $row["grado_instruccion"];?></option>
           <?php } ?>
	  </select></td>
    <th><div align="right">Empresa donde trabaja</div></th>
    </td>
    <td><input type="text" name="emp_trabaja" id="emp_trabaja" value="<?php print $registro['emp_trabaja']?>"></td>
  </tr>
  <tr>
    <th><div align="right"><span id="sub1">Instituci&oacute;n donde estudia</span></div></th>
    <td>
	<?php
	    $link=Conectarse(); 
	  	$sSQL="SELECT * FROM t_institucion";
        $result=$mysqli->query($sSQL);
		desconectarse();
	?>
        <select class='select-style gender' name='institucion' id='institucion'>
        <option value='0'>Seleccione</option>
   <?php //Generamos el menu desplegable
          while ($row=$result->fetch_array())
		  {?>
          	<option value=<?php print $row["id_institucion"]; if($row["id_institucion"]==$registro["id_institucion"]){?> selected="selected" <?php }?>><?php print $row["institucion"];?></option>
           <?php } ?>
	  </select>
    </td>
  	<th><div align="right">Otra Instituci&oacute;n</div></th>
    <td> <input type="text" name="otra_institucion" id="otra_institucion" value="<?php print $registro['otra_institucion']?>"></td>
  </tr>
  <tr>
    <th><div align="right">Grado o A&ntilde;o que Cursa</div></th>
    <td colspan="3">
    <?php
	    $link=Conectarse(); 
	  	$sSQL="SELECT * FROM t_grado";
        $result=$mysqli->query($sSQL);
		desconectarse();
	?>
        <select class='select-style gender' name='grado' id='grado'>
        <option value='0'>Seleccione</option>
   <?php //Generamos el menu desplegable
          while ($row = $result->fetch_array())
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
    <td colspan="2" align="center"><h2>Solo en Caso de menores de 18 a&ntilde;os</h2></td>
  </tr>
  <tr>
    <th><div align="right">Nro. Cedula</div></th>
    <td><input type="text" name="cedula_repres" id="cedula_repres" value="<?php print $registro['cedula_representante']?>">* Este campo Necesario</td>
  </tr>
  <?php
   $link=Conectarse(); 
  	$sqlr="SELECT * FROM t_representante
			WHERE id_deportista=".$_GET['id_deportista'];
	$resultador=$mysqli->query($sqlr);
	$registror= $resultador->fetch_array();
	desconectarse();
  ?>
  <tr>
    <th><div align="right">Nombres</div></th>
    <td><input type="text" name="nombre_repres" id="nombre_repres" value="<?php print $registror['nombre_representante']?>"></td>
  </tr>
  <tr>
    <th><div align="right">Apellidos</div></th>
    <td><input type="text" name="apellido_repres" id="apellido_repres" value="<?php print $registror['apellido_representante']?>"></td>
  </tr>
  <tr>
    <th><div align="right">Parentesco</div></th>
    <td><input type="text" name="parentesco" id="parentesco" value="<?php print $registror['parentesco']?>"></td>
  </tr>
  <tr>
    <th><div align="right">Ocupaci&oacute;n</div></th>
    <td>
	<?php
	    $link=Conectarse(); 
	  	$sSQL="SELECT * FROM t_ocupacion";
        $result=$mysqli->query($sSQL);
		desconectarse();
	?>
        <select class='select-style gender' name='ocupacion_repres' id='ocupacion_repres'>
        <option value='0'>Seleccione</option>
   <?php //Generamos el menu desplegable
          while ($row=$result->fetch_array())
		  {?>
          	<option value=<?php print $row["id_ocupacion"]; if($row["id_ocupacion"]==$registror["id_ocupacion"]){?> selected="selected" <?php }?>><?php print $row["ocupacion"];?></option>
           <?php } ?>
	  </select>
    </td>
  </tr>
  <tr>
    <th><div align="right">Grado de Instrucci&oacute;n</div></th>
    <td>
	<?php
	    $link=Conectarse(); 
	  	$sSQL="SELECT * FROM t_grado_instruccion";
        $result=$mysqli->query($sSQL);
		desconectarse();
	?>
        <select class='select-style gender' name='grado_instruccion_repres' id='grado_instruccion_repres'>
        <option value='0'>Seleccione</option>
   <?php //Generamos el menu desplegable
          while ($row = $result->fetch_array())
		  {?>
          	<option value=<?php print $row["id_grado_instruccion"]; if($row["id_grado_instruccion"]==$registror["id_grado_instruccion"]){?> selected="selected" <?php }?>><?php print $row["grado_instruccion"];?></option>
           <?php } ?>
	  </select>
	</td>
  </tr>
  <tr>
    <th><div align="right">Empresa donde Trabaja</div></th>
    <td><input type="text" name="empresa_repres" id="empresa_repres" value="<?php print $registror['empresa_trabaja']?>"></td>
  </tr>
</table>
        
</div>
    <div id="tab5">
  <table width="800" border="0">
    <tr>
      <th><div align="right">Grupo Sanguineo</div></th>
      <td colspan="3">
	  <?php
	    $link=Conectarse(); 
	  	$sSQL="SELECT * FROM t_grupo_sanguineo";
        $result=$mysqli->query($sSQL);
		desconectarse();
	?>
        <select class='select-style gender' name='grupo_sanguineo' id='grupo_sanguineo'>
        <option value='0'>Seleccione</option>
   <?php //Generamos el menu desplegable
          while ($row = $result->fetch_array())
		  {?>
          	<option value=<?php print $row["id_grupo_sanguineo"]; if($row["id_grupo_sanguineo"]==$registro["id_grupo_sanguineo"]){?> selected="selected" <?php }?>><?php print $row["grupo_sanguineo"];?></option>
           <?php } ?>
	  </select>
      </td>
    </tr>
    <tr>
      <th><div align="right">Est&aacute; bajo alg&uacute;n tratamiento m&eacute;dico</div></th>
      <td colspan="3">
      <select class='select-style gender' name="tratamiento_medico" id="tratamiento_medico">
        <option value="0" selected>Selecciones</option>
        <option value="1" <?php if($registro["tratamiento_medico"]==1){?> selected="selected" <?php }?> >Si</option>
        <option value="2" <?php if($registro["tratamiento_medico"]==2){?> selected="selected" <?php }?> >No</option>
      </select>
      </td>
    </tr>
    <tr>
      <th><div align="right">Especifique</div></th>
      <td><div align="center"><strong>Tratamiento 1
        </strong>
        <input type="text" name="tratamiento1" id="tratamiento1" value="<?php print $registro['tratamiento1']?>">
      </div></td>
      <td><div align="center"><strong>Tratamiento 2
        </strong>        
        <input type="text" name="tratamiento2" id="tratamiento2" value="<?php print $registro['tratamiento2']?>">
      </div></td>
      <td><div align="center"><strong>Tratamiento 3
        </strong>
        <input type="text" name="tratamiento3" id="tratamiento3" value="<?php print $registro['tratamiento3']?>">
      </div></td>
    </tr>
    <tr>
      <th><div align="right">Sufre alg&uacute;n padecimiento f&iacute;sico</div></th>
      <td colspan="3">
      <select class='select-style gender' name="padecimiento_fisico" id="padecimiento_fisico">
        <option value="0" selected>Seleccione</option>
        <option value="1" <?php if($registro["pad_fisico"]==1){?> selected="selected" <?php }?> >Si</option>
        <option value="2" <?php if($registro["pad_fisico"]==2){?> selected="selected" <?php }?> >No</option>
      </select>
      </td>
    </tr>
    <tr>
      <th><div align="right">Especifique</div></th>
      <td><div align="center"><strong>Padecimiento 1        
        </strong>
        <input type="text" name="padecimiento1" id="padecimiento1" value="<?php print $registro['padecimiento1']?>">
      </div></td>
      <td><div align="center"><strong>Padecimiento 2        
        </strong>
        <input type="text" name="padecimiento2" id="padecimiento2" value="<?php print $registro['padecimiento2']?>">
      </div></td>
      <td><div align="center"><strong>Padecimiento 3        
        </strong>
        <input type="text" name="padecimiento3" id="padecimiento3" value="<?php print $registro['padecimiento3']?>">
      </div></td>
    </tr>
    <tr>
      <th><div align="right">Eres Al&eacute;rgico</div></th>
      <td colspan="3">
      <select class='select-style gender' name="alergico" id="alergico">
        <option value="0" selected>Seleccione</option>
        <option value="1" <?php if($registro["alergico"]==1){?> selected="selected" <?php }?> >Si</option>
        <option value="2" <?php if($registro["alergico"]==2){?> selected="selected" <?php }?> >No</option>
      </select>
      </td>
    </tr>
    <tr>
      <th><div align="right">Especifique<br>
      </div></th>
      <td><div align="center"><strong>Al&eacute;rgico  1</strong>
        <input type="text" name="alergico1" id="alergico1" value="<?php print $registro['alergico1']?>">
      </div></td>
      <td><div align="center"><strong>Al&eacute;rgico 2</strong>        
        <input type="text" name="alergico2" id="alergico2" value="<?php print $registro['alergico2']?>">
      </div></td>
      <td><div align="center"><strong>Al&eacute;rgico 3</strong>        
        <input type="text" name="alergico3" id="alergico3" value="<?php print $registro['alergico3']?>">
      </div></td>
    </tr>
    <tr>
      <th><div align="right">Posee seguro de HCM y/u otro</div></th>
      <td>
      <select class='select-style gender' name="hcm" id="hcm">
        <option value="0" selected>Seleccione</option>
        <option value="1" <?php if($registro["hcm"]==1){?> selected="selected" <?php }?> >Si</option>
        <option value="2" <?php if($registro["hcm"]==2){?> selected="selected" <?php }?> >No</option>
      </select>
      </td>
      <td><div align="right"><strong>Cual?</strong></div></td>
      <td><input type="text" name="cual_hcm" id="cual_hcm" value="<?php print $registro['cual_hcm']?>"></td>
    </tr>
    <tr>
      <th><div align="right">Est&aacute; afiliado al seguro socia</div></th>
      <td>
      <select class='select-style gender' name="ss" id="ss">
        <option value="0" selected>Seleccione</option>
        <option value="1" <?php if($registro["ss"]==1){?> selected="selected" <?php }?> >Si</option>
        <option value="2" <?php if($registro["ss"]==2){?> selected="selected" <?php }?> >No</option>
      </select>
      </td>
      <th><div align="right">Fecha de Vencimiento Cosntancia M&eacute;dica</div></th>
      <td><input name="vence_cm" type="text" id="vence_cm" size="25" maxlength="15" readonly/ style="width:100px" value="<?php print $registro['vence_cm']?>" >	
         <img src="../jscalendar/img.gif" id="selecv" />
         <script type='text/javascript'>
            Calendar.setup({
            inputField: 'vence_cm',
            ifFormat:   '%Y-%m-%d',
            button:     'selecv'
            });
         </script></td>
    </tr>
    <tr>
      <th><div align="right">Observaciones</div></th>
      <td colspan="3">
        <input type="text" name="obs_medicos" id="obs_medicos" value="<?php print $registro['obs_medicos'];?>" /></td>
      </td>
    </tr>
  </table>


</div>
    <div id="tab6">
    
<table width="700" border="0">
  <tr>
    <th><div align="right"><strong>Nombres</strong></div></th>
    <td><input type="text" name="nombre_emerg" id="nombre_emerg" value="<?php print $registro['nombre_emerg']?>"></td>
  </tr>
  <tr>
    <th><div align="right"><strong>Apellidos</strong></div></th>
    <td><input type="text" name="apellido_emerg" id="apellido_emerg" value="<?php print $registro['apellido_emerg']?>"></td>
  </tr>
  <tr>
    <th><div align="right"><strong>Parentesco</strong></div></th>
    <td><input type="text" name="parentesco_emerg" id="parentesco_emerg" value="<?php print $registro['parentesco_emerg']?>"></td>
  </tr>
  <tr>
    <th ><div align="right"><strong>Ocupaci&oacute;n</strong></div></th>
    <td><input type="text" name="ocupacion_emerg" id="ocupacion_emerg" value="<?php print $registro['ocupacion_emerg']?>"></td>
  </tr>
  <tr>
    <th><div align="right"><strong>Telefono Contacto</strong></div></th>
    <td><input type="text" name="tlf_emerg" id="tlf_emerg" value="<?php print $registro['tlf_emerg']?>"></td>
  </tr>
  <tr>
    <th><div align="right"><strong>Lugar de Trabajo</strong></div></th>
    <td><input type="text" name="trabajo_emerg" id="trabajo_emerg" value="<?php print $registro['trabajo_emerg']?>"></td>
  </tr>
</table>
</div> <!-- Div tab 6 -->

<div>
<p align="center"><input class="buttom" name="submit" id="submit" tabindex="5" value="Guardar" type="submit"> </p>  
    <input name="seleccion" type="hidden" id="seleccion" value="1">
</div>
</div> <!-- Div clase form-->
</div> <!--Div del content-->
</form>
<?php	}
////en caso de que la variable no venga del metodo get
else{
	print "NO";
	exit;
}?>
</body>

</html>
