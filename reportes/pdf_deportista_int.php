<?php
session_start();
//header('Content-Type: text/html; charset=ISO-8859-1');
require('../fpdf17/fpdf.php'); 
setlocale(LC_TIME, 'es_VE'); # Localiza en español es_Venezuela
date_default_timezone_set('America/Caracas');
if(isset($_GET['id_deportista'])){
	include ('../configuration/conexion.php');
	$mysqli = Conectarse();
$sql="SELECT id_deportista, cedula, nombres, apellidos, id_sexo, fecha_nac, foto, id_ocupacion, otra_ocupacion, id_grado_instruccion, emp_trabaja, id_grado, cedula_representante, id_institucion, otra_institucion, id_municipio, otro_municipio, id_urbanizacion, otra_urbanizacion, av_calle, edf_res_casa, nro_cas_res, tlf_casa, tlf_trabajo, celular1, celular2, correo1, correo2, id_grupo_sanguineo, tratamiento_medico, tratamiento1, tratamiento2, tratamiento3, pad_fisico, padecimiento1, padecimiento2, padecimiento3, alergico, alergico1, alergico2, alergico3, hcm, cual_hcm, ss, vence_cm, obs_medicos, nombre_emerg, apellido_emerg, parentesco_emerg, ocupacion_emerg, tlf_emerg, trabajo_emerg, id_tipo_inscripcion, fecha_const_tipo, obs_inscripcion, estatus
FROM t_deportista
WHERE id_deportista =$_GET[id_deportista]";
//die($sql);
	$resultado = $mysqli->query($sql);
	$registro= $resultado->fetch_array();
	
	$sqlm="SELECT * FROM t_municipio WHERE id_municipio='$registro[id_municipio]'";
	$resultadom=$mysqli->query($sqlm);
	$registrom= $resultadom->fetch_array();
	if ($registro['id_municipio']==6)
		{$municipio=$registro['otro_municipio'];}
	else{$municipio=$registrom['municipio'];	}
	
	$sqlm="SELECT * FROM t_urbanizacion WHERE id_urbanizacion='$registro[id_urbanizacion]'";
	$resultadom=$mysqli->query($sqlm);
	$registrom= $resultadom->fetch_array();
	if ($registro['id_urbanizacion']==24)
		{$urbanizacion=$registro['otra_urbanizacion'];}
	else{$urbanizacion=$registrom['urbanizacion'];	}
	
	$sqlm="SELECT * FROM t_ocupacion WHERE id_ocupacion='$registro[id_ocupacion]'";
	$resultadom=$mysqli->query($sqlm);
	$registrom= $resultadom->fetch_array();
	if ($registro['id_ocupacion']==693)
		{$ocupacion=$registro['otra_ocupacion'];}
	else{$ocupacion=$registrom['ocupacion'];}
	
	$sqlm="SELECT * FROM t_grado_instruccion WHERE id_grado_instruccion='$registro[id_grado_instruccion]'";
	$resultadom=$mysqli->query($sqlm);
	$registrom= $resultadom->fetch_array();
	$grado_instruccion=$registrom['grado_instruccion'];
	
	$sqlm="SELECT * FROM t_institucion WHERE id_institucion='$registro[id_institucion]'";
	$resultadom=$mysqli->query($sqlm);
	$registrom= $resultadom->fetch_array();
	$institucion=$registrom['institucion'];
	if ($registro['id_institucion']==600)
		{$institucion=$registro['otra_institucion'];}
	else{$institucion=$registrom['institucion'];}
	
	$sqlm="SELECT * FROM t_grado WHERE id_grado='$registro[id_grado]'";
	$resultadom=$mysqli->query($sqlm);
	$registrom= $resultadom->fetch_array();
	$grado=$registrom['grado'];
	
	$sqlm="SELECT * FROM t_grupo_sanguineo WHERE id_grupo_sanguineo='$registro[id_grupo_sanguineo]'";
	$resultadom=$mysqli->query($sqlm);
	$registrom= $resultadom->fetch_array();
	$grupo_sanguineo=$registrom['grupo_sanguineo'];

class PDF extends FPDF 
{
  function Header() //Encabezado
    {
        global $title;
        
		//$this->Line(10,35.5,206,35.5);
        $this->Image('logonuevo.jpg',8,5,40);
	
		//$this->Image('imagen/LOGO_INSTITUTO.jpg', 152,12, 19);
        // Arial bold 9
		$this->SetFont('Arial','B',10);
        $this->SetFillColor(62,102,60); // fondo de celda 
		$this->SetTextColor(41,97,169);
		$this->Cell(180,5,utf8_decode('Registro del Usuario'),0,0,'C');
        $this->Ln(22);
      	$this->Cell(75,5,utf8_decode('Datos Básicos'),0,0,'J');
		$this->Ln(32);
      	$this->Cell(180,5,utf8_decode('Dirección de Residencia'),0,0,'C');
		$this->Ln(28);
      	$this->Cell(180,5,utf8_decode('Ocupación'),0,0,'C');
		$this->Ln(26);
      	$this->Cell(180,5,utf8_decode('Datos del Representante'),0,0,'C');
		$this->Ln(27);
      	$this->Cell(180,5,utf8_decode('Datos Medicos'),0,0,'C');
		$this->Ln(35);
      	$this->Cell(80,5,utf8_decode('Emergencia'),0,'J');
        $this->Cell(80,5,utf8_decode('Observaciones'),0,0,'R');
		$this->Ln(26);
      	$this->Cell(180,5,utf8_decode('Solicitud de Cupos'),0,0,'C');
		
    }
	
	function foto($cabecera)
    {
		foreach($cabecera as $columna)
        {
            if (!empty($columna)){
			//Parámetro con valor 2, hace que la cabecera sea vertical
			$this->Image("../deportista/fotos/$columna", 170, 10, 25); 
			}
			else{
			$this->Image("../deportista/fotos/sinfoto.png", 170, 10, 25); }
        }
		
	}
	function cabecerabasica($cabecera)
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
	function datosbasicos($datos)
    {
        $this->SetXY(50, 37); //40 = 10 posiciónX_anterior + 30ancho Celdas de cabecera
        $this->SetFont('Arial','',8); //Fuente, Normal, tamaño
        $this->SetFillColor(229, 229, 229); //Gris tenue de cada fila
        $this->SetTextColor(3, 3, 3); //Color del texto: Negro
		$this->SetDrawColor(255,255,255);
		foreach($datos as $columna)
        {
            $this->Cell(30,4, utf8_decode($columna),1, 2 , 'L' );
        }
    } 
	
    function vencimiento($cabecera)
    {
        $this->SetXY(108, 45);
        $this->SetFont('Arial','B',9);
       // $this->SetFillColor(2,157,116);//Fondo verde de celda
        $this->SetTextColor(40, 92, 168); //Letra color blanco
        $this->SetDrawColor(0,0,0);
        foreach($cabecera as $columna)
        {
            //Parámetro con valor 2, hace que la cabecera sea vertical
            $this->Cell(62,4, utf8_decode($columna),1, 2 , 'R', true);
        }
    }   
	function Datosvencimiento($datos)
    {
        $this->SetXY(170, 45); //40 = 10 posiciónX_anterior + 30ancho Celdas de cabecera
        $this->SetFont('Arial','',9); //Fuente, Normal, tamaño
        $this->SetFillColor(229, 229, 229); //Gris tenue de cada fila
        $this->SetTextColor(40, 92, 168); //Color del texto: Negro
		$this->SetDrawColor(0,0,0);
		foreach($datos as $columna)
        {
            $this->Cell(30,4, utf8_decode($columna),1, 2 , 'L' );
        }
    }
	
	function DireccionResidencia($cabecera)
    {
        $this->SetXY(10, 69);
        $this->SetFont('Arial','B',9);
       // $this->SetFillColor(2,157,116);//Fondo verde de celda
        $this->SetTextColor(0, 0, 0); //Letra color blanco
		$this->SetDrawColor(255,255,255);
        $y=0;
        foreach($cabecera as $columna)
        {
            //Parámetro con valor 2, hace que la cabecera sea vertical
            $this->Cell(40,4, utf8_decode($columna),1, 2 , 'L');
            if ($y==1){$this->Ln();}
            $y++;
        }
    }	
	function Datosresidencias($datos)
    {
        $this->SetXY(30, 69); //40 = 10 posiciónX_anterior + 30ancho Celdas de cabecera
        $this->SetFont('Arial','',8); //Fuente, Normal, tamaño
        $this->SetFillColor(229, 229, 229); //Gris tenue de cada fila
        $this->SetTextColor(3, 3, 3); //Color del texto: Negro
		$this->SetDrawColor(255,255,255);
        $y = 0;
        $xx = 0;
		foreach($datos as $columna)
        {
            $this->SetXY(30, 69+$xx); //40 = 10 posiciónX_anterior + 30ancho Celdas de cabecera
            //$this->Cell(30,4, utf8_decode($columna),1, 2 , 'L' );
            $this->MultiCell(50,4, utf8_decode($columna), 0, 'J' );    
            $xx=$xx+4;
            if ($y==1){$xx=$xx+4;}
            $y++;
        }
    }
	
	function DireccionResidencia2($cabecera)
    {
        $this->SetXY(80, 69);
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
	function Datosresidencias2($datos)
    {
        $this->SetXY(105, 69); //40 = 10 posiciónX_anterior + 30ancho Celdas de cabecera
        $this->SetFont('Arial','',9); //Fuente, Normal, tamaño
        $this->SetFillColor(229, 229, 229); //Gris tenue de cada fila
        $this->SetTextColor(3, 3, 3); //Color del texto: Negro
		$this->SetDrawColor(255,255,255);
		foreach($datos as $columna)
        {
            $this->Cell(30,4, utf8_decode($columna),1, 2 , 'L' );
        }
    }  

	function cabecerocupacion($cabecera)
    {
        $this->SetXY(10, 96);
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
	function datosocupacion($datos)
    {
        $this->SetXY(50, 96); //40 = 10 posiciónX_anterior + 30ancho Celdas de cabecera
        $this->SetFont('Arial','',9); //Fuente, Normal, tamaño
        $this->SetFillColor(229, 229, 229); //Gris tenue de cada fila
        $this->SetTextColor(3, 3, 3); //Color del texto: Negro
		$this->SetDrawColor(255,255,255);
		foreach($datos as $columna)
        {
            $this->Cell(30,4, utf8_decode($columna),1, 2 , 'L' );
        }
    } 
	
	
	function cabecerarepres($cabecera)
    {
        $this->SetXY(10, 124);
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
	function datosrepres($datos)
    {
        $this->SetXY(50, 124); //40 = 10 posiciónX_anterior + 30ancho Celdas de cabecera
        $this->SetFont('Arial','',9); //Fuente, Normal, tamaño
        $this->SetFillColor(229, 229, 229); //Gris tenue de cada fila
        $this->SetTextColor(3, 3, 3); //Color del texto: Negro
		$this->SetDrawColor(255,255,255);
		foreach($datos as $columna)
        {
            $this->Cell(30,4, utf8_decode($columna),1, 2 , 'L' );
        }
    } 
	
	function cabeceramedicos($cabecera)
    {
        $this->SetXY(10, 151);
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
	function datosmedicos($datos)
    {
        $this->SetXY(70, 151); //40 = 10 posiciónX_anterior + 30ancho Celdas de cabecera
        $this->SetFont('Arial','',9); //Fuente, Normal, tamaño
        $this->SetFillColor(229, 229, 229); //Gris tenue de cada fila
        $this->SetTextColor(3, 3, 3); //Color del texto: Negro
		$this->SetDrawColor(255,255,255);
		foreach($datos as $columna)
        {
            $this->Cell(30,4, utf8_decode($columna),1, 2 , 'L' );
        }
    } 
	
	function cabeceraemergencia($cabecera)
    {
        $this->SetXY(10, 187);
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
	function datosemergencia($datos)
    {
        $this->SetXY(50, 187); //40 = 10 posiciónX_anterior + 30ancho Celdas de cabecera
        $this->SetFont('Arial','',9); //Fuente, Normal, tamaño
        $this->SetFillColor(229, 229, 229); //Gris tenue de cada fila
        $this->SetTextColor(3, 3, 3); //Color del texto: Negro
		$this->SetDrawColor(255,255,255);
        $y=0;
		foreach($datos as $columna)
        {
            $y++;
           
            if ($y==6){
                $this->SetXY(120, 187);
                $this->SetFillColor(255,255,169);//Fondo verde de celda
                $this->MultiCell(80,4, utf8_decode($columna), 0,1, 'J' , true );    }
            else{ $this->Cell(30,4, utf8_decode($columna),1, 2 , 'L' );}
        }
    } 
	
	
	function cabeceracupos($cabecera)
    {
        $this->SetXY(10, 211);
        $this->SetFont('Arial','B',7);
		$this->SetFillColor(41,97,169);//Fondo verde de celda
        $i=0;
		foreach($cabecera as $fila)
        {
            $i++;
			//Atención!! el parámetro valor 0, hace que sea horizontal
            if ($i==2){
				$this->Cell(30,7, utf8_decode($fila),1, 0 , 'J', true );
				}
			else{
			$this->Cell(23,7, utf8_decode($fila),1, 0 , 'J', true );}
        }
		
    }
 
    function datoscupos($datos)
    {
        
        $this->SetFont('Arial','',8); //Fuente, normal, tamaño
		$i=0;
		$this->SetFillColor(229, 229, 229); //Gris tenue de cada fila
		$bandera = false; //Para alternar el relleno
		$this->SetTextColor(3, 3, 3); //Color del texto: Negro
        $x=218;
        foreach($datos as $fila)
        {	
            $i++;
            $this->SetXY(10,$x); // 77 = 70 posiciónY_anterior + 7 altura de las de cabecera
			//Atención!! el parámetro valor 0, hace que sea horizontal
				$this->Cell(23,6, utf8_decode($fila['fecha_inscripcion']),0, 0 , 'J',$bandera );
				$this->Cell(30,6, utf8_decode($fila['cod_clase']),0, 0 , 'J', $bandera );
				$this->Cell(23,6, utf8_decode($fila['instalacion_corta']),0, 0 , 'J', $bandera );
				$this->Cell(23,6, utf8_decode($fila['cancha']),0, 0 , 'J', $bandera );
				//$this->Cell(23,7, utf8_decode($fila['disciplina']),0, 0 , 'J', $bandera );
                //$this->MultiCell(0,5,utf8_decode($fila['disciplina']));
                $this->MultiCell(23,6, "", 0 , 'J' , $bandera );    
                $this->SetXY(109,$x); // 77 = 70 posiciónY_anterior + 7 altura de las de cabecera
                $this->MultiCell(23,3, utf8_decode($fila['disciplina']), 0 , 'J' , $bandera );    
                $this->SetXY(132,$x); 
                 

				$this->Cell(23,6, utf8_decode($fila['semanas']),0, 0 , 'J', $bandera );
				
                
                $this->MultiCell(23,3, ("Desde ".$fila['hora_inicio'])." Hasta ".($fila['hora_fin']), 0 , 'C' , $bandera );    
                $this->SetXY(178,$x);
//              $this->Cell(23,6, ($fila['hora_inicio'])." a ".($fila['hora_fin']),0, 0 , 'J', $bandera );
				$this->Cell(23,6, utf8_decode($fila['estatus_inscrito']),0, 0 , 'C', $bandera );
				$this->Ln();//Salto de línea para generar otra fila	
				$bandera = !$bandera;//Alterna el valor de la bandera	
				$x=$x+7;
                
                    
        }
    }
	    function tablacupos($cab_cupos, $datos_cupos)
    {
        $this->cabeceracupos($cab_cupos);
        $this->datoscupos($datos_cupos);
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

$pdf=new PDF('P','mm','A4');
 
$pdf->AddPage();

if($registro["id_sexo"] ==1)
{$sexo="Masculino";}
elseif($registro["id_sexo"] ==2)
{$sexo="Femenino";}
$fecha_nacimiento=$registro["fecha_nac"];
$dias=explode("-", $fecha_nacimiento, 3);
$dias=mktime(0,0,0,$dias[1],$dias[2],$dias[0]);
$edad=(int)((time()-$dias)/31556926);


$micabeceradatos = array('Carnet', 'Cedula', 'Nombres', 'Apellidos', 'Sexo', 'Fecha de Nacimiento', 'Edad:');
$misdatoscabecera = array($registro['id_deportista'], $registro['cedula'], ($registro['nombres']), $registro['apellidos'], $sexo, $registro['fecha_nac'], $edad);


$sqlm="SELECT * FROM t_tipo_inscripcion WHERE id_tipo_inscripcion='$registro[id_tipo_inscripcion]'";
	$resultadom=$mysqli->query($sqlm);
	$registrom= $resultadom->fetch_array();
	if (!$resultadom->num_rows == 0){
		$titulo_constancia="Vencimiento ".$registrom['descripcion_const'].":";
	}else{$titulo_constancia="";}
	

$vencimiento=array('Vencimiento Constancia Medica: ',$titulo_constancia);
$datosvencimiento = array($registro['vence_cm'], $registro['fecha_const_tipo']);

$mifoto=array($registro['foto']);
$cab_res = array('Municipio', 'Av/Calle', 'Telf. Casa', 'Celular 1', 'Correo 1');
$datos_res = array($municipio, $registro['av_calle'], $registro['tlf_casa'], $registro['celular1'], $registro['correo1']); 
$cab_res2 = array('Urbanización', 'Edf/Res/Casa', 'Telf. Trabajo', 'Celular 2', 'Correo 2');
$datos_res2 = array($urbanizacion, $registro['edf_res_casa']." Nro.".$registro['nro_cas_res'], $registro['tlf_trabajo'], $registro['celular2'], $registro['correo2']); 
$cab_ocupacion = array('Ocupación', 'Grado de Instrucción', 'Empresa donde trabaja', 'Institución donde estudia', 'Grado o Año que Cursa');
$datos_ocupacion= array($ocupacion, $grado_instruccion, ($registro['emp_trabaja']), $institucion, $grado);


$sqlr="SELECT * FROM t_representante, t_ocupacion, t_grado_instruccion WHERE id_deportista=$_GET[id_deportista] AND t_representante.id_ocupacion=t_ocupacion.id_ocupacion AND t_representante.id_grado_instruccion=t_grado_instruccion.id_grado_instruccion";
$resultador=$mysqli->query($sqlr);
$registror= $resultador->fetch_array();

$cab_repres= array('Nombres y Apellidos', 'Parentesco', 'Ocupación', 'Grado de Instrucción', 'Empresa donde Trabaja');
$datos_repres= array($registror['nombre_representante']." " .$registror['apellido_representante'], $registror['parentesco'], $registror["ocupacion"], $registror["grado_instruccion"], $registror['empresa_trabaja']);

if($registro["tratamiento_medico"]==1)
	{$tratamiento= "SI: ".$registro['tratamiento1'].", ".$registro['tratamiento2']. ", ".$registro['tratamiento3'];}
elseif ($registro["tratamiento_medico"]==2)
{$tratamiento="NO";}
else {$tratamiento="";}

if($registro["pad_fisico"]==1)
	{$padecimiento= "SI: ".$registro['padecimiento1'].", ".$registro['padecimiento2']. ", ".$registro['padecimiento3'];}
elseif($registro["pad_fisico"]==2){$padecimiento="NO";}
else {$padecimiento="";}

if($registro["alergico"]==1)
	{$alergico= "SI: ".$registro['alergico1'].", ".$registro['alergico2']. ", ".$registro['alergico3'];}
elseif($registro["alergico"]==2){$alergico="NO";}
else {$alergico="";}

if($registro["hcm"]==1)
	{$hcm= "SI: ".$registro["cual_hcm"];}
elseif($registro["hcm"]==2){$hcm="NO";}
else {$hcm="";}

if($registro["ss"]==1)
	{$ss= "SI";}
elseif($registro["ss"]==2){$ss="NO";}
else {$ss="";}



$cab_medicos= array('Grupo Sanguineo', 'Está bajo algún tratamiento médico', 'Sufre algún padecimiento físico', 'Es alérgico?','Posee seguro de HCM y/u otro','Está afiliado al seguro socia','Observaciones');
$datos_medicos= array($grupo_sanguineo, $tratamiento, $padecimiento,$alergico,$hcm,$ss,$registro['obs_medicos']);

$cab_emergencia= array('Nombres y Apellidos', 'Parentesco', 'Ocupación', 'Grado de Instrucción', 'Empresa donde Trabaja','');
$datos_emergencia= array($registro['nombre_emerg']." ".$registro['apellido_emerg'], $registro['parentesco_emerg'], $registro['ocupacion_emerg'],$registro['tlf_emerg'], ($registro['trabajo_emerg']), $registro['obs_inscripcion']);

$cab_cupos= array('Fecha Inscrip.', 'Clase', 'Instalación', 'Cancha', 'Disciplina','Días','Hora','Estatus');


$consul_clases="
SELECT fecha_inscripcion, t_clase.cod_clase, instalacion_corta, cancha, disciplina, semanas, hora_inicio, hora_fin, estatus_inscrito
FROM t_inscrito, t_estatus_inscrito, t_clase, t_instalacion, t_cancha, t_disciplina
WHERE id_deportista =$_GET[id_deportista]
AND id_estatus_inscrito = t_inscrito.estatus
AND t_clase.cod_clase = t_inscrito.cod_clase
AND t_clase.id_instalacion = t_instalacion.id_instalacion
AND t_clase.id_cancha = t_cancha.id_cancha
AND t_clase.id_disciplina = t_disciplina.id_disciplina
AND t_inscrito.estatus=1
";
$result_clases= $mysqli->query($consul_clases);
$x=0;
//print_r(mysql_fetch_array($result_clases));
while ($campo = $result_clases->fetch_array()){
	$datos_cupos[$x]=$campo;
	$x++;
}

if ($edad<18){
$pie= array("Yo, ".($registror['nombre_representante'])." ". ($registror['apellido_representante'])." representante legal del niño(a) o adolescente ".($registro['nombres'])." ". ($registro['apellidos']).", Portador de la cédula de Identidad $registror[cedula_representante], Autorizo a mi representado para que asista y participe en las diferentes actividades deportivas y creativas organizadas por la dirección de Deportes de la Alcaldía de Chacao. Así mismo, dejo constancia expresa que mi representado no padece de ninguna enfermedad física o mental, por lo tanto lo exonero de toda responsabilidad penal, civil o administrativa a la Alcaldía de Chacao por hechos o accidentes ocurridos antes, drantes y después de cualquier práctica deportiva o recreativa que realice, Por último doy autorización para trasladar a mi representado a la clínica u hospital más cercano en caso de presentarse algún accidente y autorizo a los médicos a atenderlo debidamente.");
}else{
$pie= array("Yo, ".($registro['nombres'])." ". ($registro['apellidos'])." portador de la CI $registro[cedula] haré uso de las instalaciones deportivas municipales bajo mi única responsabilidad. Así mismo, declaro que me encuentro apto fíisica y mentalmente para practicar cualquier actividad deportiva o recreativa organizada por la Dirección de Deportes de la Alcaldía de Chacao. Por lo tanto, exonero de toda responsabilidad penal, civil o administrativa a la Alcaldía de Chacao, por hechos o accidentes ocurridos antes, durante y después de cualquier práctica deportiva o recreativa que realice. Por último, doy autorización para realizar mi traslado a la clínica u hospital más cercano, en caso de presentarse algún accidente y autorizo a los médicos a atenderme debidamente.");
}
    
        $pdf->cabecerabasica($micabeceradatos);
        $pdf->datosbasicos($misdatoscabecera);
        $pdf->foto($mifoto);
        $pdf->vencimiento($vencimiento);
        $pdf->Datosvencimiento($datosvencimiento);
        $pdf->DireccionResidencia($cab_res);
        $pdf->Datosresidencias($datos_res);
        $pdf->DireccionResidencia2($cab_res2);
        $pdf->Datosresidencias2($datos_res2);
        $pdf->cabecerocupacion($cab_ocupacion);
        $pdf->datosocupacion($datos_ocupacion);
        $pdf->cabecerarepres($cab_repres);
        $pdf->datosrepres($datos_repres);
        $pdf->cabeceramedicos($cab_medicos);
        $pdf->datosmedicos($datos_medicos);
        $pdf->cabeceraemergencia($cab_emergencia);
        $pdf->datosemergencia($datos_emergencia);
    if ($x!=0){   
        $pdf->tablacupos($cab_cupos, $datos_cupos);
        $pdf->pie($pie);
        }
        $pdf->Output(); //Salida al navegador
        echo "<script language='javascript'>window.open('doc.pdf','_blank');</script>"; //para ver el archivo pdf generado
    
} //cierro if
////en caso de que la variable no venga del metodo get
else{
	print "NO";
	exit;
}?>
