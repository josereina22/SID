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
?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="horarios/select_dependientes.css">
<script type="text/javascript" src="horarios/select_dependientes.js"></script>
<script type="text/javascript"> 
function valida_envia_iced(){
    //valido la direccion
    if (document.form_iced.id_instalacion.selectedIndex==0){
       alert("Debe seleccionar una Instalación.");
       document.form_iced.id_instalacion.focus();
       return false;
    }
	if (document.form_iced.id_cancha.selectedIndex==0){
       alert("Debe seleccionar una Cancha.");
       document.form_iced.id_cancha.focus();
       return false;
    }
	if (document.form_iced.id_entrenador.selectedIndex==0){
       alert("Debe seleccionar un Entrenador.");
       document.form_iced.id_entrenador.focus();
       return false;
    }
	if (document.form_iced.id_disciplina.selectedIndex==0){
       alert("Debe seleccionar una Disciplina.");
       document.form_iced.id_disciplina.focus();
       return false;
    }
}

function enviar_formulario(){
   document.form_iced.button()
} 
</script>
</head>
<body>
<form onSubmit="return valida_envia_iced()" action="horario_cancha.php" method="post" name="form_iced">
  <table width="700" border="1" cellpadding="1">
    <tr>
      <td colspan="4"> Horario de la cancha
      </td>
     </tr>
    <tr>
      <td>Instalación
        <select name="id_instalacion" id="id_instalacion" onChange='cargaContenido(this.id)'>
          <option value="0" selected="selected">Seleccione</option>
          <?php
             
			 Conectarse(); 
			 $consulta = "SELECT * FROM t_instalacion";
             $resultado = mysql_query($consulta);
             while ($fila = mysql_fetch_assoc($resultado)) {
         ?>
          <option value=<?php echo $fila['id_instalacion']; if(empty($_POST['id_instalacion'])){?> selected='selected' <?php } ?>> <?php echo $fila['instalacion']?></option>
          <?php } //cierro el While?>
      </select></td>
      <td><label>Cancha</label>
        <select disabled="disabled" name="id_cancha" id="id_cancha">
		  <option value ="-">Selecciona Opci&oacute;n...
		  </select> 
      </td>
      <td>Entrenador
        <select name="id_entrenador" id="id_entrenador">
          <option value="" selected="selected">Seleccione</option>
          <?php
			 $consulta = "SELECT * FROM t_entrenador";
             $resultado = mysql_query($consulta);
             while ($fila = mysql_fetch_assoc($resultado)) {
         ?>
          <option value=<?php echo $fila['id_entrenador']?>> <?php echo $fila['nombres']?></option>
          <?php } //cierro el While?>
      </select></td>
      <td>Disciplina:
<select name="id_disciplina" id="id_disciplina">
        <option value="" selected="selected">Seleccione</option>
        <?php
			 $consulta = "SELECT * FROM t_disciplina";
             $resultado = mysql_query($consulta);
             while ($fila = mysql_fetch_assoc($resultado)) {
         ?>
        <option value=<?php echo $fila['id_disciplina']?>> <?php echo $fila['disciplina']?></option>
        <?php } //cierro el While?>
      </select></td>
    </tr>

    <tr>
      <td colspan="4"><input type="submit" name="button" id="button" value="Enviar">
      <input name="seleccion" type="hidden" id="seleccion" value="1"></td>
    </tr>
</table>
</form>
<p>&nbsp; </p>


<?php
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


if($seleccion==1)
{
	$id_instalacion=$_POST['id_instalacion'];
	$id_cancha=$_POST['id_cancha'];
	$id_entrenador=$_POST['id_entrenador'];
	$id_disciplina_selec=$_POST['id_disciplina'];
	$_SESSION["id_instalacion"] = $id_instalacion;
	$_SESSION["id_cancha"] = $id_cancha;
	$_SESSION["id_entrenador"] = $id_entrenador;
	$_SESSION["id_disciplina"] = $id_disciplina_selec;
?>

<form action="horario_cancha.php" method="post">
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
				
				echo "<input type='checkbox' name='$diahora' id='$diahora'>";
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
<input type="submit" name="button1" id="button1" value="Enviar">
<input name="seleccion" type="hidden" id="seleccion" value="2">
</form>

<?php
} //cierro el if del boton1
?>

<?php
if($seleccion==2)
{
$id_instalacion=$_SESSION["id_instalacion"];
$id_cancha=$_SESSION["id_cancha"];
$id_entrenador=$_SESSION["id_entrenador"];
$id_disciplina_selec=$_SESSION["id_disciplina"];
$d="1";
$e="1";
?>
<table width="700" border="1" cellpadding="1" hidden="false">
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
$x=0;
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
				//echo "Libre";
				//$opcion= "<input type='checkbox' name='$diahora' id='$diahora'>";
				
            }
            $x = 0;

				
				$diahora_vector=$_SESSION["diahora_vector"];
				if ($diahora_val==$diahora_vector[$d])
				 {   // echo $e, $diahora_vector[$d]	;
					$e++;
					if (isset($_REQUEST[$diahora_val]))
					{
						mysql_query("INSERT INTO t_horario(id_instalacion, id_cancha, id_entrenador, id_disciplina, dia, hora_inicio, hora_fin)VALUES($id_instalacion,$id_cancha,$id_entrenador,$id_disciplina_selec, '$dia', '$hora', '')");
							
					}
					else
					{
						echo "<input type='checkbox' name='$diahora' id='$diahora'>";
					}
				}
				
				echo '<br>';
				$d++;
				echo '</td>';
			}
		echo '</tr>';
	}
	
	echo'</table>';
	header("location: consulta_horarios.php?mensaje=1");	
}
?>


</body>
</html>