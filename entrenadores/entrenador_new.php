<!DOCTYPE html>
<html>
<head>
<title></title>
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
    			<p class="contact"></p>
    			<table width="397" border="0" cellpadding="1">
    			  <tr>
    			    <th width="140" scope="row"><label for="nombres">
    			      <div align="right">Nombres</div>
    			    </label></th>
    			    <td width="247"><span class="contact">
    			      <input id="name2" name="nombres" placeholder="" required tabindex="1" type="text">
    			    </span></td>
  			    </tr>
    			  <tr>
    			    <th scope="row"><label for="apellidos">
    			      <div align="right">Apellidos</div>
    			    </label></th>
    			    <td><span class="contact">
    			      <input id="name" name="apellidos" placeholder="" required tabindex="2" type="text">
    			    </span></td>
  			    </tr>
    			  <tr>
    			    <th scope="row"><label>
    			      <div align="right">Sexo</div>
    			    </label></th>
    			    <td><select class="select-style gender" name="sexo">
    			      <option value="-">Seleccione..</option>
    			      <option value="1">Masculino</option>
    			      <option value="2">Femenino</option>
  			      </select><br><br></td>
  			    </tr>
    			  <tr>
    			    <th scope="row"><div align="right"><span class="contact">
  			      </span></div>    			      <span class="contact">
   			        <label for="email">
    			        <div align="right">Correo</div>
   			        </label>
   			      </span></th>
    			    <td><span class="contact">
    			      <input id="email" name="email" placeholder="" type="email">
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
    			      <input id="username" name="usuario" placeholder="" required tabindex="3" type="text">
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
    			      <input type="password" id="password" name="password" required>
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
    			      <input type="password" id="repassword" name="repassword" required>
    			    </span></td>
  			    </tr>
    			  <tr>
    			    <th scope="row">
                <label>
    			       <div align="right">Cargo</div>
    			      </label>
              </th>
    			    <td><select class="select-style" name="cargo">
                  <option value="-">Seleccione..</option>
              <?php 
              include ('../configuration/conexion.php');
              Conectarse(); 
              $consulta = "SELECT * FROM t_tipo_usuario";
              $resultado = mysql_query($consulta);
              while ($fila = mysql_fetch_assoc($resultado)) { ?>
    			       <option value= <?php print $fila['id_tipo_usuario']?> ><?php print $fila['tipo_usuario']?></option> 
              <?php } //cierro el While?>
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
                 <option value= <?php print $fila['id_entrenador']?> ><?php print $fila['nombres']." ".$fila['apellidos']?></option> 
              <?php } //cierro el While?>
                 </select>
              </td>
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