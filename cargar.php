<html>
<head>
<!--meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" /-->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title></title>
</head>
<body>
<?php
	include ('configuration/conexion.php');
  conectarse();  
  
  $sql="SELECT cod_clase, semanas, hora_inicio, hora_fin FROM t_clase";
  $consulta=mysql_query($sql);
  while ($fila=mysql_fetch_assoc($consulta)){ 
    $i++;
?>
    <?php $dia = explode("-", $fila["semanas"]); 
    
    for ($x=0;$x<=7;$x++){
      if (empty($dia[$x])){break;} //si dia no existe detener el proceso
      $hora_inicio= $fila["hora_inicio"];
      $hora_fin=$fila["hora_fin"];                
      $hi=explode(":", $hora_inicio);
      $min= $hi[1];
      $hora=$hi[0];
      $cod_clase=$fila["cod_clase"];
      $dia_semana=$dia[$x];
      while ($hora_inicio!=$hora_fin){
        //print $cod_clase.$dia_semana." ".$hora_inicio." ".$hora_fin;
        mysql_query("INSERT INTO t_horario (cod_clase, dia, hora_inicio, hora_fin)
                    VALUES('$cod_clase','$dia_semana', '$hora_inicio', '$hora_fin')");
        
        print "<br>";
        
        $min=$min+15;
        if ($min==60){
          $min="00";
          $hora=$hora + 1;
          if ($hora<10){
            $hora="0".$hora;}
        }
        $hora_inicio=$hora.":".$min.":".$hi[2];

      }print("<br>");
    }
    ?>
<?php  
  }
 ?>
<p align="center"> <?php print("Total Clases Encontradas: ".$i); ?> </p>
<?php
//}
?>
</body>
</html>