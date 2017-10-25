<?php session_start();?>
<?php 
if(isset($_GET['id_instalacion'])){
	include ('../configuration/conexion.php');
	$mysqli = Conectarse();
	$sql="SELECT * FROM t_instalacion
			WHERE id_instalacion=".$_GET['id_instalacion'];
	$resultado=$mysqli->query($sql);
	$registro= $resultado->fetch_array();
?>
<!DOCTYPE html>
<html>
<head>
<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="../estilos/formularios.css" media="all" />
</head>
<body>
<div class="container">
			<header align="center">
				Editar Instalación
            </header>       
  <div  class="form" style="width:470px;">
    		<form name="form1" method="post" action="case_instalacion.php">
            <input name="id_instalacion" type="hidden" id="id_instalacion" value="<?php print $registro['id_instalacion']?>" >
    			<p class="contact"></p>
    			<table width="397" border="0" cellpadding="1">
    			  <tr>
    			    <th width="140" scope="row"><label for="instalacion">
    			      <div align="right">Instalación</div>
    			    </label></th>
    			    <td width="247"><span class="contact">
    			      <input id="instalacion" name="instalacion" placeholder="" required tabindex="1" type="text" value="<?php print $registro['instalacion']?>">
    			    </span></td>
  			    </tr>
    			<tr>
    			    <th scope="row"><label for="instalacion_corta">
    			      <div align="right">Instalación Abreviada</div>
    			    </label></th>
    			    <td><span class="contact">
    			      <input id="instalacion_corta" name="instalacion_corta" placeholder="" required tabindex="2" type="text" value="<?php print $registro['instalacion_corta']?>">
    			    </span></td>
  			    </tr>
                <tr>
    			    <th scope="row"><label for="abv_instalacion">
    			      <div align="right">Código Instalación </div>
    			    </label></th>
    			    <td><span class="contact">
    			      <input id="abv_instalacion" name="abv_instalacion" placeholder="" required tabindex="3" type="text" value="<?php print $registro['abv_instalacion']?>">
    			    </span></td>
  			    </tr>
    			<tr>
    			    <th scope="row"><div align="right"><span class="contact">
  			      </span></div>    			      <span class="contact">
   			        <label for="direccion">
    			        <div align="right">Dirección</div>
   			        </label>
   			      </span></th>
    			    <td><span class="contact">
    			      <textarea name="direccion" cols="33" required id="direccion" placeholder="" tabindex="4"><?php print $registro['direccion']?></textarea>
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
    			      <input id="director" name="director" placeholder="" required tabindex="5" type="text" value="<?php print $registro['director']?>">
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
				   //header('Content-Type: text/html; charset=ISO-8859-1'); 
				   ?><span class="contact">
                   <select class="select-style" name="coordinador" id="coordinador" tabindex="6">
                       <option value="" selected="selected">Seleccione</option>
                   <?php
					$sSQL="SELECT * FROM t_entrenador WHERE id_tipo_usuario=2 OR id_tipo_usuario=1";
					$result=$mysqli->query($sSQL);
					$i=1;
                    //Generamos el menu desplegable
					while ($fila = $result->fetch_array()) {
					    $nombre_apell="$fila[nombres] $fila[apellidos]";
					   ?>
                        <option value="<?php print $nombre_apell; ?>" <?php if($nombre_apell==$registro['coordinador']){?> selected="selected" <?php }?>><?php print $nombre_apell;?></option>
                      <?php } ?>
                    </select><br><br>
                    
                    
                    
                    </td>
  			    </tr>
    			  <tr>
    			    <th scope="row"><div align="right"><span class="contact">
  			      </span></div>    			      <span class="contact">
   			        <label for="telefono1">
    			        <div align="right">Telefono 1</div>
   			        </label>
   			      </span></th>
    			    <td><span class="contact">
    			      <input type="text" id="telefono1" name="telefono1" required tabindex="7" value="<?php print $registro['telefono1']?>">
    			    </span></td>
  			    </tr>
    			  <tr>
    			    <th scope="row"><label>
    			      <div align="right">Teléfono 2</div>
    			    </label>                    </th>
    			    <td><span class="contact">
    			      <input type="text" id="telefono2" name="telefono2" required tabindex="8" value="<?php print $registro['telefono2']?>">
    			    </span></td>
  			    </tr>
                <tr>
    			    <th scope="row"><label><div align="right">Estatus</div></label></th>
                    <td>
                    <select class='select-style gender' name="estatus" id="estatus">
                        <option value='0'>Seleccione</option>
                    <?php //Generamos el menu desplegable
					for($x=1; $x<=2;$x++){?>
                    	<option value=<?php print $x; if($registro["estatus"]==$x){?> selected="selected" <?php }?>><?php if($x==1){print "Activo";}else{print "Inactivo";}?>
                        </option>
           			<?php } ?>
                    </select>
                    
                   </td>
  			    </tr>
  			  </table> 
                <br>
               <input name="seleccion" type="hidden" id="seleccion" value="2">        
            <p align="center"><input class="buttom" name="submit" id="submit" tabindex="5" value="Guardar" type="submit"> </p>
   </form> 
</div>      
</div>
</body>
<?php	}
////en caso de que la variable no venga del metodo get
else{
	print "NO";
	exit;
}?>
</html>
