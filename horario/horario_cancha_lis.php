<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
</head>
<body>
Horario Invividial

<?php
  include ('configuration/conexion.php');
  $link=Conectarse(); 
  $id_cancha=$_GET['id_cancha'];  
  //$_SESSION['id_cancha']=$id_cancha;
  
$consul_hora = "SELECT * FROM t_hora";
$result_hora = mysql_query($consul_hora);
$y=0;
//las horas que van en el horario
 while ($fila_hora = mysql_fetch_assoc($result_hora)) {
	$horas[$y]=$fila_hora['hora'];
	$y++;
 }
$sem = array("lunes", "martes", "miercoles", "jueves", "viernes", "sabado", "domingo"); //las semanas 

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


$id_disciplina=array(); //vector para almacenar nombre de disciplina, dia y hora
$y=0;
Conectarse();
$consulta = "SELECT * FROM t_horario WHERE id_cancha=$id_cancha";  //hago el selec segun la desciplina
$resultado = mysql_query($consulta);
 while ($fila = mysql_fetch_assoc($resultado)) {
	$discip=$fila['id_disciplina'];
	$consul_disc="SELECT * FROM t_disciplina WHERE id_disciplina=$discip";
	$result_disc = mysql_query($consul_disc);
	$fila_disc = mysql_fetch_assoc($result_disc);
	$disciplina=$fila_disc['disciplina']; //obtengo el nombre de la disciplina segun su id
	$id_disciplina[$y]=$disciplina.",".$fila['dia'].",".$fila['hora_inicio'];  //almaceno en un vector las disciplinas, dia y hora
	'<br>';
	$y++;
 }
 $_SESSION["id_disciplina_vector"] = $id_disciplina;
$p=0;
$x=0;
//*******************************************************************
$contar=1;
foreach ($horas as $hora) {
        echo "<tr>";
        echo "<td>$hora</td>";
        foreach ($sem as $dia) {
            echo "<td>";
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
				
				echo "_ ";
            }
			$diahora_vector[$contar]=$diahora;
			$_SESSION["diahora_vector"] = $diahora_vector;
			$contar++;
            $x = 0;
            echo "</td>";
        }
        echo "</tr>";
    }
?> 
</table>
 
</div>
</div>
</body>
</html>
