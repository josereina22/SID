<?php
session_start();
//header('Content-Type: text/html; charset=ISO-8859-1');
//header('Content-Type: text/html; charset=utf-8');
$usuario=$_SESSION['usu'];
include ('configuration/conexion.php');
$mysqli=Conectarse();
?>

<html>
    <head>
        <!--meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" /-->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
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
        <script type="text/javascript" src="jscalendar/calendar-setup.js"></script>
    </head>
<body>
<form name="form1" method="post" action="">
  <table width="900" border="1" cellpadding="3" align="center" id="table">
    <tr>
      <th>
         <label for="edad_min">
           <div align="left">Edad</div>
         </label>
        <div align="left">
          <label for="edad"></label>
           <input type="number" name="edad" id="edad" min=1>
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
             $resultados= $mysqli->query($consulta);
             
             while ($fila = $resultados->fetch_array()) {
         ?>
          <option value=<?php print $fila['id_disciplina']?>><?php print utf8_encode($fila['disciplina'])?></option>
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
      <th><input type="submit" name="button" id="button" value="Buscar"></th>
    </tr>
   </table> 	
</form>

<?php
//if (isset($_POST['edad']) or isset($_POST['disciplina']) or isset($_POST['sexo'])){

    if (!empty($_POST['edad'])){
     $edad=$_POST['edad'];
     $edad="(edad_min<=".$edad. " AND edad_max >=".$edad.")";
    }else{
      $edad="1+1";
    }
    if (!empty($_POST['disciplina'])){
      $disciplina=$_POST['disciplina'];    
      $disciplina= "t_disciplina.id_disciplina=".$disciplina;
    }else{
      $disciplina="1+1";
    }
    if (!empty($_POST['sexo'])){
      $sexo=$_POST['sexo'];    
      $sexo= "(t_clase.sexo=".$sexo." OR t_clase.sexo=3)";
    }else{
      $sexo="1+1";
    }
  
  
  
  $sql="SELECT cod_clase, nombres, apellidos, disciplina, edad_min, edad_max, t_clase.sexo, semanas, hora_inicio, hora_fin,
  				instalacion, cancha, capacidad,inscrito,disponible
  		FROM  t_clase, t_entrenador, t_disciplina, t_instalacion, t_cancha
  		WHERE t_entrenador.id_entrenador=t_clase.id_entrenador
  		AND t_disciplina.id_disciplina=t_clase.id_disciplina
  		AND t_instalacion.id_instalacion=t_clase.id_instalacion
  		AND t_cancha.id_cancha=t_clase.id_cancha
  		AND $edad
  		AND $disciplina
      	AND $sexo";


  /*, 
      WHERE t_entrenador.id_entrenador=t_clase.id_entrenador
      AND t_disciplina.id_disciplina=t_clase.id_disciplina
      AND t_instalacion.id_instalacion=t_clase.id_instalacion
      AND t_cancha.id_cancha=t_clase.id_cancha
      AND $edad
      AND $disciplina
      AND $sexo
      ";

  /* $sql="SELECT * FROM t_entrenador, t_clase, t_disciplina, t_instalacion, t_cancha
   		WHERE (t_entrenador.id_entrenador=t_clase.id_entrenador)
      AND  t_instalacion.id_instalacion=t_clase.id_instalacion 
      AND (t_disciplina.id_disciplina=t_clase.id_disciplina OR t_clase.id_disciplina=0)
      AND (t_instalacion.id_instalacion=t_clase.id_instalacion OR t_clase.id_instalacion=0)
      AND (t_cancha.id_cancha=t_clase.id_cancha OR t_clase.id_cancha=0)
   		AND $edad  AND $disciplina AND $sexo

      " ; */
//exit();
  $consulta= $mysqli->query($sql)
?>
<p align="center"> Disponibilidad de las Clases</p>
<table width="1000" border="1" cellpadding="3" align="center" id="striped">
  <tr>
    <th width="140">C&oacute;digo (Clase)</th>
    <th>Entrenador</th>
    <th>Disciplina</th>
    <th>Categoria</th>
    <th>Sexo</th>
    <th width="130">Dias</th>
    <th>Horario</th>
    <th>Instalaci&oacute;n</th>
    <th width="70">Cancha</th>
    <th>Cap.</th>
    <th>Insc.</th>
    <th>Disp.</th>
  </tr>
<?php
  $i=0;
  while ($fila=$consulta->fetch_array()){ 
    if ($fila["disponible"]<=0){
      $bgcolor="bgcolor='YELLOW'";
    }else{$bgcolor="";}
?>
  <tr >  	
    <td <?php print $bgcolor?> ><?php print utf8_encode($fila["cod_clase"])?></td>
    <td <?php print $bgcolor?> ><?php print utf8_encode($fila["nombres"])." ".utf8_encode($fila["apellidos"])?></td>
    <td <?php print $bgcolor?> ><?php print utf8_encode($fila["disciplina"])?></td>
    <td <?php print $bgcolor?> ><?php print $fila["edad_min"]."-".$fila["edad_max"]?></td>
    <td <?php print $bgcolor?>><?php if ($fila["sexo"]==1)print"Masculino"; elseif ($fila["sexo"]==2)print"Femenino"; elseif ($fila["sexo"]==3)print"Mixto";?></td>
    <td <?php print $bgcolor?> ><?php print $fila["semanas"]?></td>
    <td <?php print $bgcolor?> align="center"><?php print $fila["hora_inicio"]." a ".$fila["hora_fin"];?></td>
    <td <?php print $bgcolor?>><?php print $fila["instalacion"]?></td>
    <td <?php print $bgcolor?>><?php print utf8_encode($fila["cancha"])?></td>
    <td <?php print $bgcolor?>><?php print $fila["capacidad"]?></td>
    <td <?php print $bgcolor?>><?php print $fila["inscrito"]?></td>
    <td <?php print $bgcolor?>><?php print $fila["disponible"]?></td>
    <!--td><a href="eliminar_clases.php?cod_clase=<?php echo $fila["cod_clase"]?>" target="cuerpo">Eliminar</a></td-->
   
  </tr>
<?php  
  $i++;
  }
 ?>
</table>

<p align="center"> <?php print("Total Clases Encontradas: ".$i); ?> </p>
<?php
//}
?>

</body>
</html>