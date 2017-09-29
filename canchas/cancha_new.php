<!DOCTYPE html>
<html>
<head>
<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="../estilos/formularios.css" media="all" />
</head>
<body>
<div class="container">
			<header align="center">Nueva Cancha</header>       
  <div  class="form" style="width:470px;">
    		<form name="form1" method="post" action="case_cancha.php">
    			<p class="contact"></p>
    			<table width="397" border="0" cellpadding="1">
    			  <tr>
    			    <th width="140" scope="row"><label for="cancha">
    			      <div align="right">Cancha</label></div></th>
    			    <td width="247"><span class="contact">
    			      <input id="cancha" name="cancha" placeholder="" required tabindex="1" type="text">
    			    </span></td>
  			    </tr>
                <tr>
    			    <th width="140" scope="row"><label for="abv_cancha">
    			      <div align="right">Código Cancha</label></div></th>
    			    <td width="247"><span class="contact">
    			      <input id="abv_cancha" name="abv_cancha" placeholder="" required tabindex="1" type="text">
    			    </span></td>
  			    </tr>
    			  <tr>
    			    <th scope="row"><div align="right"><span class="contact">
  			      </span></div>    			      <span class="contact">
   			        <label for="coordinador">
    			        <div align="right">Instalación</div>
   			        </label>
   			      </span></th>
                   <td>
				   <?php
				   include ('../configuration/conexion.php');
				   conectarse();
				   //header('Content-Type: text/html; charset=ISO-8859-1'); 
				   ?><span class="contact">
                   <select class="select-style" name="id_instalacion" id="id_instalacion" tabindex="6">
                       <option value="" selected="selected">Seleccione</option>
                   <?php
                   $consulta = "SELECT * FROM t_instalacion";
				   $resultado = mysql_query($consulta);
				   while ($fila = mysql_fetch_assoc($resultado)) {
					   ?>
                       <option value=<?php  print $fila['id_instalacion']?>><?php print $fila['instalacion'];?></option>
                  <?php } //cierro el While?>
                  </select>
    			    </span><br><br></td>
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
