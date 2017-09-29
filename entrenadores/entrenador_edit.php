<?php session_start();
//header('Content-Type: text/html; charset=iso-8859-1');
?>
<?php 
if(isset($_GET['id_entrenador'])){
	include ('../configuration/conexion.php');
	Conectarse();
	$sql="SELECT * FROM t_entrenador
			WHERE id_entrenador=".$_GET['id_entrenador'];
	$resultado=mysql_query($sql);
	$registro= mysql_fetch_array($resultado);
?>
<!DOCTYPE html>
<html>
<head>
<title></title>
	<!--meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"-->
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="../estilos/formularios.css" media="all" />
</head>
<body>
<div class="container">
			<header align="center">
				Entrenador(a) Nuevo(a)
            </header>       
  <div  class="form" style="width:470px;">
    		<form name="form1" method="post" action="case_entrenador.php">
            <input name="id_entrenador" type="hidden" id="id_entrenador" value="<?php print $registro['id_entrenador']?>" >
    			<p class="contact"></p>
    			<table width="397" border="0" cellpadding="1">
    			  <tr>
    			    <th width="140" scope="row"><label for="nombres">
    			      <div align="right">Nombres</div>
    			    </label></th>
    			    <td width="247"><span class="contact">
    			      <input id="nombres" name="nombres" placeholder="" required tabindex="1" type="text" value="<?php print $registro['nombres']?>">
    			    </span></td>
  			    </tr>
    			  <tr>
    			    <th scope="row"><label for="apellidos" >
    			      <div align="right">Apellidos</div>
    			    </label></th>
    			    <td><span class="contact">
    			      <input id="apellidos" name="apellidos" placeholder="" required tabindex="2" type="text" value="<?php print $registro['apellidos']?>">
    			    </span></td>
  			    </tr>
    			  <tr>
    			    <th scope="row"><label>
    			      <div align="right">Sexo</div>
    			    </label></th>
    			    <td>
                    <?php
					$sSQL="SELECT * FROM t_sexo";
					$result=mysql_query($sSQL);
					$i=1;?>
                    
                    <select class='select-style gender' name="sexo" id="sexo">
                    <option value="0">Seleccione</option>
                    <?php //Generamos el menu desplegable
					while ($row=mysql_fetch_array($result))
					 {?>
                        <option value=<?php print $row["id_sexo"]; if($row["id_sexo"]==$registro["sexo"]){?> selected="selected" <?php }?>><?php print $row["sexo"];?></option>
                      <?php } ?>
                    </select><br><br>
                    </td>
  			    </tr>
    			  <tr>
    			    <th scope="row"><div align="right"><span class="contact">
  			      </span></div>    			      <span class="contact">
   			        <label for="email">
    			        <div align="right">Correo</div>
   			        </label>
   			      </span></th>
    			    <td><span class="contact">
    			      <input id="email" name="email" placeholder="" type="email" value="<?php print $registro['email']?>">
    			    </span></td>
  			    </tr>
    			  <tr>
    			    <th scope="row"><div align="right"><span class="contact">
  			      </span></div>    			      <span class="contact">
   			        <label for="usuario2">
    			        <div align="right">Usuario</div>
   			        </label>
   			      </span></th>
    			    <td><span class="contact">
    			      <input id="username" name="usuario" placeholder="" required tabindex="3" type="text" value="<?php print $registro['usuario']?>">
    			    </span></td>
  			    </tr>
    			  <tr>
    			    <th scope="row"><div align="right"><span class="contact">
  			      </span></div>    			      <span class="contact">
   			        <label for="password2">
    			        <div align="right">Contrase&ntilde;a</div>
   			        </label>
   			      </span></th>
    			    <td><span class="contact">
    			      <input type="password" id="password" name="password" placeholder="*****"  value="<?php  $registro['contrasena']?>">
    			    </span></td>
  			    </tr>
    			  <tr>
    			    <th scope="row"><div align="right"><span class="contact">
  			      </span></div>    			      <span class="contact">
   			        <label for="repassword2">
    			        <div align="right">Confirmar contrase&ntilde;a</div>
   			        </label>
   			      </span></th>
    			    <td><span class="contact">
    			      <input type="password" id="repassword" name="repassword" placeholder="*****"  value="<?php $registro['contrasena']?>">
    			    </span></td>
  			    </tr>
    			  <tr>
    			    <th scope="row"><label>
    			      <div align="right">Cargo</div>
    			    </label>                    </th>
    			    <td>
                    <?php
					$sSQL="SELECT * FROM t_tipo_usuario";
					$result=mysql_query($sSQL);
					?>
                    <select class='select-style gender' name="cargo" id="cargo">
                        <option value='0'>Seleccione</option>
                    <?php //Generamos el menu desplegable
					while ($row=mysql_fetch_array($result)){?>
                    	<option value=<?php print $row["id_tipo_usuario"]; if($row["id_tipo_usuario"]==$registro["id_tipo_usuario"]){?> selected="selected" <?php }?>><?php print $row["tipo_usuario"];?>
                        </option>
           			<?php } ?>
                    </select>
                    </td>
  			    </tr>
            <tr>
              <th scope="row">
                <label>
                 <div align="right">Coordinado Por:</div>
                </label>
              </th>
              <td><select class="select-style" name="coordinador">
                  <option value="-">Seleccione..</option>
              <?php 
              $consulta = "SELECT * FROM t_entrenador WHERE id_tipo_usuario=2";
              $resultado = mysql_query($consulta);
              while ($fila = mysql_fetch_assoc($resultado)) { ?>
                 <option value= <?php print $fila['id_entrenador'] ; if($fila["id_entrenador"]==$registro["coordinado_por"]){?> selected="selected" <?php }?> ><?php print $fila['nombres']." ".$fila['apellidos']?></option> 
              <?php } //cierro el While?>
                 </select>
              </td>
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
             <p align="center"><input class="buttom" name="submit" id="submit" tabindex="5" value="Guardar" type="submit"> </p>  
    <input name="seleccion" type="hidden" id="seleccion" value="2">
            

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
