<?php session_start(); ?>
<?php
include ("../configuration/conexion.php");
$mysqli=Conectarse(); 
header('Content-Type: text/html; charset=UTF-8'); 
$seleccion=$_REQUEST["seleccion"];

switch($seleccion)
{
case 1:
//para la foto	
	if (!empty($_POST['id_deportista'])){
		$id_deportista=$_POST['id_deportista'];
		$sql = ("SELECT * FROM t_deportista WHERE id_deportista='$id_deportista'");
		$result = $mysqli->query($sql);
		$row = $result->fetch_array();
		$codigo = $row['id_deportista'];
	}else{
		$sql = "SELECT MAX(id_deportista) as 'cantidad' AS id FROM t_deportista";
		$res = $mysqli->query($sql);
		$row = $res->fetch_array();
		$codigo = trim($row['cantidad']+1);
	}
	
if ($_FILES["foto"]["error"] > 0){
  echo "ha ocurrido un error (FOTO)" ;
  echo "<br>"; 
}
else { 	
	//$cedula= $_POST['cedula'];
  //ahora vamos a verificar si el tipo de archivo es un tipo de imagen permitido.
  //y que el tamano del archivo no exceda los 100kb
  $permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
  $limite_kb = 500;
  if (in_array($_FILES['foto']['type'], $permitidos) && $_FILES['foto']['size'] <= $limite_kb * 1024){
    //esta es la ruta donde copiaremos la imagen
    //recuerden que deben crear un directorio con este mismo nombre
    //en el mismo lugar donde se encuentra el archivo deportista.php
    $ruta = "fotos/" . $_FILES['foto']['name'];
	$ruta = pathinfo($_FILES['foto']['name']); //para obtener informacion de la ruta
	$ruta= "fotos/".$codigo.".".$ruta['extension']; //cambiar el nombre de la imagen por el codigo
		  
    //comprobamos si este archivo existe para no volverlo a copiar.
    //pero si quieren pueden obviar esto si no es necesario.
    //o pueden darle otro nombre para que no sobreescriba el actual.
    if (!file_exists($ruta)){
      //aqui movemos el archivo desde la ruta temporal a nuestra ruta
      //usamos la variable $resultado para almacenar el resultado del proceso de mover el archivo
      //almacenara true o false
	  
      $resultado = @move_uploaded_file($_FILES["foto"]["tmp_name"], $ruta); 
	 
	  if ($resultado){
		$ruta = pathinfo($_FILES['foto']['name']); //para obtener informacion de la ruta
        $foto = $codigo.".".$ruta['extension'];
		// continuo con el cierre del if de la imagen
      } else {
        echo "ocurrio un error al mover el archivo.";
      }
    } else {
	  unlink($ruta);
	  $resultado = @move_uploaded_file($_FILES["foto"]["tmp_name"], $ruta);
	  $ruta = pathinfo($_FILES['foto']['name']); //para obtener informacion de la ruta
	  echo $codigo.".".$ruta['extension'] . ", este archivo existe";
	  $foto = $codigo.".".$ruta['extension'];
	  //exit;
    }
  } else {
    echo "archivo no permitido, es tipo de archivo prohibido o excede el tamano de $limite_kb Kilobytes";
	exit;
  }
}	
//fin de la foto
	//Inclusion para Nuevo Deportista	
	// Datos del Solicitante
	$cedula= $_POST['cedula'];
	$nombres= $_POST['nombres'];
	$apellidos = $_POST['apellidos'];
	$sexo= $_POST['sexo'];
	$fecha_nac= $_POST['fecha_nac'];
	

	//$ruta = pathinfo($_FILES['foto']['name']); //para obtener informacion de la ruta
	//$foto= $cedula.".".$ruta['extension'];
	//$foto= $_FILES['foto']['name'];
	//Ocupacion
    $ocupacion= $_POST['ocupacion'];
	$otra_ocupacion= $_POST['otra_ocupacion'];
	$grado_instruccion = $_POST['grado_instruccion'];
	$emp_trabaja= $_POST['emp_trabaja'];
	$institucion= $_POST['institucion'];
	$otra_institucion= $_POST['otra_institucion'];
	$grado= $_POST['grado'];
	//Datos del Representante
	$cedula_repres= $_POST['cedula_repres'];
	$nombre_repres= $_POST['nombre_repres'];
	$apellido_repres= $_POST['apellido_repres'];
	$parentesco= $_POST['parentesco'];
	$ocupacion_repres= $_POST['ocupacion_repres'];
	$grado_instruccion_repres= $_POST['grado_instruccion_repres'];
	$empresa_repres= $_POST['empresa_repres'];
	//Dirección de Residencia
	$municipio= $_POST['municipio'];
	$otro_municipio= $_POST['otro_municipio'];
	$urbanizacion= $_POST['urbanizacion'];
	$otra_urbanizacion= $_POST['otra_urbanizacion'];
	$calle= $_POST['calle'];
	$casa_res= $_POST['casa_res'];
	$nro_cas_res= $_POST['nro_cas_res'];
	$tlf_casa= $_POST['tlf_casa'];
	$tlf_trabajo= $_POST['tlf_trabajo'];
	$celular1= $_POST['celular1'];
	$celular2= $_POST['celular2'];
	$correo1= $_POST['correo1'];
	$correo2= $_POST['correo2'];
	//Datos Médicos
	$grupo_sanguineo= $_POST['grupo_sanguineo'];
	$tratamiento_medico= $_POST['tratamiento_medico'];
	$tratamiento1= $_POST['tratamiento1'];
	$tratamiento2= $_POST['tratamiento2'];
	$tratamiento3= $_POST['tratamiento3'];
	$padecimiento_fisico= $_POST['padecimiento_fisico'];
	$padecimiento1= $_POST['padecimiento1'];
 	$padecimiento2= $_POST['padecimiento2'];
	$padecimiento3= $_POST['padecimiento3'];
	$alergico=$_POST['alergico'];
	$alergico1= $_POST['alergico1'];
	$alergico2= $_POST['alergico2'];
	$alergico3= $_POST['alergico3'];
	$hcm= $_POST['hcm'];
	$cual_hcm= $_POST['cual_hcm'];
	$ss= $_POST['ss'];
	$vence_cm= $_POST['vence_cm'];
	$obs_medicos= $_POST['obs_medicos'];
	//Emergencia
	$nombre_emerg= $_POST['nombre_emerg'];
	$apellido_emerg= $_POST['apellido_emerg'];
	$parentesco_emerg= $_POST['parentesco_emerg'];
	$ocupacion_emerg= $_POST['ocupacion_emerg'];
	$tlf_emerg= $_POST['tlf_emerg'];
	$trabajo_emerg= $_POST['trabajo_emerg']; 
	if (!empty($_POST['id_deportista'])){
		$id_deportista=$_POST['id_deportista'];
		//$foto=$id_deportista.".jpg";
		$sql=("SELECT * FROM t_deportista WHERE id_deportista='$id_deportista'");
		$result=$mysqli->query($sql);
		$row = $result->fetch_array();
		$cantidad_id_deportista = $results->num_rows;
	}else{
		$cantidad_id_deportista=0;
		print "NO CEDULA";
	}	
	print "id deportista".$_POST['id_deportista'];
	echo "<br>";
	print "Cantidad".$cantidad_id_deportista;

	if(!$cantidad_id_deportista==0){
		$mysqli->query("UPDATE t_deportista SET  nombres='$_POST[nombres]', apellidos='$_POST[apellidos]', id_sexo='$_POST[sexo]', fecha_nac='$_POST[fecha_nac]', foto='$foto', id_ocupacion='$_POST[ocupacion]', otra_ocupacion='$_POST[otra_ocupacion]', id_grado_instruccion='$_POST[grado_instruccion]', emp_trabaja='$_POST[emp_trabaja]', id_institucion='$_POST[institucion]', otra_institucion='$_POST[otra_institucion]', id_grado='$_POST[grado]', cedula_representante='$_POST[cedula_repres]', id_municipio='$_POST[municipio]', otro_municipio='$_POST[otro_municipio]', id_urbanizacion='$_POST[urbanizacion]', otra_urbanizacion='$_POST[otra_urbanizacion]', av_calle='$_POST[calle]', edf_res_casa= '$_POST[casa_res]', nro_cas_res='$_POST[nro_cas_res]', tlf_casa='$_POST[tlf_casa]', tlf_trabajo='$_POST[tlf_trabajo]', celular1='$_POST[celular1]', celular2='$_POST[celular2]', correo1='$_POST[correo1]', correo2='$_POST[correo2]', id_grupo_sanguineo='$_POST[grupo_sanguineo]', tratamiento_medico='$_POST[tratamiento_medico]', tratamiento1='$_POST[tratamiento1]', tratamiento2='$_POST[tratamiento2]', tratamiento3='$_POST[tratamiento3]', pad_fisico='$_POST[padecimiento_fisico]', padecimiento1='$_POST[padecimiento1]', padecimiento2='$_POST[padecimiento2]', padecimiento3='$_POST[padecimiento3]', alergico='$_POST[alergico]', alergico1='$_POST[alergico1]', alergico2='$_POST[alergico2]', alergico3='$_POST[alergico3]', hcm='$_POST[hcm]', cual_hcm='$_POST[cual_hcm]', ss='$_POST[ss]', vence_cm='$_POST[vence_cm]', obs_medicos='$_POST[obs_medicos]', nombre_emerg='$_POST[nombre_emerg]', apellido_emerg='$_POST[apellido_emerg]', parentesco_emerg='$_POST[parentesco_emerg]', ocupacion_emerg='$_POST[ocupacion_emerg]', tlf_emerg='$_POST[tlf_emerg]', trabajo_emerg='$_POST[trabajo_emerg]' WHERE id_deportista= '$id_deportista' ") or die("error en Actualizar:".$mysqli->error);
		$id_deportista= $row["id_deportista"];
		$_SESSION['id_deportista']=$id_deportista;
		}
	else{
//	     $result=$mysqli->query("SELECT * FROM t_solicitante WHERE cedula='$cedula'"); 
//		 if ((@mysql_num_rows ($result) == 0))
		 	$mysqli->query("INSERT INTO t_deportista Values('','$cedula','$nombres', '$apellidos', '$sexo', '$fecha_nac', '$foto',
					'$ocupacion', '$otra_ocupacion', '$grado_instruccion', '$emp_trabaja', '$institucion', '$otra_institucion', '$grado', '$cedula_repres',
						'$municipio', '$otro_municipio', '$urbanizacion', '$otra_urbanizacion', '$calle', '$casa_res', '$nro_cas_res', '$tlf_casa',
						'$tlf_trabajo', '$celular1', '$celular2', '$correo1', '$correo2', '$grupo_sanguineo', '$tratamiento_medico', '$tratamiento1', '$tratamiento2', '$tratamiento3', '$padecimiento_fisico', '$padecimiento1', '$padecimiento2', '$padecimiento3', '$alergico', '$alergico1', '$alergico2', '$alergico3', '$hcm', '$cual_hcm', '$ss', '$vence_cm','$obs_medicos', '$nombre_emerg', '$apellido_emerg', '$parentesco_emerg', '$ocupacion_emerg', '$tlf_emerg', '$trabajo_emerg','','','','')") or die("error en Incluir: ".$mysqli->error);
		//$mysqli->query("INSERT INTO t_deportista Values('','$cedula','$nombres', '$apellidos', '$sexo', '$fecha_nac', '$foto')") or die("error en Incluir: ".$mysqli->error);				
			
			$result=$mysqli->query("SELECT id_deportista FROM t_deportista ORDER BY id_deportista DESC LIMIT 1"); 
			$row=$result->fetch_array();
			$id_deportista= $row["id_deportista"];
			$_SESSION['id_deportista']=$id_deportista;
			
			}
//////////////////////para el Representante/////////////////////////////////////////////////////////////////////////////////			
echo "<br>"; print("tio");
print "Hola".$cedula_repres."Hola";
echo "<br>";
			if ( (!empty($_POST['nombre_repres'])) OR (!empty($_POST['apellido_repres'])) ) 
				{
					$sqlr=$mysqli->query("SELECT * FROM t_representante WHERE id_deportista=$id_deportista");
					if($rowr=$sqlr->fetch_array()){
						
						$mysqli->query("UPDATE t_representante SET cedula_representante='$cedula_repres', nombre_representante='$nombre_repres',
									 apellido_representante='$apellido_repres', parentesco='$parentesco', id_ocupacion='$ocupacion_repres', 
									 id_grado_instruccion='$grado_instruccion_repres', empresa_trabaja='$empresa_repres' 
									 WHERE id_deportista=$id_deportista") 
									 or die("error en Actualizar: ".$mysqli->error);
						print "SI";		 
					}
					else{
						
						$mysqli->query("INSERT INTO t_representante Values('','$id_deportista','$cedula_repres','$nombre_repres',
									 '$apellido_repres', '$parentesco',	'$ocupacion_repres', '$grado_instruccion_repres', 
									 '$empresa_repres')") or die("error en Incluir: ".$mysqli->error);
						print "NO";

					}
					
			}//
			else{
					$mysqli->query("DELETE FROM t_representante WHERE id_deportista=$id_deportista");
					print "Elimino represent";
				}
				
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////			
			header('Location: deportista_agg3.php');
		break;	
	case 2:
	//Actualizacion de Registros Tipo de Inscripcion, fecha carta de residencia y observaciones del deportista ya Inscrito
	$id_deportista=$_SESSION['id_deportista'];
	$tipo_inscripcion= $_POST['tipo_inscripcion'];
	$fecha_const_tipo= $_POST['fecha_const_tipo'];
	$observasiones_inscripcion = $_POST['observasiones_inscripcion'];
		$mysqli->query("UPDATE t_deportista SET id_tipo_inscripcion='$tipo_inscripcion', fecha_const_tipo='$fecha_const_tipo', obs_inscripcion=  '$observasiones_inscripcion' WHERE id_deportista= '$id_deportista'") or die("error en Actualizar: ".$mysqli->error);
		header('Location: ../reportes/pdf_deportista.php?id_deportista='.$id_deportista);
		break;
	case 3:

		break;	
	case 4:

		break;
}
?>