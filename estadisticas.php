<?php
  include ('configuration/conexion.php');
     conectarse();
	 //header('Content-Type: text/html; charset=ISO-8859-1'); 
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link type="text/css" href="estilos/tablas_report.css" rel="stylesheet" />
<link type="text/css" href="estilos/boton_report.css" rel="stylesheet" />
<style type="text/css">
@import url("jscalendar/calendar-system.css");.hjh {
	font-size: larger;
	z-index:100;
}
</style>
<script type="text/javascript" src="jquery/jquery.js"></script>
<script type="text/javascript" src="estilos/tablas_report.js"></script>


<!-- import the calendar script -->
<script type="text/javascript" src="jscalendar/calendar.js"></script>
<!-- import the language module -->
<script type="text/javascript" src="jscalendar/lang/calendar-es.js"></script>
<script type="text/javascript" src="jscalendar/calendar-setup.js" /></script>
</head>
<body>

<form name="form1" method="post" action="">
  <table width="900" border="1" cellpadding="3" align="center" id="table">
    <tr>
      <th>
        <label for="fecha_inicio">
         <div align="left">Fecha de Inicio</div>
        </label>
        <div align="left">
          <input name="fecha_ini" type="text" id="fecha_ini" size="25" maxlength="15" readonly/>	
         <img src="jscalendar/img.gif" id="seleci" />
         <script type='text/javascript'>
            Calendar.setup({
            inputField: 'fecha_ini',
            ifFormat:   '%Y-%m-%d',
            button:     'seleci'
            });
         </script>
        </div>
      </th>
      <th>
         <label for="fecha_fin">
           <div align="left">Fecha Fin</div>
         </label>
           <div align="left">
            <input name="fecha_fin" type="text" id="fecha_fin" size="25" maxlength="15" readonly/>	
         <img src="jscalendar/img.gif" id="selecf" />
         <script type='text/javascript'>
            Calendar.setup({
            inputField: 'fecha_fin',
            ifFormat:   '%Y-%m-%d',
            button:     'selecf'
            });
         </script>
           </div>
      </th>
      <th>
         <label for="edad_min">
           <div align="left">Edad Minima</div>
         </label>
        <div align="left">
          <label for="edad_min"></label>
           <input type="number" name="edad_min" id="edad_min">
        </div>
      </th>
      <th>
         <label for="edad_max">
           <div align="left">Edad Maxima</div>
         </label>
        <div align="left">
          <label for="edad_max"></label>
           <input type="number" name="edad_max" id="edad_max">
         </div>
      </th>
    </tr>
    <tr>
       <th>
         <label for="instalacion">
           <div align="left">Instalacion</div>
         </label>
         <div align="left">
          <select name="instalacion" id="instalacion">
          <option value="" selected="selected">Seleccione</option>
          <?php
			 $consulta = "SELECT * FROM t_instalacion";
             $resultado = mysql_query($consulta);
             while ($fila = mysql_fetch_assoc($resultado)) {
         ?>
          <option value=<?php print $fila['id_instalacion']?>><?php print $fila['instalacion']?></option>	
          <?php } //cierro el While?>
          </select>
         </div>
      </th>
      <th>
         <label for="disciplina">
           <div align="left">Disciplina</div>
         </label>
         <div align="left">
           <select name="disciplina" id="disciplina">
           <option value="" selected="selected">Seleccione</option>
          <?php
			 $consulta = "SELECT * FROM t_disciplina";
             $resultado = mysql_query($consulta);
             while ($fila = mysql_fetch_assoc($resultado)) {
         ?>
          <option value=<?php print $fila['id_disciplina']?>><?php print $fila['disciplina']?></option>	
          <?php } //cierro el While?>
           </select>
         </div>
      </th>
      <th>
         <label for="municipio">
           <div align="left">Municipio</div>
         </label>
         <div align="left">
          <select name="municipio" id="municipio">
          <option value="" selected="selected">Seleccione</option>
          <?php
			 $consulta = "SELECT * FROM t_municipio";
             $resultado = mysql_query($consulta);
             while ($fila = mysql_fetch_assoc($resultado)) {
         ?>
          <option value=<?php print $fila['id_municipio']?>><?php print $fila['municipio']?></option>	
          <?php } //cierro el While?>
          </select>
         </div>
       </th>
      <th>
        <label for="sector">
          <div align="left">Sector</div>
        </label>
        <div align="left">
          <select name="sector" id="sector">
          <option value="" selected="selected">Seleccione</option>
          <?php
			 $consulta = "SELECT * FROM t_urbanizacion";
             $resultado = mysql_query($consulta);
             while ($fila = mysql_fetch_assoc($resultado)) {
         ?>
          <option value=<?php print $fila['id_urbanizacion']?>><?php print $fila['urbanizacion']?></option>	
          <?php } //cierro el While?>
          </select>
        </div>
      </th>
      
    </tr>
    <tr>
      <th>
          <label for="tipo_inscripcion">
             <div align="left">Tipo Inscripcion</div>
          </label>
          <div align="left">
            <select name="tipo_inscripcion" id="tipo_inscripcion">
            <option value="" selected="selected">Seleccione</option>
            <?php
			 $consulta = "SELECT * FROM t_tipo_inscripcion";
             $resultado = mysql_query($consulta);
             while ($fila = mysql_fetch_assoc($resultado)) {
         ?>
          <option value=<?php print $fila['id_tipo_inscripcion']?>><?php print $fila['tipo_inscripcion']?></option>	
          <?php } //cierro el While?>
            </select>
          </div>
    </th>
      <th>
        <label for="sexo">
          <div align="left">Sexo</div>
        </label>
        <div align="left">
          <select name="sexo" id="sexo">
          	<option value="" selected="selected">Seleccione</option>
          	<option value="1">Masculino</option>
            <option value="2">Femenino</option>
          </select>
        </div>
      </th>
      <th>
        <label for="estatus">
          <div align="left">Estatus</div>
        </label>
        <div align="left">
          <select name="estatus" id="estatus">
            <option value="" selected="selected">Seleccione</option>
            <option value="1">Activo</option>
            <option value="2">Inactivo</option>
          </select>
        </div>
      </th>
      <th><input type="submit" name="button" id="button" value="Buscar"></th>
    </tr>
    <tr>
      <th colspan="6"> 
 <?php
  
	
	if (!empty($_POST['fecha_ini'])){
		$fecha_ini=$_POST['fecha_ini'];
		$fecha_fin=$_POST['fecha_fin'];
		$fechas= "(fecha_inscripcion >='".$fecha_ini."' AND fecha_inscripcion <= '".$fecha_fin."')";
	}else{$fechas="1+1";}
	
	if (!empty($_POST['instalacion'])){
		$instalacion=$_POST['instalacion'];
		$instalacion= "t_clase.id_instalacion=".$instalacion;
	}else{$instalacion="1+1";}
	
	if (!empty($_POST['disciplina'])){
		$disciplina=$_POST['disciplina'];
		$disciplina= "t_clase.id_disciplina=".$disciplina;
	}else{$disciplina="1+1";}
	
	if (!empty($_POST['municipio'])){
		$municipio=$_POST['municipio'];
		$municipio= "t_deportista.id_municipio=".$municipio;
	}else{$municipio="1+1";}
		
	if (!empty($_POST['sector'])){
		$sector=$_POST['sector'];
		$sector= "t_deportista.id_urbanizacion=".$sector;
	}else{$sector="1+1";}
	
	if (!empty($_POST['tipo_inscripcion'])){
		$tipo_inscripcion=$_POST['tipo_inscripcion'];
		$tipo_inscripcion= "t_deportista.id_tipo_inscripcion=".$tipo_inscripcion;
	}else{$tipo_inscripcion="1+1";}
	
	if (!empty($_POST['sexo'])){
		$sexo=$_POST['sexo'];
		$sexo= "t_deportista.id_sexo=".$sexo;
	}else{$sexo="1+1";}	
	
	if (!empty($_POST['estatus'])){
		$estatus=$_POST['estatus'];
		$estatus= "t_deportista.estatus=".$estatus;
	}else{$estatus="1+1";}			
		
		
	
		
		/*
		  $edad_min=$_POST["edad_min"];
		  $dias=explode("-", $edad_min, 3);
		  $dias=mktime(0,0,0,$dias[1],$dias[2],$dias[0]);
		  print $edad_min=(int)((time()-$dias)/31556926);
		
		$edad_max=$_POST["edad_max"];
		$dias=explode("-", $edad_max, 3);
		$dias=mktime(0,0,0,$dias[1],$dias[2],$dias[0]);
		$edad_max=(int)((time()-$dias)/31556926);
		*/
		
		//$buscar=$_POST['buscar'];
		 $consulta="SELECT *, t_deportista.estatus 
	 			FROM t_deportista, t_inscrito, t_clase
				WHERE t_deportista.id_deportista = t_inscrito.id_deportista 
				AND $fechas
				AND $instalacion
				AND $disciplina
				AND $municipio
				AND $sector
				AND $tipo_inscripcion
				AND $sexo
				AND $estatus
				AND t_clase.cod_clase=t_inscrito.cod_clase
				GROUP BY t_deportista.id_deportista
				ORDER BY t_deportista.id_deportista DESC
				";
				//die($consulta);
	 $resultados= mysql_query ($consulta) or die("error consulta: ".mysql_error());
