<?php session_start();?>
<?php 
if(isset($_GET['id_cancha'])){
	include ('../configuration/conexion.php');
	Conectarse();
	$sql="SELECT * FROM t_cancha
			WHERE id_cancha=".$_GET['id_cancha'];
	$resultado=mysql_query($sql);
	$registro= mysql_fetch_array($resultado);
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
    		<form name="form1" method="post" action="case_cancha.php">
            <input name="id_cancha" type="hidden" id="id_cancha" value="<?php print $registro['id_cancha']?>" >
    			<p class="contact"></p>
    			<table width="397" border="0" cellpadding="1">
    			  <tr>
    			    <th width="140" scope="row"><label for="cancha">
    			      <div align="right">Cancha</div>
    			    </label></th>
    			    <td width="247"><span class="contact">
    			      <input id="cancha" name="cancha" placeholder="" required tabindex="1" type="text" value="<?php print $registro['cancha']?>">
    			    </span></td>
  			    </tr>
    			<tr>
    			    <th scope="row"><label for="abv_cancha">
    			      <div align="right">Código Cancha</div>
    			    </label></th>
    			    <td><span class="contact">
    			      <input id="abv_cancha" name="abv_cancha" placeholder="" required tabindex="2" type="text" value="<?php print $registro['abv_cancha']?>">
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
				   //header('Content-Type: text/html; charset=ISO-8859-1'); 
				   ?><span class="contact">
                   <select class="select-style" name="id_instalacion" id="id_instalacion	" tabindex="6">
                       <option value="" selected="selected">Seleccione</option>
                   <?php
					$sSQL="SELECT * FROM t_instalacion";
					$result=mysql_query($sSQL);
					$i=1;
                    //Generamos el menu desplegable
					while ($fila = mysql_fetch_assoc($result)) {
					   ?>
                        <option value="<?php print $fila['id_instalacion']; ?>" <?php if($fila['id_instalacion']==$registro['id_instalacion']){?> selected="selected" <?php }?>><?php print $fila['instalacion'];?></option>
                      <?php } ?>
                    </select><br><br>
                    
                    
                    
                    </td>
  			    </tr>
                <tr>
    			    <th scope="row"><label><div align="right">Estatus</div></label></th>
                    <td>
                    <select class='select-style gender' name="estatus" id="estatus">
                        <option value='0'>Seleccione</option>
                    <?php //Generamos el menu desplegable
					for($x=1; $x<=2;$x++){?>
                    	<option value=<?php print $x; if($registro["status"]==$x){?> selected="selected" <?php }?>><?php if($x==1){print "Activo";}else{print "Inactivo";}?>
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
