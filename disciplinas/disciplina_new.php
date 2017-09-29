<!DOCTYPE html>
<html>
<head>
<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="../estilos/formularios.css" media="all" />
</head>
<body>
<div class="container">
			<header align="center">Nueva Disciplina</header>       
  <div  class="form" style="width:470px;">
    		<form name="form1" method="post" action="case_disciplina.php">
    			<p class="contact"></p>
    			<table width="397" border="0" cellpadding="1">
    			  <tr>
    			    <th width="140" scope="row"><label for="disciplina">
    			      <div align="right">Disciplina</div>
    			    </label></th>
    			    <td width="247"><span class="contact">
    			      <input id="disciplina" name="disciplina" placeholder="" required tabindex="1" type="text">
    			    </span></td>
  			    </tr>
                <tr>
    			    <th scope="row"><label for="abv_disciplina">
    			      <div align="right">Código Disciplina </div>
    			    </label></th>
    			    <td><span class="contact">
    			      <input id="abv_disciplina" name="abv_disciplina" placeholder="" required tabindex="3" type="text">
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