?>      
      
      <table width="900" border="1" cellpadding="3" align="center" id="striped">
        <tr>
          <th>Carnet</th>
           <th>C&eacute;dula</th>
          <th>Nombres y Apellidos</th>
          <th>Estatus</th>
          <th>C&oacute;digos</th>
        </tr>
<?php  
	$i=0;
	if (!(@mysql_num_rows ($resultados) == 0))
		{
			while ($campo = mysql_fetch_array($resultados))
			{
				$id_deportista=$campo['id_deportista'];
				$cedula=$campo['cedula'];
				$nombres=$campo['nombres'];
				$apellidos=$campo['apellidos'];
				$estatus=$campo['estatus'];
				$id_sexo=$campo['id_sexo'];
	?>
        <tr bgcolor="">
          <td><?PHP print $id_deportista?></td>
          <td><?PHP echo $cedula?></td>
          <td><?PHP echo $nombres," ",$apellidos?></td>
          <td><?PHP  if($estatus==1){
		  	print "ACTIVO";
			}elseif ($estatus==2){
				print "INACTIVO";}
	  ?></td>
          <td><?PHP 
	  	$consul_clases="SELECT * FROM t_inscrito, t_estatus_inscrito WHERE id_deportista='$id_deportista' AND id_estatus_inscrito=estatus";
		$result_clases= mysql_query($consul_clases);
		$x=1;
		while ($campo = mysql_fetch_array($result_clases)){
				print $x.") ".$campo["cod_clase"]." ".$campo["estatus_inscrito"]; 
				print "<BR>";
				$x++;
			}
	  ?></td>

        </tr>
        <?php
	 $i++;
			}
		}
	else
	{echo "no se consigio registro";}
	?>
      </table>
        <?php
    echo "TOTAL DE REGISTRO ENCONTRADO="," ", $i;
  ?>
      </th>
    </tr>
  </table>
  <?php
	
  ?>
</form>
</body>
</html>