<?php
session_start();
require('../fpdf17/fpdf.php'); 
if(isset($_GET['cod_clase'])){
	include ('../configuration/conexion.php');
	Conectarse();
	$cod_clase=$_GET['cod_clase'];
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


class PDF extends FPDF 
{
  function Header() //Encabezado
    {
        global $title;
		//$this->Line(10,35.5,206,35.5);
        $this->Image('chacao.png',8,5,25);
        // Arial bold 9
		$this->SetFont('Arial','B',10);
		$this->SetTextColor(41,97,169);
		$this->Cell(180,25,utf8_decode('Asistencia'),0,0,'C');
    }
	
	function clase($datos)
    { $this->SetXY(10, 30);
        $this->SetFont('Arial','B',9);
       // $this->SetFillColor(2,157,116);//Fondo verde de celda
        $this->SetTextColor(0, 0, 0); //Letra color blanco
		$this->SetDrawColor(255,255,255);
        foreach($datos as $columna)
        {
            //Parámetro con valor 2, hace que la cabecera sea vertical
            $this->Cell(180,4, utf8_decode($columna),1, 2 , 'C');
        }
	}
	
	function TituloClase($cabecera)
    {
        $this->SetXY(10, 37);
        $this->SetFont('Arial','B',9);
       // $this->SetFillColor(2,157,116);//Fondo verde de celda
        $this->SetTextColor(0, 0, 0); //Letra color blanco
		$this->SetDrawColor(255,255,255);
        foreach($cabecera as $columna)
        {
            //Parámetro con valor 2, hace que la cabecera sea vertical
            $this->Cell(40,4, utf8_decode($columna),1, 2 , 'L');
        }
    }	
	
	function DatosClase($datos)
    {
        $this->SetXY(35, 37); //40 = 10 posiciónX_anterior + 30ancho Celdas de cabecera
        $this->SetFont('Arial','',9); //Fuente, Normal, tamaño
        $this->SetFillColor(229, 229, 229); //Gris tenue de cada fila
        $this->SetTextColor(3, 3, 3); //Color del texto: Negro
		$this->SetDrawColor(255,255,255);
		foreach($datos as $columna)
        {
            $this->Cell(30,4, utf8_decode($columna),1, 2 , 'L' );
        }
    }
	
	function TituloClase2($cabecera)
    {
        $this->SetXY(110, 37);
        $this->SetFont('Arial','B',9);
       // $this->SetFillColor(2,157,116);//Fondo verde de celda
        $this->SetTextColor(0, 0, 0); //Letra color blanco
		$this->SetDrawColor(255,255,255);
        foreach($cabecera as $columna)
        {
            //Parámetro con valor 2, hace que la cabecera sea vertical
            $this->Cell(40,4, utf8_decode($columna),1, 2 , 'L');
        }
    }	
	function DatosClase2($datos)
    {
        $this->SetXY(125, 37); //40 = 10 posiciónX_anterior + 30ancho Celdas de cabecera
        $this->SetFont('Arial','',9); //Fuente, Normal, tamaño
        $this->SetFillColor(229, 229, 229); //Gris tenue de cada fila
        $this->SetTextColor(3, 3, 3); //Color del texto: Negro
		$this->SetDrawColor(255,255,255);
		
		foreach($datos as $columna)
        {
            $this->Cell(30,4, utf8_decode($columna),1, 2 , 'L' );
        }
    }  

	
	function cabeceradias($cabecera)
    {
        $this->SetXY(10, 70);
        $this->SetFont('Arial','B',7);
		$this->SetFillColor(41,97,169);//Fondo verde de celda
        $i=0;
		$this->Cell(30,5, utf8_decode($_SESSION['mes_ano']),1, 0 , 'C', true );
		foreach($cabecera as $fila)
        {
            $i++;
			//Atención!! el parámetro valor 0, hace que sea horizontal
				$this->Cell(5,5, utf8_decode($fila),1, 0 , 'C', true );
        }
		
    }
 
    function datosdias($datos)
    {
        $this->SetXY(10,75); // 77 = 70 posiciónY_anterior + 7 altura de las de cabecera
        $this->SetFont('Arial','',7); //Fuente, normal, tamaño
		$i=0;
		$this->SetFillColor(229, 229, 229); //Gris tenue de cada fila
		$bandera = false; //Para alternar el relleno
		$this->SetTextColor(3, 3, 3); //Color del texto: Negro
		$this->Cell(30,5, utf8_decode('Nombres y Apellidos'),1, 0 , 'C', true );
        foreach($datos as $fila)
        {	
			$this->Cell(5,5, utf8_decode($fila),1, 0 , 'J', true );	
        }
    }
	function asis_dias($datos)
    {
        $this->SetXY(10,80); // 77 = 70 posiciónY_anterior + 7 altura de las de cabecera
        $this->SetFont('Arial','',7); //Fuente, normal, tamaño
		$i=0;
		$this->SetFillColor(229, 229, 229); //Gris tenue de cada fila
		$bandera = false; //Para alternar el relleno
		$this->SetTextColor(3, 3, 3); //Color del texto: Negro
		for ($i=0;$i<=60;$i++){
			$this->Cell(30,5, utf8_decode('Nombres y Apellidos'),1, 0 , 'C', true );
	        foreach($datos as $fila)
    	    {	
				//deberia haber un for
				$this->Cell(5,5,  '',1, 0 , 'J', true );	 
    	    }
			$this->Ln(4);
		}
    }
	
	
	    function tablaDias($cab_dias, $datos_dias, $asis_dias)
    {
        $this->cabeceradias($cab_dias);
        $this->datosdias($datos_dias);
		$this->asis_dias($asis_dias);
    }
	
	
	function pie($datos)
	{
		$this->SetFont('Arial','B',8);
		foreach($datos as $columna)
        {
            $this->MultiCell(190,4, utf8_decode($columna), 0 , 'J' );
        }
		$this->Ln(1); 
		$this->Cell(90,0,utf8_decode('Firma en aceptación del contenido:_____________________________'),0,0,'J');
		$this->Ln(3); 
		$this->Cell(90,0,utf8_decode('Chacao,_____________de___________de____Revisado Por___________'),0,0,'J');
	}
	
	
} // FIN Class PDF

//$pdf = new PDF();
$pdf=new PDF('L','mm','A4');
$pdf->AddPage();





if ($row["sexo"]==1)
	{$sexo="Masculino";}
elseif ($row["sexo"]==2)
 	{$sexo="Femenino";}
elseif ($row["sexo"]==3){$sexo="Mixto";}

$clase=  array('Clase: '.$cod_clase);

$tt_clase = array('Disciplina', 'Instalación', 'Cancha', 'Entrenador');
$datos_clase = array($row['disciplina'], $row['instalacion'], $row['cancha'], $row['nombres']." ".$row['apellidos']); 

$tt_clase2 = array('Días', 'Horario', 'Edad', 'sexo');
$datos_clase2 = array($row['semanas'], $row['hora_inicio']." a ". $row['hora_fin'],$row['edad_min']." a ".$row['edad_max'], $sexo); 
$week = 1;

// Establecer el idioma al Español para strftime().
setlocale( LC_TIME, 'spanish' );
// Si no se ha seleccionado mes, ponemos el actual y el año
$month = isset($_GET['month'])?$_GET['month']:date('Y-n');
$dia_semana=array('','LU','MA','MI','JU','VI','SA','DO');
 //$_SESSION['mes_ano'];
$dia_numero=date('d');//hoy
for ( $i=1;$i<=date( 't', strtotime( $month ) );$i++ ) 
{
	
	 $day_week = date( 'N', strtotime( $month.'-'.$i )  );
	
	 $calendar[ $week ][ $day_week ] = $i;
	 $calendario[$i-1]=$i;
	 $asis_dias[$i-1]=$i;
	if ( $day_week == 7 )
		$week++;
}
//print_r($calendario);
//print "<br>";
$x=0;
foreach ( $calendar as $days ) : 
			 for ( $i=1;$i<=7;$i++ ) : 
					if (isset($days[$i])){
					  $dia_semana[$i];
					  $dia_mes[$x]=$dia_semana[$i];
					  $x++;
					}
			 endfor; 
endforeach; 


$SQL="SELECT t_deportista.id_deportista, t_deportista.nombres, t_deportista.apellidos FROM t_deportista, t_entrenador, t_clase, t_inscrito
	 WHERE t_clase.cod_clase='$cod_clase'
	 AND t_entrenador.id_entrenador=t_clase.id_entrenador
	 AND t_inscrito.cod_clase=t_clase.cod_clase
	 AND t_deportista.id_deportista=t_inscrito.id_deportista
	 AND t_inscrito.estatus=1
	 ";	 
$consulta=mysql_query($SQL);

$y=0;
while ($campo = mysql_fetch_array($result_clases)){
	$nombre[$y]=$campo;
	$y++;
}
//print_r($dia_mes);
//die;

/*$cab_dias= array('Fecha Inscrip.', 'Clase', 'Instalación', 'Cancha', 'Disciplina','Días','Hora','Estatus');

$consul_clases="
SELECT fecha_inscripcion, t_clase.cod_clase, instalacion_corta, cancha, disciplina, semanas, hora_inicio, estatus_inscrito
FROM t_inscrito, t_estatus_inscrito, t_clase, t_instalacion, t_cancha, t_disciplina
WHERE id_deportista =$_GET[id_deportista]
AND id_estatus_inscrito = t_inscrito.estatus
AND t_clase.cod_clase = t_inscrito.cod_clase
AND t_clase.id_instalacion = t_instalacion.id_instalacion
AND t_clase.id_cancha = t_cancha.id_cancha
AND t_clase.id_disciplina = t_disciplina.id_disciplina
AND t_inscrito.estatus=1
";
$result_clases= mysql_query($consul_clases);
$x=0;
//print_r(mysql_fetch_array($result_clases));
while ($campo = mysql_fetch_array($result_clases)){
	$datos_cupos[$x]=$campo;
	$x++;
}
if ($edad<18){
$pie= array("Yo, ".utf8_encode($registror['nombre_representante'])." ". utf8_encode($registror['apellido_representante'])." representante legal del niño(a) o adolescente ".utf8_encode($registro['nombres'])." ". utf8_encode($registro['apellidos']).", Portador de la cédula de Identidad $registror[cedula_representante], Autorizo a mi representado para que asista y participe en las diferentes actividades deportivas y creativas organizadas por la dirección de Deportes de la Alcaldía de Chacao. Así mismo, dejo constancia expresa que mi representado no padece de ninguna enfermedad física o mental, por lo tanto lo exonero de toda responsabilidad penal, civil o administrativa a la Alcaldía de Chacao por hechos o accidentes ocurridos antes, drantes y después de cualquier práctica deportiva o recreativa que realice, Por último doy autorización para trasladar a mi representado a la clínica u hospital más cercano en caso de presentarse algún accidente y autorizo a los médicos a atenderlo debidamente.");
}else{
$pie= array("Yo, ".utf8_encode($registro['nombres'])." ". utf8_encode($registro['apellidos'])." portador de la CI $registro[cedula] haré uso de las instalaciones deportivas municipales bajo mi única responsabilidad. Así mismo, declaro que me encuentro apto fíisica y mentalmente para practicar cualquier actividad deportiva o recreativa organizada por la Dirección de Deportes de la Alcaldía de Chacao. Por lo tanto, exonero de toda responsabilidad penal, civil o administrativa a la Alcaldía de Chacao, por hechos o accidentes ocurridos antes, durante y después de cualquier práctica deportiva o recreativa que realice. Por último, doy autorización para realizar mi traslado a la clínica u hospital más cercano, en caso de presentarse algún accidente y autorizo a los médicos a atenderme debidamente.");
}
*/
$pdf->clase($clase);
$pdf->TituloClase($tt_clase);
$pdf->DatosClase($datos_clase);
$pdf->TituloClase2($tt_clase2);
$pdf->DatosClase2($datos_clase2);
$pdf->tablaDias($dia_mes, $calendario, $asis_dias);
//$pdf->pie($pie);
$pdf->Output(); //Salida al navegador
echo "<script language='javascript'>window.open('doc.pdf','_blank');</script>"; //para ver el archivo pdf generado

} //cierro if
////en caso de que la variable no venga del metodo get
else{
	print "NO";
	print $_GET['cod_clase'];
	exit;
}?>
