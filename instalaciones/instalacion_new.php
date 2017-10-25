<!DOCTYPE html>
<html>
<head>
<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <link rel="stylesheet" type="text/css" href="../estilos/formularios.css" media="all" />
</head>
<body>
<div class="container">
			<header align="center">Nueva Instalaci&oacute;n</header>       
  <div  class="form" style="width:470px;">
    		<form name="form1" method="post" action="case_instalacion.php">
    			<p class="contact"></p>
    			<table width="397" border="0" cellpadding="1">
    			  <tr>
    			    <th width="140" scope="row"><label for="instalacion">
    			      <div align="right">Instalaci&oacute;n</div>
    			    </label></th>
    			    <td width="247"><span class="contact">
    			      <input id="instalacion" name="instalacion" placeholder="" required tabindex="1" type="text">
    			    </span></td>
  			    </tr>
    			<tr>
    			    <th scope="row"><label for="instalacion_corta">
    			      <div align="right">Instalaci&oacute;n Abreviada</div>
    			    </label></th>
    			    <td><span class="contact">
    			      <input id="instalacion_corta" name="instalacion_corta" placeholder="" required tabindex="2" type="text">
    			    </span></td>
  			    </tr>
                <tr>
    			    <th scope="row"><label for="abv_instalacion">
    			      <div align="right">c&oacute;digo Instalaci&oacute;n </div>
    			    </label></th>
    			    <td><span class="contact">
    			      <input id="abv_instalacion" name="abv_instalacion" placeholder="" required tabindex="3" type="text">
    			    </span></td>
  			    </tr>
    			<tr>
    			    <th scope="row"><div align="right"><span class="contact">
  			      </span></div>    			      <span class="contact">
   			        <label for="direccion">
    			        <div align="right">Direcci&oacute;n</div>
   			        </label>
   			      </span></th>
    			    <td><span class="contact">
    			      <textarea name="direccion" cols="33" required id="direccion" placeholder="" tabindex="4"></textarea>
    			    </span></td>
  			    </tr>
    			<tr>
    			    <th scope="row"><div align="right"><span class="contact">
  			      </span></div>    			      <span class="contact">
   			        <label for="director">
    			        <div align="right">Director</div>
   			        </label>
   			      </span></th>
    			    <td><span class="contact">
    			      <input id="director" name="director" placeholder="" required tabindex="5" type="text">
    			    </span></td>
  			    </tr>
    			  <tr>
    			    <th scope="row"><div align="right"><span class="contact">
  			      </span></div>    			      <span class="contact">
   			        <label for="coordinador">
    			        <div align="right">Coordinador</div>
   			        </label>
   			      </span></th>
                   <td>
				   <?php
				   include ('../configuration/conexion.php');
				   $mysqli = Conectarse();
				   //header('Content-Type: text/html; charset=ISO-8859-1'); 
				   ?><span class="contact">
                   <select class="select-style" name="coordinador" id="coordinador" tabindex="6">
                       <option value="" selected="selected">Seleccione</option>
                   <?php
                   $consulta = "SELECT * FROM t_entrenador WHERE id_tipo_usuario=2";
				   $resultado = $mysqli->query($consulta);
				   while ($fila = $resultado->fetch_array()) {
					    $nombre_apell="'$fila[nombres] $fila[apellidos]'";
					   ?>
                       <option value=<?php  print $nombre_apell?>><?php print $fila['nombres']." ".$fila['apellidos']?></option>
                  <?php } //cierro el While?>
                  </select>
    			    </span><br><br></td>
  			    </tr>
    			  <tr>
    			    <th scope="row"><div align="right"><span class="contact">
  			      </span></div>    			      <span class="contact">
   			        <label for="telefono1">
    			        <div align="right">Telefono 1</div>
   			        </label>
   			      </span></th>
    			    <td><span class="contact">
    			      <input type="text" id="telefono1" name="telefono1" required tabindex="7">
    			    </span></td>
  			    </tr>
    			  <tr>
    			    <th scope="row"><label>
    			      <div align="right">Tel&eacute;fono 2</div>
    			    </label>                    </th>
    			    <td><span class="contact">
    			      <input type="text" id="telefono2" name="telefono2" required tabindex="8">
    			    </span></td>
  			    </tr>
  			  </table> 
                <br>
               <input name="seleccion" type="hidden" id="seleccion" value="1">        
            <p align="center"><input class="buttom" name="submit" id="submit" tabindex="5" value="Guardar" type="submit"> </p>
   </form> 
</div>      
</div>

</body>
</html>
