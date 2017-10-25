<?php session_start(); 
include ('configuration/conexion.php');
$mysqli=Conectarse();  
/*if (isset($_REQUEST["seleccion"]))
{
	$seleccion=$_REQUEST["seleccion"];}
else
{
	$seleccion=0;}*/
	$seleccion=0;
$cod_clase=$_GET['cod_clase'];
$sql_clase="SELECT * FROM t_clase WHERE cod_clase='$cod_clase'";
$consulta_clase= $mysqli->query($sql_clase);
$row_clase= $consulta_clase->fetch_array();
$id_entrenadorBD=$row_clase['id_entrenador'];
?>

<html>
<head>
<!--meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /-->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title></title>
<!--     **********************Tablas form******************************************** -->
<link rel="stylesheet" type="text/css" href="estilos/formularios.css" media="all" />
<!--     ******************************************************************     -->
<!--     ********************horario*********************************     -->
<link rel="stylesheet" type="text/css" href="estilos/horarios.css" media="all" />
<!--     ******************************************************************     -->
<link rel="stylesheet" type="text/css" href="clases/select_dependientes.css">
<script type="text/javascript" src="clases/select_dependientes.js"></script>
<script type="text/javascript" src="clases/valido.js"> </script>
<script> 
function cambiar_id_entrenador(y) 
{
	 
alert(y); 

//document.location.href='editar_clases.php?id_entrenador='+x;
}

</script>
</head>
<body>

