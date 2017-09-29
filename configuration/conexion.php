<?php 
function Conectarse() 
{ 
   if (!($link=mysql_connect("localhost","biometrico","biometricochacao"))) 
   { 
      echo "Error conectando a la base de datos."; 
      exit(); 
   } 
   if (!mysql_select_db("bd_sid",$link)) 
   { 
      echo "Error seleccionando la base de datos."; 
      exit(); 
   } 
   return $link; 
}    
function desconectarse()
{
	mysql_close();
}
?>