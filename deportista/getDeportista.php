<?php
//header('Content-Type: text/html; charset=ISO-8859-1'); 
header('Content-Type: text/html; charset=UTF-8'); 
include ('../configuration/conexion.php');
if(isset($_GET['getcedula']) AND $_GET['getcedula']<>0){ 
  Conectarse(); 
  $res = mysql_query("SELECT * FROM t_deportista 
  						WHERE cedula='$_GET[getcedula]'") or die(mysql_error());

  if($inf = mysql_fetch_array($res)){
/***********************************************************************************/
	echo "formObj.id_deportista.value = '".$inf["id_deportista"]."';\n";
    echo "formObj.nombres.value = '".$inf["nombres"]."';\n";    
    echo "formObj.apellidos.value = '".$inf["apellidos"]."';\n";
    if ($inf["foto"]==""){
    	echo "formObj.fotos.src='fotos/sinfoto.png';\n";       
    }else{	echo "formObj.fotos.src='fotos/".$inf["foto"]."';\n";}
    echo "formObj.fecha_nac.value = '".$inf["fecha_nac"]."';\n";    
    echo "formObj.sexo.value = '".$inf["id_sexo"]."';\n";   
/***********************************************************************************/ 
    echo "formObj.municipio.value = '".$inf["id_municipio"]."';\n";    
    echo "formObj.otro_municipio.value = '".$inf["otro_municipio"]."';\n";    
	echo "formObj.urbanizacion.value = '".$inf["id_urbanizacion"]."';\n";    
    echo "formObj.otra_urbanizacion.value = '".$inf["otra_urbanizacion"]."';\n"; 
	echo "formObj.calle.value = '".$inf["av_calle"]."';\n";    
    echo "formObj.casa_res.value = '".$inf["edf_res_casa"]."';\n";  
	echo "formObj.nro_cas_res.value = '".$inf["nro_cas_res"]."';\n";  
	echo "formObj.tlf_casa.value = '".$inf["tlf_casa"]."';\n";    
    echo "formObj.tlf_trabajo.value = '".$inf["tlf_trabajo"]."';\n";  
	echo "formObj.celular1.value = '".$inf["celular1"]."';\n";    
    echo "formObj.celular2.value = '".$inf["celular2"]."';\n";    
    echo "formObj.correo1.value = '".$inf["correo1"]."';\n";  
	echo "formObj.correo2.value = '".$inf["correo2"]."';\n";    
/***********************************************************************************/	
    echo "formObj.ocupacion.value = '".$inf["id_ocupacion"]."';\n";  
	echo "formObj.otra_ocupacion.value = '".$inf["otra_ocupacion"]."';\n";    
    echo "formObj.grado_instruccion.value = '".$inf["id_grado_instruccion"]."';\n"; 
	echo "formObj.emp_trabaja.value = '".$inf["emp_trabaja"]."';\n";  
	echo "formObj.institucion.value = '".$inf["id_institucion"]."';\n";    
    echo "formObj.grado.value = '".$inf["id_grado"]."';\n";  
	echo "formObj.otra_ocupacion.value = '".$inf["otra_ocupacion"]."';\n";    
/***********************************************************************************/    
	$resul_repre = mysql_query("SELECT * FROM t_representante WHERE id_deportista='$inf[id_deportista]'") or die(mysql_error());
	if($registro = mysql_fetch_array($resul_repre)){
		echo "formObj.cedula_repres.value = '".$registro["cedula_representante"]."';\n"; 
		echo "formObj.nombre_repres.value = '".$registro["nombre_representante"]."';\n";  
		echo "formObj.apellido_repres.value = '".$registro["apellido_representante"]."';\n";    
	    echo "formObj.parentesco.value = '".$registro["parentesco"]."';\n";  
		echo "formObj.ocupacion_repres.value = '".$registro["id_ocupacion"]."';\n";    
	    echo "formObj.grado_instruccion_repres.value = '".$registro["id_grado_instruccion"]."';\n"; 
		echo "formObj.empresa_repres.value = '".$registro["empresa_trabaja"]."';\n"; }
	else{
		echo "formObj.cedula_repres.value = '';\n"; 
		echo "formObj.nombre_repres.value = '';\n"; 
		echo "formObj.apellido_repres.value = '';\n"; 
	    echo "formObj.parentesco.value = '';\n"; 
		echo "formObj.ocupacion_repres.value = '0';\n"; 
	    echo "formObj.grado_instruccion_repres.value = '0';\n"; 
		echo "formObj.empresa_repres.value = '';\n"; 
		}
/***********************************************************************************/
    echo "formObj.grupo_sanguineo.value = '".$inf["id_grupo_sanguineo"]."';\n";  
	echo "formObj.tratamiento_medico.value = '".$inf["tratamiento_medico"]."';\n";    
    echo "formObj.tratamiento1.value = '".$inf["tratamiento1"]."';\n"; 
	echo "formObj.tratamiento2.value = '".$inf["tratamiento2"]."';\n";  
	echo "formObj.tratamiento3.value = '".$inf["tratamiento3"]."';\n";    
    echo "formObj.padecimiento_fisico.value = '".$inf["pad_fisico"]."';\n";  
	echo "formObj.padecimiento1.value = '".$inf["padecimiento1"]."';\n";
	echo "formObj.padecimiento2.value = '".$inf["padecimiento2"]."';\n";
	echo "formObj.padecimiento3.value = '".$inf["padecimiento3"]."';\n";
	echo "formObj.alergico.value = '".$inf["alergico"]."';\n";
	echo "formObj.alergico1.value = '".$inf["alergico1"]."';\n";
	echo "formObj.alergico2.value = '".$inf["alergico2"]."';\n";
	echo "formObj.alergico3.value = '".$inf["alergico3"]."';\n";
	echo "formObj.hcm.value = '".$inf["hcm"]."';\n";
	echo "formObj.cual_hcm.value = '".$inf["cual_hcm"]."';\n";
	echo "formObj.ss.value = '".$inf["ss"]."';\n";
	echo "formObj.vence_cm.value = '".$inf["vence_cm"]."';\n";
	//$obs_medicos=substr($inf["obs_medicos"],0,25);
	echo "formObj.obs_medicos.value = '';\n";
	echo "formObj.nombre_emerg.value = '".$inf["nombre_emerg"]."';\n";
	echo "formObj.apellido_emerg.value = '".$inf["apellido_emerg"]."';\n";
	echo "formObj.parentesco_emerg.value = '".$inf["parentesco_emerg"]."';\n";
	echo "formObj.ocupacion_emerg.value = '".$inf["ocupacion_emerg"]."';\n";
	echo "formObj.tlf_emerg.value = '".$inf["tlf_emerg"]."';\n";
	echo "formObj.trabajo_emerg.value = '".$inf["trabajo_emerg"]."';\n";
	$x=1;
/***********************************************************************************/
  }else{
  	$x=2;
  }    
}else{
	$x=2;
}

if ($x==2) {
    echo "formObj.nombres.value = '';\n";    
 	echo "formObj.apellidos.value = '';\n";
	echo "formObj.fotos.src='';\n"; 
    echo "formObj.fecha_nac.value = '';\n";    
    echo "formObj.sexo.value = '0';\n";    
    /***********************************************************************************/ 
    echo "formObj.municipio.value = '0';\n"; 
    echo "formObj.otro_municipio.value = '';\n"; 
	echo "formObj.urbanizacion.value = '0';\n"; 
    echo "formObj.otra_urbanizacion.value = '';\n"; 
	echo "formObj.calle.value = '';\n"; 
    echo "formObj.casa_res.value = '';\n"; 
	echo "formObj.nro_cas_res.value = '';\n";
	echo "formObj.tlf_casa.value = '';\n"; 
    echo "formObj.tlf_trabajo.value = '';\n"; 
	echo "formObj.celular1.value = '';\n"; 
    echo "formObj.celular2.value = '';\n"; 
    echo "formObj.correo1.value = '';\n"; 
	echo "formObj.correo2.value = '';\n"; 
/***********************************************************************************/	
    echo "formObj.ocupacion.value = '0';\n"; 
	echo "formObj.otra_ocupacion.value = '';\n"; 
    echo "formObj.grado_instruccion.value = '0';\n"; 
	echo "formObj.emp_trabaja.value = '';\n"; 
	echo "formObj.institucion.value = '0';\n"; 
    echo "formObj.grado.value = '0';\n"; 
	echo "formObj.otra_ocupacion.value = '';\n"; 
/***********************************************************************************/
 		echo "formObj.cedula_repres.value = '';\n"; 
		echo "formObj.nombre_repres.value = '';\n"; 
		echo "formObj.apellido_repres.value = '';\n"; 
	    echo "formObj.parentesco.value = '';\n"; 
		echo "formObj.ocupacion_repres.value = '0';\n"; 
	    echo "formObj.grado_instruccion_repres.value = '0';\n"; 
		echo "formObj.empresa_repres.value = '';\n"; 
/***********************************************************************************/
    echo "formObj.grupo_sanguineo.value = '0';\n"; 
	echo "formObj.tratamiento_medico.value = '0';\n"; 
    echo "formObj.tratamiento1.value = '';\n"; 
	echo "formObj.tratamiento2.value = '';\n"; 
	echo "formObj.tratamiento3.value = '';\n"; 
    echo "formObj.padecimiento_fisico.value = '0';\n"; 
	echo "formObj.padecimiento1.value = '';\n"; 
	echo "formObj.padecimiento2.value = '';\n"; 
	echo "formObj.padecimiento3.value = '';\n"; 
	echo "formObj.alergico.value = '0';\n"; 
	echo "formObj.alergico1.value = '';\n"; 
	echo "formObj.alergico2.value = '';\n"; 
	echo "formObj.alergico3.value = '';\n"; 
	echo "formObj.hcm.value = '0';\n"; 
	echo "formObj.cual_hcm.value = '';\n"; 
	echo "formObj.ss.value = '0';\n"; 
	echo "formObj.vence_cm.value = '';\n";
	echo "formObj.obs_medicos.value = '';\n"; 
	echo "formObj.nombre_emerg.value = '';\n"; 
	echo "formObj.apellido_emerg.value = '';\n"; 
	echo "formObj.parentesco_emerg.value = '';\n"; 
	echo "formObj.ocupacion_emerg.value = '';\n"; 
	echo "formObj.tlf_emerg.value = '';\n"; 
	echo "formObj.trabajo_emerg.value = '';\n"; 
/***********************************************************************************/    	
}
?> 