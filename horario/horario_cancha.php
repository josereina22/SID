<?php session_start(); ?>
<html>
<head>
<!--meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /-->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="../estilos/horarios.css" media="all" />
<style type="text/css" media="print">
#muestra{page-break-after:always;writing-mode:lr-tb;}
#muestra{color:#FFFFFF;display:none;}
.NomPrint{display:none !important;}
</style>
<script type="text/javascript">
function imprSelec(muestra)
{var ficha=document.getElementById(muestra);var ventimp=window.open(' ','popimpr');ventimp.document.write(ficha.innerHTML);ventimp.document.close();ventimp.print();ventimp.close();}
</script>
</head>
<body>
<a href="javascript:imprSelec('muestra')">Imprimir Horario</a>
<div id="muestra"> 
<?php
include ('../configuration/conexion.php');
Conectarse();
$usuario=$_SESSION['usu']; 
if (isset($_GET['id_cancha']))
{
	$id_cancha=$_GET['id_cancha'];
	$sql="SELECT * FROM t_cancha, t_instalacion WHERE id_cancha=$id_cancha AND t_cancha.id_instalacion=t_instalacion.id_instalacion";
	$consulta=mysql_query($sql);
	$fila=mysql_fetch_assoc($consulta);
}
//Hora Para Armar el Horarios almacedanas en la Base de Datos
$consul_hora = "SELECT * FROM t_hora";
$result_hora = mysql_query($consul_hora);
$y=0;
while ($fila_hora = mysql_fetch_assoc($result_hora)) {
	$horas[$y]=$fila_hora['hora'];
	$y++;
 }
//Los dias de la semana que van en el horario 
$consul_sem = "SELECT * FROM t_semana";
$result_sem = mysql_query($consul_sem);
$y=0;
while ($fila_sem= mysql_fetch_assoc($result_sem)) {
	$sem[$y]=$fila_sem['abv_semana'];
	$nombre_sem[$y]=$fila_sem['semana'];
	$y++;
 }
?>
<p align="center"> <strong><?php print $fila['instalacion']." - ".$fila['cancha'];?></strong></p>
<p align="center"> Turno Ma&ntilde;ana </p>
<table width="800" border="1" cellpadding="1" align="center" id="horario">
	<tr>
		    <th>Horas</th>
            <?php for ($i=0;$i<=6;$i++)
				{print "<th width='100'>".$nombre_sem[$i]."</th>";} // nombre de los dias de la semana para el horario
			?>
  	</tr>
<?php
$consulta =    "SELECT t_entrenador.id_entrenador, nombres, apellidos, id_cancha, t_disciplina.id_disciplina, 
						t_disciplina.disciplina, dia, t_horario.hora_inicio, t_clase.cod_clase
				FROM t_clase, t_horario, t_entrenador, t_disciplina
				WHERE t_clase.cod_clase = t_horario.cod_clase
				AND t_clase.id_entrenador = t_entrenador.id_entrenador
				AND t_clase.id_disciplina=t_disciplina.id_disciplina
				AND t_clase.id_cancha='$id_cancha'";
				  //hago el selec segun la cancha
$resultado = mysql_query($consulta);
$y=0;
 while ($fila = mysql_fetch_assoc($resultado)) {
	$canch=$fila['id_cancha'];

		$disciplina=$fila['disciplina']; //obtengo el nombre de la disciplina segun su id
		$entrenador=$fila['nombres']." ".$fila['apellidos']; //obtengo el nombre del entrenador				

 	$codigo_almacenado[$y]=$fila['cod_clase'];
	$id_disciplina[$y]=$disciplina." (".$entrenador."),".$fila['dia'].",".$fila['hora_inicio'].",".$fila['cod_clase'];  //almaceno en un vector las disciplinas, dia y hora
	'<br>';
	$y++;
	
 }
$cuento_hora_fin=2; //variable para contar el valor en el vector "horas" empezando por el segundo valor
$x=0;  //usado para validar las veces que imprimo la disciplina su valos es 0 false y 1 true
$impar=1;
$ultimo=1; //ultimo registro para dividir horario
foreach ($horas as $hora) {
	print "<tr>";
	if ($impar==1){
		print "<th rowspan='2'>$hora".'<br>'.'Hasta'.'<br>'. $horas[$cuento_hora_fin]  ."</th>";
		}
		if ($impar==2)
		{$impar=0;}
		$impar++;
        foreach ($sem as $dia) {
            foreach ($id_disciplina as $dep)
			{
				$r = explode(',', $dep);
                if ($dia == $r[1] && $hora == $r[2]) 
				{
					$cantida_clase=mysql_query("SELECT COUNT( * ) AS total, t_horario.hora_inicio FROM t_horario, t_clase 
					WHERE t_horario.cod_clase = t_clase.cod_clase
					AND t_horario.cod_clase =  '$r[3]'
					AND t_horario.dia = '$dia'");
					$total_x_codigo=mysql_fetch_array($cantida_clase);
					$ttxcodigo=$total_x_codigo['total'];
					$hora_dl_count=$total_x_codigo['hora_inicio'];
					if ($hora_dl_count==$hora){  //condicion para entrar solo una vez a abrir la tabla y hacer el rowspan
						print "<td rowspan=$ttxcodigo>";
						print $r[0];print "<BR>";print $r[3];
						}					
                    $x = 1;					
                }
				
            }
            //$diahora="";
			if ($x == 0) 
			{
				print "<td rowspan=1>";
				 //$diahora=$dia.$hora;		
            }
			print "</td>";
            $x = 0;
        }// fin foreach ($id_disciplina as $dep)	
		if ($hora=="11:45:00") //si mi hora de la clase inicio comienza con 11:45 entonces divido el horario (tabla)
		{
					 print "</tr>";
					 print "</table>";
					 print "<br>";print "<br>";
			print "<p align='center'> Turno Tarde </p>";
				print "<table width='800' border='1' cellpadding='1' align='center' id='horario'>";
				print"<tr>";
				print "<th>Horas</th>";
				for ($i=0;$i<=6;$i++)
				{print "<th width='100'>".$nombre_sem[$i]."</th>";} // nombre de los dias de la semana para el horario
			  	print"</tr>";
			  
				
		}
		
		 $cuento_hora_fin++;
		 if ($cuento_hora_fin>61){break;$cuento_hora_fin=$cuento_hora_fin-1;}
        print "</tr>";
		
    }
print"</table>";
//header("location: clases.php?mensaje=1");
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>
</div>
</body>
</html>