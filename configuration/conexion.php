<?php 
function Conectarse() 
{ 
   if (!($mysqli = new mysqli("localhost","root","laprepie2020", "bd_sid")))
   { 
      echo "Error conectando a la base de datos."; 
      exit(); 
   }  
   return $mysqli; 
}    
function desconectarse()
{
	//mysql_close();
}
?>