<?php 
if (isset($_POST['id_entrenador']))
{
	$entrenador=$_POST['id_entrenador'];
	$capacidad=$_POST['capacidad'];
	$id_sexo=$_POST['id_sexo'];
	$edad_min=$_POST['edad_min'];
	$edad_max=$_POST['edad_max'];
	$hora_bd=$row_clase['hora_inicio'];
	$disponibilidad=$capacidad-$row_clase['inscrito'];//para actualizar la disponibilidad
	
	$lmmjvsd = explode('-', $row_clase['semanas']);
$semanas="";
for ($z=0;$z<=7;$z++)
{
	if ($z==0)
	{
		$semanas=$semanas."semanas LIKE '%$lmmjvsd[$z]%'";
	}
	else
	{
		if (isset($lmmjvsd[$z]))
		{
			$semanas=$semanas." OR semanas LIKE '%$lmmjvsd[$z]%'";
		}
	}
}
$semanas;
	
	$consulta= $mysqli->query("SELECT * FROM t_clase WHERE  id_entrenador='$entrenador' AND(hora_inicio<='$hora_bd' AND hora_fin>'$hora_bd') AND ($semanas)");
	$resultado=$consulta->num_rows;
	
	if ($resultado=="0" OR $id_entrenadorBD==$entrenador){ //Valido si el entrenador esta disponible, hora de inicio este en el rango inicio y fin de la BD, y que algun dia de la semana este almacenada	
	  $mysqli->query("UPDATE t_clase SET id_entrenador='$entrenador', capacidad='$capacidad', sexo='$id_sexo',	edad_min='$edad_min', edad_max='$edad_max', disponible='$disponibilidad'
    WHERE cod_clase='$cod_clase'");
	}
	else{
    print "<script> alert('Verifique la disponibilidad del Entrenador');</script>";}
}
?>







<div  class="form" style="width:700px;">
<?php
print "<p align='center'>".$row_clase['cod_clase']."</p>";

//Hora Para Armar el Horarios almacedanas en la Base de Datos
$consul_hora = "SELECT * FROM t_hora";
$result_hora =  $mysqli->query($consul_hora);
$y=0;
while ($fila_hora = $result_hora->fetch_array()) {
	$horas[$y]=$fila_hora['hora'];
	$y++;
 }
//Los dias de la semana que van en el horario 
$consul_sem = "SELECT * FROM t_semana";
$result_sem =  $mysqli->query($consul_sem);
$y=0;
while ($fila_sem= $result_sem->fetch_array()) {
	$sem[$y]=$fila_sem['abv_semana'];
	$nombre_sem[$y]=$fila_sem['semana'];
	$y++;
 }
$cod_clase=$row_clase['cod_clase'];
if (isset($_GET['id_entrenador'])){$id_entrenador=$_GET['id_entrenador'];}
else{$id_entrenador=$row_clase['id_entrenador'];}
$id_instalacion=$row_clase['id_instalacion'];
$id_cancha=$row_clase['id_cancha'];
$id_disciplina_selec=$row_clase['id_disciplina'];
$capacidad=$row_clase['capacidad'];
$sexo=$row_clase['sexo'];
if ($sexo==1){$sexo_nombre="Masculino";}
elseif ($sexo==2){$sexo_nombre="Femenino";}
elseif ($sexo==3){$sexo_nombre="Mixto";}
$edad_min=$row_clase['edad_min'];
$edad_max=$row_clase['edad_max']; 
?>

<form action="" method="post" name="form_iced">
<table width="591" border="0" cellpadding="1" align="center" id="table">
  <tr>
    <th colspan="5"><div align="center">Clases</div></th>
  </tr>
  <tr>
    <th><div align="right">Entrenador</div></th>
    <td colspan="4">
  
    <select class="select-style" name="id_entrenador" id="id_entrenador" onChange="window.location ='?cod_clase=<?php print $cod_clase?>&id_entrenador='+this.options[this.selectedIndex].value; return true;"> 
    	
          <?php
			 $consulta = "SELECT * FROM t_entrenador ORDER BY nombres";
             $resultado =  $mysqli->query($consulta);
             while ($fila = $resultado->fetch_array()) {
         ?>
          <option value=<?php print $fila['id_entrenador']?> <?php if($id_entrenador==$fila['id_entrenador']){?> selected <?php } ?>><?php print $fila['nombres']." ".$fila['apellidos']?></option>	
          <?php } //cierro el While?>
      </select>
    </td>
  </tr>
  <tr>
    <th><div align="right">Instalaci&oacute;n</div></th>
    <td colspan="4">
      <?php 
	      //Creamos la sentencia SQL y la ejecutamos
          $sSQL="Select * From t_instalacion";
          $result= $mysqli->query($sSQL);
		  // Voy imprimiendo el primer select compuesto por los direccions
		  print "<select class='select-style' name='id_instalacion' id='id_instalacion' onChange='cargaContenido(this.id)' disabled>";
		  print "<option value='0'>Seleccione</option>";
		  while($registro=$result->fetch_array())
		  {?>
			  <option value=<?php print $registro[0] ?> <?php if($row_clase['id_instalacion']==$registro[0]){?> selected <?php } ?> ><?php print$registro[1] ?></option>";			  
		  <?php } ?>
		  </select>    
    </td>
  </tr>
  <tr>
    <th><div align="right">Cancha</div></th>
    <td colspan="4">
    	<?php 
	      //Creamos la sentencia SQL y la ejecutamos
          $sSQL="SELECT * FROM t_cancha WHERE id_instalacion=$row_clase[id_instalacion]";
          $result= $mysqli->query($sSQL);
		  // Voy imprimiendo el primer select compuesto por los direccions
		  ?>
          <select class='select-style' name='id_cancha' id='id_cancha' disabled >
		     <option value='0'>Seleccione</option>
		  <?php
          	while($registro=$result->fetch_array())
		  	{?>
              <option value=<?php print $registro['id_cancha']?> <?php if($row_clase['id_cancha']==$registro['id_cancha']){?> selected <?php } ?>><?php print $registro['cancha']?></option>	
                          <?php } //cierro el While?>
                      </select>    </td>
  </tr>
  <tr>
    <th><div align="right">Disciplina</div></th>
    <td colspan="4">
    <select class='select-style' name="id_disciplina" id="id_disciplina" disabled>
        <option value="" selected="selected">Seleccione</option>
        <?php
			 $consulta = "SELECT * FROM t_disciplina";
             $resultado =  $mysqli->query($consulta);
             while ($fila = $resultado->fetch_array()) {
         ?>
        <option value=<?php print $fila['id_disciplina']?><?php if($row_clase['id_disciplina']==$fila['id_disciplina']){?> selected <?php } ?>> <?php print $fila['disciplina']?></option>
        <?php } //cierro el While?>
      </select>   
    </td>
    </tr>
    <tr>
      <th><div align="right">Capacidad</div></th>
      <td colspan="4"><input name="capacidad" type="text" id="capacidad" style="width:50px" value="<?php print $row_clase['capacidad']?>" maxlength="4"></td>
    </tr>
  <tr>
    <th><div align="right">Sexo</div></th>
    <td colspan="4">
        <select class='select-style' name="id_sexo" id="id_sexo">
        <option value="" selected="selected">Seleccione</option>
        <?php
			 $consulta = "SELECT * FROM t_sexo";
             $resultado =  $mysqli->query($consulta);
             while ($fila = $resultado->fetch_array()) {
         ?>
        <option value=<?php print $fila['id_sexo']?><?php if($row_clase['sexo']==$fila['id_sexo']){?> selected <?php } ?>> <?php print $fila['sexo']?></option>
        <?php } //cierro el While?>
         <option value="3" <?php if($row_clase['sexo']==3){?> selected <?php }?>>Mixto</option>
      </select> 
    </td>
  </tr>
    <tr>
    <th><div align="right">Edad</div></th>
    <th><div align="right">Desde </div></th>
    <td><input name="edad_min" type="text" id="edad_min" style="width:50px" value="<?php print $row_clase['edad_min']?>" size="10" maxlength="3"></td>
    <th><div align="right">Hasta</div></th>
    <td><input name="edad_max" type="text" id="edad_max" style="width:50px" value="<?php print $row_clase['edad_max']?>" size="10" maxlength="3"></td>
  </tr>
  <tr>
    <td><label>
      <div align="right">Dias</div>
    </label></td>
    <td colspan="8">
		<table border="1" bgcolor="#BBEEC7">
			<tr>
			<?php 
			$rr = explode('-', $row_clase['semanas']);  //para semarar los dias de las semanas de la base de datos y estraerlo en un array
			$val=0;
			
			//coloco las iniciales de las semanas junto con un checkbox
			for($yy=0;$yy<7;$yy++){ //para colocar los dias de las semanas
				print '<td>';
				print $sem[$yy];
				for($zz=0;$zz<7;$zz++){ 
					if ($sem[$zz]==$sem[$yy]){ //para comparar cada dia de la semanas con todos los dias 
						if(isset($rr[$val])){ $cont_clase=$rr[$val];} //para saber si el vector de la clase contiene valor
						?>
                			<input name='<?php print $sem[$yy]?>' type='checkbox' 
                        	id='<?php print $sem[$yy]?>' 
							<?php if($cont_clase==$sem[$yy]){ ?>checked <?php print $val++;} ?> disabled><!-- si el Vector se parece a la smana actual-->
						<BR>
						<?php
					}
						
				}					
				print '</td>';
			}
			?>
        	</tr>
        </table>
     </td>
  </tr>
  
  <tr>
  		<th rowspan="1"><div align="right">Horario</div></th>
  		<td colspan="4">
         <table border="1"  style="border-style:solid"bordercolor="#000000" >
         <tr>
            <th rowspan="2" bgcolor="#8EBBE8">Desde</th>
            <th bgcolor="#8EBBE8">Hora</th>
            <th bgcolor="#8EBBE8">Min</th>
            <th bgcolor="#8EBBE8">Turno</th>
            <th rowspan="2"bgcolor="#8EBBE8">Hasta</th>
            <th bgcolor="#8EBBE8">Hora</th>
            <th bgcolor="#8EBBE8">Min</th>
            <th bgcolor="#8EBBE8">Turno</th>
          </tr>
          <!--Creo los select separado de horas, minutos y segundos de (desde y hasta)-->
          <?php 
		  	$hora_bd = explode(':', $row_clase['hora_inicio']);
		  	if ($hora_bd[0]>12){$h_bd=$hora_bd[0]-12;$turno="PM";}else{$h_bd=$hora_bd[0];$turno="AM";}
		  	
			$hora_bdf = explode(':', $row_clase['hora_fin']);
		  	if ($hora_bdf[0]>12){$h_bdf=$hora_bdf[0]-12;$turnof="PM";}else{$h_bdf=$hora_bdf[0];$turnof="AM";}
		  
		   ?>
          <tr>
            <td><select class='select-style' name="hora_select_desde" style="width:60px" disabled>
                <option value=""> </option>
            <?php for ($h=1;$h<=12;$h++){ ?>
                <option value="<?php print $h;?>" <?php if ($h==$h_bd){ ?> selected <?php } ?>><?php print $h;?> </option>
            <?php } ?>
            </select></td>
            <td><select class='select-style' name="min_select_desde" style="width:60px" disabled>
                <option value=""> </option>
            <?php for ($h=0;$h<=45;$h=$h+15){ ?>
                <option value="<?php print $h?>" <?php if ($h==$hora_bd[1]){ ?> selected <?php } ?>><?php if($h==0){print "0".$h;}else{print $h;}?> </option>
            <?php } ?>
            </select></td>
            
            <td><select class='select-style' name="turno_select_desde" style="width:60px" disabled>
                    <option value=""> </option>
                    <option value="AM" <?php if ($turno=="AM") {?> selected <?php } ?>>AM </option>
                    <option value="PM"<?php if ($turno=="PM") {?> selected <?php } ?>>PM</option>
                </select>
            </td>
            
            
            <td><select class='select-style' name="hora_select_hasta" style="width:60px" disabled>
                    <option value=""> </option>
            <?php for ($h=1;$h<=12;$h++){ ?>
            	<option value="<?php print $h;?>" <?php if ($h==$h_bdf){ ?> selected <?php } ?>><?php print $h;?> </option>
            <?php } ?>
            </select></td>
            <td><select class='select-style' name="min_select_hasta" style="width:60px" disabled>
                    <option value=""> </option>
            <?php for ($h=0;$h<=45;$h=$h+15){ ?>
            	<option value="<?php print $h?>" <?php if ($h==$hora_bdf[1]){ ?> selected <?php } ?>><?php if($h==0){print "0".$h;}else{print $h;}?> </option>
            <?php } ?>
            </select></td>
            <td><select class='select-style' name="turno_select_hasta" style="width:60px" disabled>
                    <option value=""> </option>
                    <option value="AM" <?php if ($turnof=="AM") {?> selected <?php } ?>>AM </option>
                    <option value="PM"<?php if ($turnof=="PM") {?> selected <?php } ?>>PM</option>
                </select>
            </td>
          </tr>
         </table>
        </td>
  </tr>
  
  <tr>
    <td colspan="5"><input name="seleccion" type="hidden" id="seleccion" value="1">
    <p align="center"><input type="submit" name="button" id="button" value="Actualizar" class="buttom"></p>
    </td>
  </tr>
</table>
</form>
</div>
<?php
	//Realizo el SELECT	 para traerme nombre apellido del entrenador, nombre de la diciplina y abreviado, nombre de la cancha y abreviado, nombre de la instalacion y abreviado, 
	$consulta= "SELECT  nombres, apellidos, disciplina, abv_disciplina, instalacion, abv_instalacion, cancha, abv_cancha
			FROM t_entrenador, t_disciplina, t_instalacion, t_cancha
			WHERE id_cancha=$id_cancha
			AND id_entrenador=$id_entrenador
			AND t_instalacion.id_instalacion=$id_instalacion
			AND t_disciplina.id_disciplina=$id_disciplina_selec"; 

		$resultado =  $mysqli->query($consulta);
		$fila = $resultado->fetch_array();
		$tt_nombres=$fila['nombres'];
		$tt_apellidos=$fila['apellidos'];
		$tt_disciplina=$fila['disciplina'];
		$abv_disciplina=$fila['abv_disciplina'];
		$tt_instalacion=$fila['instalacion'];
		$abv_inst=$fila['abv_instalacion'];
		$tt_cancha=$fila['cancha'];
		$abv_cancha=$fila['abv_cancha'];
		$codigo="$abv_disciplina-$abv_inst-$abv_cancha"; //creo parte del codigo segun los abreviados para la clase
		$_SESSION["codigo"]=$codigo; //lo almaceno en una variable session para continuar armando el codigo en la opcion 2
?>

<p align="center">Disponibilidad Entrenador</p>

<table width="800" border="1" cellpadding="1" align="center" id="horario">
	<tr>
		    <th>Horas</th>
            <?php for ($i=0;$i<=6;$i++)
			{ ?> <th width='100'> <?php print $nombre_sem[$i] ?> </th> <?php } // nombre de los dias de la semana para el horario
			?>
    </tr>
<?php


$id_disciplina=array(); //vector para almacenar nombre de disciplina, dia y hora
$y=0; //para el vector id_disciplina

//Select para mostrar la data obtenida de la primera seleccion y crear el horario esto es segun dispomibilidad del entrenador o la cancha
$consulta =    "SELECT t_entrenador.id_entrenador, nombres, apellidos, id_cancha, t_disciplina.id_disciplina, 
				t_disciplina.disciplina, dia, t_horario.hora_inicio, t_clase.cod_clase
				FROM t_clase, t_horario, t_entrenador, t_disciplina
				WHERE  t_clase.id_entrenador =$id_entrenador
				AND t_clase.cod_clase = t_horario.cod_clase
				AND t_clase.id_entrenador = t_entrenador.id_entrenador
				AND t_clase.id_disciplina=t_disciplina.id_disciplina
				";  
$resultado =  $mysqli->query($consulta);
 while ($fila = $resultado->fetch_array()) {
	$canch=$fila['id_cancha'];
	if ($canch==$id_cancha ) //pregunto si el id_cancha seleccionado en mi primera opcion es parecido al id_cancha obtenido del Query
	{
		$disciplina=$fila['disciplina']; //obtengo el nombre de la disciplina segun su id
		$entrenador=$fila['nombres']." ".$fila['apellidos']; //obtengo el nombre del entrenador				
	}
	else{
		$disciplina="Entrenador";
		$entrenador=" no Disponible";
		}
 	$id_disciplina[$y]=$disciplina." (".$entrenador."),".$fila['dia'].",".$fila['hora_inicio'].",".$fila['cod_clase'];  //almaceno en un vector las disciplinas, dia y hora

	'<br>';
	$y++; //para incrementar de uno en uno y poder crear el vector id_disciplina
	 }
$x=0;  //usado para validar las veces que imprimo la disciplina su valos es 0 false y 1 true
$impar=1; //variable para validar que la tabla ya se haya impreso una si y una no
$cuento_hora_fin=2; //variable para contar el valor en el vector "horas" empezando por el segundo valor
//*******************************************************************

foreach ($horas as $hora) { ?>
	<tr>
<?php    
    if ($impar==1){
		//print "<td rowspan='2'>$hora</td>";
		?>
		<th rowspan='2'>
        	<?php print $hora.'<br>'.'Hasta'.'<br>'. $horas[$cuento_hora_fin]; ?>
		</th>
 <?php
		$impar=2;
	}
	else {
		$impar=1;
	}
	foreach ($sem as $dia) {
		//print "<td>";
		foreach ($id_disciplina as $dep){
			$r = explode(',', $dep);
			
			/*if ($row_clase['hora_inicio']<=$hora and $row_clase['hora_fin']>=$hora)
					  {print "si"; $bg_color="#ccc";}
					else
					  {/*print "no"; $bg_color="#fff";}*/
			
			if ($dia == $r[1] && $hora == $r[2]) 
				{
					
					$cantida_clase= $mysqli->query("SELECT COUNT( * ) AS total, t_horario.hora_inicio FROM t_horario, t_clase 
					WHERE t_horario.cod_clase = t_clase.cod_clase
					AND t_horario.cod_clase =  '$r[3]'
					AND t_horario.dia = '$dia'");
					$total_x_codigo=$cantida_clase->fetch_array();
					$ttxcodigo=$total_x_codigo['total'];
					$hora_dl_count=$total_x_codigo['hora_inicio'];
					
					
					/*print $row_clase['hora_inicio']. " -- " .$r[2]." -- ".$row_clase['hora_fin'];
					print "<br>";*/
					   
					if ($hora_dl_count==$hora)
					{  //condicion para entrar solo una vez a abrir la tabla y hacer el rowspan
					/*********************************************************************/
								$consultobg= $mysqli->query("SELECT hora_inicio, dia FROM t_horario 
					WHERE cod_clase ='$row_clase[cod_clase]'
					AND hora_inicio='$hora' AND dia ='$dia'
					");
			if ($consultobg->fetch_array() ){$bg_color="#ccc";}
			else{$bg_color="#fff";}
					/********************************************************************/
						
						print "<td rowspan='$ttxcodigo' style='background:$bg_color'>";
						print $r[0]; print $r[3];
						
						}
					$x = 1;
                }
        }// fin foreach ($id_disciplina as $dep)
        $diahora="";
		if ($x == 0) 
		{
			$consultobg= $mysqli->query("SELECT hora_inicio, dia FROM t_horario 
					WHERE cod_clase ='$row_clase[cod_clase]'
					AND hora_inicio='$hora' AND dia ='$dia'
					");
			if ($consultobg->fetch_array()){$bg_color="#ccc";}
			else{$bg_color="#fff";}
			/*
			if ($row_clase['hora_inicio']<=$hora and $row_clase['hora_fin']>$hora)
					  {$bg_color="#ccc";}
					else
					  {$bg_color="#fff";}*/
			print "<td style='background:$bg_color'>";
			
			$diahora=$dia.$hora; //almaceno dia y hora de los no impreso
			
        }
            $x = 0;
            print "</td>";
		 }// fin foreach ($id_disciplina as $dep)	
			if ($hora=="11:45:00") //si mi hora de la clase inicio comienza con 11:45 entonces divido el horario (tabla)
			{ ?>
				</tr>
</table>
              <?php
				print "<br>";print "<p align='center'> TURNO TARDE</p>";
				print "<table border='1' width='800' align='center' id='horario'>";
				print"<tr>";
				print "<th>Horas</th>";
				for ($i=0;$i<7;$i++)
				{print "<th width='100'>".$nombre_sem[$i]."</th>";} // nombre de los dias de la semana para el horario
			}       
		 $cuento_hora_fin++;
		 if ($cuento_hora_fin>61){break;$cuento_hora_fin=$cuento_hora_fin-1;}
        print "</tr>";
		
    }
?> 
</table>
</body>
</html>