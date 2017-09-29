<?php
session_start(); 
setlocale(LC_TIME, 'es_VE'); # Localiza en español es_Venezuela
date_default_timezone_set('America/Caracas');
include("../configuration/conexion.php");
Conectarse();
if (isset($_REQUEST["seleccion"]))
 { $seleccion=$_REQUEST["seleccion"];}
else
 {$seleccion=0;}

$disabled="";	

// Establecer el idioma al Español para strftime().
//setlocale( LC_TIME, 'spanish' );
// Si no se ha seleccionado mes, ponemos el actual y el año
$month = isset($_GET['month'])?$_GET['month']:date('Y-n');

$week = 1;
$dia_numero=date('d');//hoy
for ( $i=1;$i<=date( 't', strtotime( $month ) );$i++ ) 
{
	$day_week = date( 'N', strtotime( $month.'-'.$i )  );	
	$calendar[ $week ][ $day_week ] = $i;
	if ( $day_week == 7 )
		{$week++;}
}
?>
<!DOCTYPE html>
<html>
<head>
<!--meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /-->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="../estilos/formularios.css" media="all" />
</head>
<body>
<p>
 <?php
/////////////////////////////////////////////////////////////////////////////////////////////// 
$i=1;
if (isset($_GET['cod_clase'])){
$cod_clase=($_GET['cod_clase']);
$query="SELECT * FROM t_entrenador, t_clase, t_disciplina, t_instalacion, t_cancha, t_horario 
			WHERE t_clase.cod_clase='$cod_clase'
			AND t_entrenador.id_entrenador=t_clase.id_entrenador
			AND t_disciplina.id_disciplina=t_clase.id_disciplina
			AND t_instalacion.id_instalacion=t_clase.id_instalacion
			AND t_cancha.id_cancha=t_clase.id_cancha
			AND t_horario.cod_clase=t_clase.cod_clase
			GROUP BY t_horario.cod_clase";
$consul=mysql_query($query);
$row=mysql_fetch_array($consul);
//break;
$dia_semana=array('','LU','MA','MI','JU','VI','SA','DO');?>
</p>
<div  class="form" style="width:700px;">
<table width="700" border="0" cellpadding="1" align="center">
  <tr>
    <td width="90"></td>
    <td width="193"></td>
    <td width="188"><?php print ($cod_clase);?></td>
    <td width="58">&nbsp;</td>
    <td width="149">&nbsp;</td>
  </tr>
  <tr>
    <th><div align="left">Disciplina:</div></th>
    <td><?php print $row['disciplina'];?></td>
    <td rowspan="4">&nbsp;</td>
    <th><div align="left">D&iacute;as</div></th>
    <td><?php print $row['semanas'];?></td>
  </tr>
  <tr>
    <th><div align="left">Instalaci&oacute;n:&nbsp;</div></th>
    <td><?php print $row['instalacion'];?></td>
    <th><div align="left">Horario:</div></th>
    <td><?php print $row['hora_inicio']." a ". $row['hora_fin'];?></td>
  </tr>
  <tr>
    <th><div align="left">Cancha:</div></th>
    <td><?php print $row['cancha'];?></td>
    <th><div align="left">Edad:&nbsp;</div></th>
    <td><?php print $row['edad_min']." a ".$row['edad_max'];?></td>
  </tr>
  <tr>
    <th><div align="left">Entrenador:&nbsp;</div></th>
    <td><?php print $row['nombres']." ".$row['nombres'];?></td>
    <th><div align="left">Sexo:&nbsp;</div></th>
    <td><?php if ($row["sexo"]==1)print"Masculino"; elseif ($row["sexo"]==2)print"Femenino"; elseif ($row["sexo"]==3)print"Mixto";?></td>
  </tr>
</table>
</div>
<table border="0"  align="center">
	
	<thead>
		<tr>
        	<td colspan="34">
			<table width="322" border="0" style="border-radius:10px;" bgcolor="#CCCCCC" align="center">
            	<tr>
                	<td width="124" colspan="">
            
			<?php
			 $anterior=substr($month,0,4)."-".(substr($month,5,2)-1);
			?>
            <a href="clase_entrenador.php?cod_clase=<?php echo $cod_clase?>&month=<?php 
			if (substr($month,5,2)<2){
				print $anterior=(substr($month,0,4)-1)."-12";} 
			else{
				print $anterior;}?>">Mes Anterior<img src="../imagenes/anterior.png" width="32" height="32"></a>
                
			<?php
			$siguiente=substr($month,0,4)."-".(substr($month,5,2)+1);
			?>
            		</td>
            		<td width="30">
                    </td>
                    <td width="124">
            <a href="clase_entrenador.php?cod_clase=<?php echo $cod_clase?>&month=<?php 
			if (substr($siguiente,5,2)>12){
				print $siguiente=(substr($month,0,4)+1)."-1";}
			else{
				print $siguiente;}?>"><img src="../imagenes/siguiente.png" width="32" height="32">Mes Sigiuiente</a>    
            		</td>
            	</tr>
            </table><div align="right"><a href="../reportes/pdf_asistencias.php?cod_clase=<?php echo $cod_clase?>&month=<?php echo $month?>" target="_blank">Imprimir</a> </div>
           </td>
		</tr>
		<tr bgcolor="#6594D1">
        
        <th colspan="3"><?php echo strtoupper(strftime( '%B %Y', strtotime( $month ))); 
		$mes_ano=strtoupper(strftime( '%B %Y', strtotime( $month ))); //para poner el mes que esta seleccionado y el año
		$_SESSION['mes_ano']=$mes_ano;
		?></th>
    	<?php foreach ( $calendar as $days ) : ?>
		
			<?php for ( $i=1;$i<=7;$i++ ) : 
					if (isset($days[$i])){
						?>
			<th>
				<?php
					print $dia_semana[$i];
				?>
			</th>
			<?php	
					}
				 endfor; ?>
		
		<?php endforeach; ?>
        <td></td>		
		</tr>	
  </thead>
    <tbody bgcolor="#CCCCCC">
    <tr bgcolor="#6594D1">
       <th>Nro.</th>
       <th>Carnet</th>
       <th>
		<?php 
	 	print "Nombres y Apellidos";
		print '</th>'; 
		foreach ( $calendar as $days ) : ?>
			<?php for ( $i=1;$i<=7;$i++ ) : 
				if (isset($days[$i])){
					$dias_mes=isset( $days[ $i ] ) ? $days[ $i ] : ''; 
			?>		
	  <th>
		<?php print $dias_mes;?>
	  </th>	
			<?php
        }
		endfor; ?>
		<?php endforeach; ?>
      <th>Rep</th>
	</tr>

<form action="clase_entrenador.php" method="post">
  
<?php
$SQL="SELECT t_deportista.id_deportista, t_deportista.nombres, t_deportista.apellidos, semanas FROM t_deportista, t_entrenador, t_clase, t_inscrito
	 WHERE t_clase.cod_clase='$cod_clase'
	 AND t_entrenador.id_entrenador=t_clase.id_entrenador
	 AND t_inscrito.cod_clase=t_clase.cod_clase
	 AND t_deportista.id_deportista=t_inscrito.id_deportista
	 AND t_inscrito.estatus=1
	 ";	 

header('Content-Type: text/html; charset=ISO-9881');			
$consulta=mysql_query($SQL);
$tt_alumnos=0;
while ($fila=mysql_fetch_assoc($consulta)){	
?>	<tr>
	<td><?print $tt_alumnos + 1; print " ) "; ?> </td>
    <td><?php print $id_deportista=$fila["id_deportista"];?></td>
    <td><?php print $fila["nombres"]." ".$fila["apellidos"];?></td>
<?php
	 foreach ( $calendar as $days ) : 
		for ( $i=1;$i<=7;$i++ ) : 
			if (isset($days[$i])){
				$dias_mes=isset( $days[ $i ] ) ? $days[ $i ] : ''; 
				/*if ($dias_mes==$dia_numero){?><td bgcolor="#D8EB98"> <?php }else{?> <td> <?php }*/ 
				/*print $dia_semana[$i]; print $fila['semanas'];*/
				if ($dia_semana[$i]==substr($fila['semanas'],0,2) or $dia_semana[$i]==substr($fila['semanas'],3,2)or $dia_semana[$i]==substr($fila['semanas'],6,2) or $dia_semana[$i]==substr($fila['semanas'],9,2) or $dia_semana[$i]==substr($fila['semanas'],12,2)or $dia_semana[$i]==substr($fila['semanas'],15,2)or $dia_semana[$i]==substr($fila['semanas'],18,2))  
				{//print "<td bgcolor='#D8EB98'>";
					$color_columna="#D8EB98";
					$disabled="";
				}
				else{//print "<td>";
				$color_columna="";
				$disabled="disabled";
				}
				
				print "<td bgcolor=$color_columna>";
				
				if ($dias_mes<10){$dias_mes="0".$dias_mes;}else {$dias_mes;}
				
				$fecha=strtoupper(strftime( '%Y-%m', strtotime( $month )))."-".$dias_mes; // segun el mes seleccionado
				//print $fecha=strftime('%Y')."-".strftime('%m')."-".$dias_mes;
				 $check= $id_deportista.$dia_semana[$i].$fecha; //1VI2015-05-01
				/*print $cod_clase;
				print "<BR>";
				print $id_deportista;
				print "<BR>";
				print $fecha;
				print "<BR>";
				print $dia_semana[$i];
				print "<BR>";*/
				if (($month==date('Y-n')) or ($month==date('Y')."-".(date('n')-1)))
				{"NO HAGO NADA";}
				else {$disabled="disabled";}
				/*print $month;
				print "<BR>";
				print date('Y-n');
				print "<BR>";
				print date('Y')."-".(date('n')-1);*/
				$resul_asis= mysql_query("SELECT * FROM t_asistencia  WHERE cod_clase='$cod_clase' AND id_deportista='$id_deportista' AND fecha='$fecha' AND dia='$dia_semana[$i]'");
				if (($month==date('Y-n')) or ($month==date('Y')."-".(date('n')-1)))
				{//$disabled="";
				}
				else {$disabled="disabled";}
				if(!mysql_num_rows($resul_asis)==0){ ?>
				<input type='checkbox' name="<?php print $check;?>" id="<?php print $check;?>" checked <?php print $disabled ?>>
			<?php
				}
				else{
			?>
               	<input type='checkbox' name="<?php print $check;?>" id="<?php print $check;?>" <?php print $disabled ?>>
			</td>	
			<?php
				}
            }
			endfor; ?>
		<?php endforeach; ?>
        <?PHP if (($month==date('Y-n')) or ($month==date('Y')."-".(date('n')-1)))
				{$disabled="";
				}
				else {$disabled="disabled";}
		?>
      <td bgcolor="#00FF00"><?php  $check=$id_deportista."rep".strftime('%Y')."-".strftime('%m')."-00";
	  						$fecha_rep=strtoupper(strftime( '%Y-%m', strtotime( $month )))."-00";
							$_SESSION['fecha_rep']=$fecha_rep; //PARA LLEVAME EL AÑO Y MES PARA seleccion1
							//print $month;
	  						//print $fecha_rep=strftime('%Y')."-".strftime('%m')."-00";
							$resul_asis= mysql_query("SELECT * FROM t_asistencia  WHERE cod_clase='$cod_clase' AND id_deportista='$id_deportista' AND fecha='$fecha_rep' AND dia='MES'");
					if(!mysql_num_rows($resul_asis)==0){ ?>
                		<input type='checkbox' name="<?php print $check;?>" id="<?php print $check;?>"  checked <?php print $disabled ?>
					<?php }	
					else{?>
                    	<input type='checkbox' name="<?php print $check;?>" id="<?php print $check;?>" <?php print $disabled ?>
                    <?php }?>
       </td>
	</tr>
	
<?php
$tt_alumnos++;
}
?>

</table>
<input name="cod_clase" type="hidden" id="cod_clase" value="<?php print $cod_clase;?>">
<input name="seleccion" type="hidden" id="seleccion" value="1">
<input name="month" type="hidden" id="month" value="<?php print $month ?>">
<p align="center"><input type="submit" name="bt_crear" id="bt_crear" value="Actualizar" <?php print $disabled ?>>
<p align="center">
</form>
<?php
print "El Total de Alumnos para esta Clases ".$tt_alumnos;
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>
</p>

<?php
if($seleccion==1)
{
///////////////////////////////////////////////////////////////////////	
print $month = $_POST['month'];
$week = 1;
$dia_numero=date('d');//hoy
for ( $i=1;$i<=date( 't', strtotime( $month ) );$i++ ) 
{
	
	$day_week = date( 'N', strtotime( $month.'-'.$i )  );
	
	$calendar[ $week ][ $day_week ] = $i;
	if ( $day_week == 7 )
		$week++;
}
/////////////////////////////////////////////////////////////////////
$cod_clase=$_POST['cod_clase'];
$query="SELECT * FROM t_entrenador, t_clase, t_disciplina, t_instalacion, t_cancha, t_horario 
			WHERE t_clase.cod_clase='$cod_clase'
			AND t_entrenador.id_entrenador=t_clase.id_entrenador
			AND t_disciplina.id_disciplina=t_clase.id_disciplina
			AND t_instalacion.id_instalacion=t_clase.id_instalacion
			AND t_cancha.id_cancha=t_clase.id_cancha
			AND t_horario.cod_clase=t_clase.cod_clase
			GROUP BY t_horario.cod_clase";
$consul=mysql_query($query);
$row=mysql_fetch_array($consul);
//break;
$dia_semana=array('','LU','MA','MI','JU','VI','SA','DO');?>
<table width="700" border="0" cellpadding="1" align="center" bgcolor="#6594D1">
  <tr>
    <td width="90"></td>
    <td width="162"></td>
    <td width="219"><?php print ($cod_clase);?></td>
    <td width="58">&nbsp;</td>
    <td width="149">&nbsp;</td>
  </tr>
  <tr>
    <td>Disciplina:</td>
    <td><?php print $row['disciplina'];?></td>
    <td rowspan="4">&nbsp;</td>
    <td>D&iacute;as</td>
    <td><?php print $row['semanas'];?></td>
  </tr>
  <tr>
    <td>Instalaci&oacute;n:&nbsp;</td>
    <td><?php print $row['instalacion'];?></td>
    <td>Horario:</td>
    <td><?php print $row['hora_inicio']." a ". $row['hora_fin'];?></td>
  </tr>
  <tr>
    <td>Cancha:</td>
    <td><?php print $row['cancha'];?></td>
    <td>Edad:&nbsp;</td>
    <td><?php print $row['edad_min']." a ".$row['edad_max'];?></td>
  </tr>
  <tr>
    <td>Entrenador:&nbsp;</td>
    <td><?php print $row['nombres']." ".$row['nombres'];?></td>
    <td>Sexo:&nbsp;</td>
    <td><?php if ($row["sexo"]==1)print"Masculino"; elseif ($row["sexo"]==2)print"Femenino"; elseif ($row["sexo"]==3)print"Mixto";?></td>

  </tr>
</table>
<table border="1"  align="center">
	
	<thead>
		<tr>
			<td colspan="34">
        	<table width="322" border="1">
            	<tr>
                	<td width="124" colspan="">
            
			<?php
			 $anterior=substr($month,0,4)."-".(substr($month,5,2)-1);
			?>
            <a href="clase_entrenador.php?cod_clase=<?php echo $cod_clase?>&month=<?php 
			if (substr($month,5,2)<2){
				print $anterior=(substr($month,0,4)-1)."-12";} 
			else{
				print $anterior;}?>">Mes Anterior</a>
                
			<?php
			$siguiente=substr($month,0,4)."-".(substr($month,5,2)+1);
			?>
            		</td>
            		<td width="56">
                    </td>
                    <td width="120">
            <a href="clase_entrenador.php?cod_clase=<?php echo $cod_clase?>&month=<?php 
			if (substr($siguiente,5,2)>12){
				print $siguiente=(substr($month,0,4)+1)."-1";}
			else{
				print $siguiente;}?>">Mes Sigiuiente</a>    
            		</td>
            	</tr>
            </table>
          </td>
		</tr>
		<tr bgcolor="#6594D1">
        <td></td>
        <td><?php
		 echo strtoupper(strftime( '%B %Y', strtotime( $month ))); ?></td>
    	<?php foreach ( $calendar as $days ) : ?>
		
			<?php for ( $i=1;$i<=7;$i++ ) : 
					if (isset($days[$i])){
						?>
			<td>
				<?php
					print $dia_semana[$i];
				?>
			</td>
			<?php	
					}
				 endfor; ?>
		
		<?php endforeach; ?>
        <td></td>		
		</tr>	
  </thead>
    <tbody bgcolor="#CCCCCC">
    <tr bgcolor="#6594D1">
       <td>#</td>
       <td>
		<?php 
	 	print "Nombres y Apellidos";
		print '</td>'; 
		foreach ( $calendar as $days ) : ?>
			<?php for ( $i=1;$i<=7;$i++ ) : 
				if (isset($days[$i])){
					$dias_mes=isset( $days[ $i ] ) ? $days[ $i ] : ''; 
			?>		
	  <td>
		<?php print $dias_mes;?>
	  </td>	
			<?php
        }
		endfor; ?>
		<?php endforeach; ?>
      <td>Rep</td>
	</tr>

<form action="clase_entrenador.php" method="post">
  
<?php
$SQL="SELECT t_deportista.id_deportista, t_deportista.nombres, t_deportista.apellidos FROM t_deportista, t_entrenador, t_clase, t_inscrito
	 WHERE t_clase.cod_clase='$cod_clase'
	 AND t_entrenador.id_entrenador=t_clase.id_entrenador
	 AND t_inscrito.cod_clase=t_clase.cod_clase
	 AND t_deportista.id_deportista=t_inscrito.id_deportista
	 AND t_inscrito.estatus=1
	 ";	 

			
$consulta=mysql_query($SQL);
$tt_alumnos=0;
	//$año_mes=strftime('%Y')."-".strftime('%m'); //del equipo
	$fecha_rep=$_SESSION['fecha_rep']; //fecha segun la seleccion 
	$año_mes=strftime('%Y-%m', strtotime(substr($fecha_rep,0,7))); //año mes para el delete
	 //echo strtoupper(strftime( '%B %Y', strtotime( $month ))); //mes en letra año actual
	mysql_query ("DELETE FROM t_asistencia  WHERE cod_clase='$cod_clase' AND fecha LIKE '$año_mes%'");
while ($fila=mysql_fetch_assoc($consulta)){	
?>	<tr>
    <td><?php print $id_deportista=$fila["id_deportista"];?></td>
    <td><?php print ($fila["nombres"])." ".$fila["apellidos"];?> </td>
<?php
	 foreach ( $calendar as $days ) : 
		for ( $i=1;$i<=7;$i++ ) : 
			if (isset($days[$i])){
				$dias_mes=isset( $days[ $i ] ) ? $days[ $i ] : ''; 
				if ($dias_mes==$dia_numero){
			?>		
            		<td bgcolor="#D8EB98">
			<?php
					}else{?>
                    <td>
			<?php 
					}
				if ($dias_mes<10){$dias_mes="0".$dias_mes;}
				else {$dias_mes;}
				$month=substr($fecha_rep,0,7);
				$fecha=strtoupper(strftime( '%Y-%m', strtotime( $month )))."-".$dias_mes;
				//print $cod_clase;
				print $check= $id_deportista.$dia_semana[$i].$fecha;
				 
				 
				 //print $fecha_rep=strtoupper(strftime( '%Y-%m', strtotime( $month )));  //mismo que el de abajo
				  $año_mes."-00"; 													//mismo que el de arriba
				if (isset($_REQUEST[$check])){
					mysql_query("INSERT INTO t_asistencia (cod_clase, id_deportista, fecha, dia) VALUES('$cod_clase', '$id_deportista', '$año_mes-$dias_mes', '$dia_semana[$i]')");
					//print "si";
					?>
					<input type='checkbox' name="<?php print $check;?>" id="<?php print $check;?>" checked>
					<?php 
					}
				else{
					//print ("DELETE FROM t_asistencia  WHERE cod_clase='$cod_clase' AND id_deportista='$id_deportista' AND fecha='$fecha' AND dia='$dia_semana[$i]'");
					
					//print "NO";
					?>
					<input type='checkbox' name="<?php print $check;?>" id="<?php print $check;?>">
					<?php
					}
				//mysql_query ("INSERT INTO t_asistencia (id_deportista, cod_clase, fecha, dia) VALUES('$id_deportista','$cod_clase', $fecha, $dia_semana[$i]");
				//print "<input type='checkbox' name='$id_deportista.$dias_mes' id='$id_deportista.$dias_mes'>";
				?>
					</td>	
			<?php
            	}
			endfor; ?>
		<?php endforeach; ?>
  	<td bgcolor="#00FF00">
		<?php
		$check=$id_deportista."rep".strftime('%Y')."-".strftime('%m')."-00";
		print $fecha_rep=strtoupper(strftime( '%Y-%m', strtotime( $month )))."-00";
		//$fecha_rep=strftime('%Y')."-".strftime('%m')."-00";
		if (isset($_REQUEST[$check])){
					mysql_query("INSERT INTO t_asistencia (cod_clase, id_deportista, fecha, dia) VALUES('$cod_clase', '$id_deportista', '$fecha_rep', 'MES')");
					//print "si";
					?><input type='checkbox' name="<?php print $check;?>" id="<?php print $check;?>" checked><?php
					}
				else{
					mysql_query("DELETE FROM t_asistencia  WHERE cod_clase='$cod_clase' AND id_deportista='$id_deportista' AND fecha='$fecha_rep' AND dia='MES'");
					//print "NO";
					?> <input type='checkbox' name="<?php print $check;?>" id="<?php print $check;?>"> <?php
					}
		 ?>
   	</td>
	</tr>
	
<?php
$tt_alumnos++;
}
?>

</table>
<input name="seleccion" type="hidden" id="seleccion" value="1">
<input name="cod_clase" type="hidden" id="cod_clase" value="<?php print $cod_clase;?>">
<p align="center"><input type="submit" name="bt_crear" id="bt_crear" value="Crear">
<p align="center">
</form>
<?php
print "El Total de Alumnos para esta Clases ".$tt_alumnos;
print $month=substr($month,0,4)."-".(substr($month,5,2)+0);
//

if (headers_sent()){ ?>
	<script type="text/javascript">
        window.location.href="clase_entrenador.php?cod_clase=<?php echo $cod_clase ?>&month=<?php print $month ?>";
        //"'.$filename.'";';
    </script>;

<?php
    }

}
?>
</body>
</html>