<?php
// Establecer el idioma al Español para strftime().
setlocale( LC_TIME, 'spanish' );
// Si no se ha seleccionado mes, ponemos el actual y el año
$month = isset($_GET['month'])?$_GET['month']:date('Y-n');
$week = 1;
$dia_numero=date('d');//hoy
for ( $i=1;$i<=date( 't', strtotime( $month ) );$i++ ) {
	
	$day_week = date( 'N', strtotime( $month.'-'.$i )  );
	
	$calendar[ $week ][ $day_week ] = $i;
	if ( $day_week == 7 )
		$week++;
	
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Calendario PHP/HTML5</title>
<style type="text/css">
	table { margin: auto; }
</style>
</head>
<body>
<?php 
$dia_semana=array('','LU','MA','MI','JU','VI','SA','DO');?>
<table border="1" >
	
	<thead>
		<tr>
			<td colspan="31">Por ahora nada</td>
		</tr>
		<tr bgcolor="#9BCAF9">
        <td><?php echo strtoupper(strftime( '%B %Y', strtotime( $month ))); ?></td>
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
		</tr>			
	</thead>
    <tbody bgcolor="#CCCCCC">
	
    <tr bgcolor="#9BCAF9">
    	<?php
		
		?>
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
			<?php 
	
				print $dias_mes;
				
				?>
			</td>	
			<?php
            	}
			endfor; ?>
		<?php endforeach; ?>
	</tr>
    
    
    <tr>
    	<?php
		for ($tutu=1; $tutu<=10; $tutu++){
		?>
          <td>
		<?php 
		 	print "Jose ".$tutu;
		print '</td>'; 
		 foreach ( $calendar as $days ) : ?>
		
			<?php for ( $i=1;$i<=7;$i++ ) : 
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
				//print $tutu.$dias_mes;
				echo "<input type='checkbox' name='$tutu.$dias_mes' id='$tutu.$dias_mes'>";
				?>
			</td>	
			<?php
            	}
			endfor; ?>
		<?php endforeach; ?>
	</tr>
    <?php } //cierro el for tutu?>
    </tbody>
	<tfoot>
	<tr>
		<td colspan="7">
		<form method="get">
			<input type="month" name="month">
			<input type="submit">
		</form>					
		</td>
	</tr>
	</tfoot>
</table>

</body>
</html>
