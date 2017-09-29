<?php
session_start();
include ('configuration/conexion.php');
if (isset($_REQUEST["seleccion"]))
{echo "si";
$seleccion=$_REQUEST["seleccion"];}
else
{
	$seleccion=0;
	echo"no";
}
Conectarse(); 
$consul_hora = "SELECT * FROM t_hora";
$result_hora = mysql_query($consul_hora);
$y=0;
//las horas que van en el horario
 while ($fila_hora = mysql_fetch_assoc($result_hora)) {
	$horas[$y]=$fila_hora['hora'];
	$y++;
 }
$sem = array("lunes", "martes", "miercoles", "jueves", "viernes", "sabado", "domingo"); //las semanas  

if($seleccion==2)
{
$id_instalacion=$_SESSION["id_instalacion"];
$id_cancha=$_SESSION["id_cancha"];
$id_entrenador=$_SESSION["id_entrenador"];
$id_disciplina_selec=$_SESSION["id_disciplina"];
$d="1";
$e="1";
?>
<table width="700" border="1" cellpadding="1">
	<tr>
		    <td>Horas</td>
            <td>Lunes</td>
		    <td>Martes</td>
		    <td>Miercoles</td>
		    <td>Jueves</td>
		    <td>Viernes</td>
		    <td>Sábado</td>
		    <td>Domingo</td>
  </tr>
 
<?php
$id_disciplina=$_SESSION["id_disciplina_vector"];
	foreach ($horas as $hora) {
		 echo "<tr>";
         echo "<td>$hora</td>";
		 foreach ($sem as $dia)
			{   echo "<td>";
				$diahora_val=$dia.$hora;
				//echo $d;
				//echo $diahora_val.":";
				
				foreach ($id_disciplina as $dep)
				{
				$r = explode(',', $dep);
                if ($dia == $r[1] && $hora == $r[2]) 
				{
                    echo $r[0];
                    $x = 1;
                }
	            }
				
			$diahora="";
			if ($x == 0) 
			{
				$diahora=$dia.$hora;
                //echo "<br>".$diahora;
				echo "Libre";
				//echo "<input type='checkbox' name='$diahora' id='$diahora'>";
            }
            $x = 0;

				
				$diahora_vector=$_SESSION["diahora_vector"];
				if ($diahora_val==$diahora_vector[$d])
				 {   // echo $e, $diahora_vector[$d]	;
					$e++;
					if (isset($_REQUEST[$diahora_val]))
					{
					//
					echo "si";
					mysql_query("INSERT INTO t_horario(id_horario, id_instalacion, id_cancha, id_entrenador, id_disciplina, dia, hora_inicio, hora_fin)VALUES('',$id_instalacion,$id_cancha,$id_entrenador,$id_disciplina_selec, '$dia', '$hora', '')");
					// $e	;
					//$e++;
					}
				}
				
				echo '<br>';
				$d++;
				echo '</td>';
			}
		echo '</tr>';
	}
	echo'</table>';
}
?>