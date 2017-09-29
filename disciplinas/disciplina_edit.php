<?php session_start();?>
<?php 
if(isset($_GET['id_disciplina'])){
	include ('../configuration/conexion.php');
	Conectarse();
	$sql="SELECT * FROM t_disciplina
			WHERE id_disciplina=".$_GET['id_disciplina'];
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
				Editar Disciplina
            </header>       
  <div  class="form" style="width:470px;">
    		<form name="form1" method="post" action="case_disciplina.php">
            <input name="id_disciplina" type="hidden" id="id_disciplina" value="<?php print $registro['id_disciplina']?>" >
    			<p class="contact"></p>
    			<table width="397" border="0" cellpadding="1">
    			  <tr>
    			    <th width="140" scope="row"><label for="disciplina">
    			      <div align="right">Disciplina</div>
    			    </label></th>
    			    <td width="247"><span class="contact">
    			      <input id="disciplina" name="disciplina" placeholder="" required tabindex="1" type="text" value="<?php print $registro['disciplina']?>">
    			    </span></td>
  			    </tr>
                <tr>
    			    <th scope="row"><label for="abv_disciplina">
    			      <div align="right">Código Disciplina </div>
    			    </label></th>
    			    <td><span class="contact">
    			      <input id="abv_disciplina" name="abv_disciplina" placeholder="" required tabindex="3" type="text" value="<?php print $registro['abv_disciplina']?>">
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
