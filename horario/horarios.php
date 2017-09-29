<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
</head>
<body>
<?php
    $sem = array("Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sábado", "Domingo");
    $horarios = array('06:00', '07:00', '08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00');
    $deportes = array(
    "Edwin Blanco (Fisicoculturismo y Fitness),Lunes,16:00",
    "Edwin Blanco (Fisicoculturismo y Fitness),Lunes,19:00",
	"Edwin Blanco (Fisicoculturismo y Fitness),Lunes,20:00",
    "Edwin Blanco (Fisicoculturismo y Fitness),Lunes,21:00",
    "Edwin Blanco (Fisicoculturismo y Fitness),Miercoles,16:00",
    "Edwin Blanco (Fisicoculturismo y Fitness),Miercoles,19:00",
	"Edwin Blanco (Fisicoculturismo y Fitness)<br>,Miercoles,20:00",
    "Edwin Blanco (Fisicoculturismo y Fitness),Miercoles,21:00",
	"Edwin Blanco (Fisicoculturismo y Fitness),Jueves,20:00",
    "Edwin Blanco (Fisicoculturismo y Fitness),Jueves,21:00",
	"Edwin Blanco (Fisicoculturismo y Fitness),Viernes,16:00",
    "Edwin Blanco (Fisicoculturismo y Fitness),Viernes,19:00",
	"Edwin Blanco (Fisicoculturismo y Fitness),Viernes,20:00",
    "Edwin Blanco (Fisicoculturismo y Fitness),Viernes,21:00",
	
	"Edwin Blanco (Fisicoculturismo y Fitness),Martes,14:00",
	"Edwin Blanco (Fisicoculturismo y Fitness),Martes,15:00",
	"Edwin Blanco (Fisicoculturismo y Fitness),Martes,16:00",
	"Edwin Blanco (Fisicoculturismo y Fitness),Martes,17:00",	
	"Edwin Blanco (Fisicoculturismo y Fitness),Martes,18:00",
	"Edwin Blanco (Fisicoculturismo y Fitness),Martes,19:00",	
	"Edwin Blanco (Fisicoculturismo y Fitness),Martes,20:00",	
	"Edwin Blanco (Fisicoculturismo y Fitness),Martes,21:00",		
	"Edwin Blanco (Fisicoculturismo y Fitness),Jueves,14:00",
	"Edwin Blanco (Fisicoculturismo y Fitness),Jueves,15:00",
	"Edwin Blanco (Fisicoculturismo y Fitness),Jueves,16:00",
	"Edwin Blanco (Fisicoculturismo y Fitness),Jueves,17:00",
	"Edwin Blanco (Fisicoculturismo y Fitness),Jueves,18:00",
	"Edwin Blanco (Fisicoculturismo y Fitness),Jueves,19:00",
	
	"Edwin Blanco (Fisicoculturismo y Fitness),Lunes,14:00",
	"Edwin Blanco (Fisicoculturismo y Fitness),Lunes,15:00",
	"Edwin Blanco (Fisicoculturismo y Fitness),Lunes,17:00",
	"Edwin Blanco (Fisicoculturismo y Fitness),Lunes,18:00",
	"Edwin Blanco (Fisicoculturismo y Fitness),Miercoles,14:00",
	"Edwin Blanco (Fisicoculturismo y Fitness),Miercoles,15:00",
	"Edwin Blanco (Fisicoculturismo y Fitness),Miercoles,17:00",
	"Edwin Blanco (Fisicoculturismo y Fitness),Miercoles,18:00",
	"Edwin Blanco (Fisicoculturismo y Fitness),Viernes,14:00",
	"Edwin Blanco (Fisicoculturismo y Fitness),Viernes,15:00",
	"Edwin Blanco (Fisicoculturismo y Fitness),Viernes,17:00",
	"Edwin Blanco (Fisicoculturismo y Fitness),Viernes,18:00",
	
	"Edwin Blanco (Fisicoculturismo y Fitness),Sábado,08:00",
	"Edwin Blanco (Fisicoculturismo y Fitness),Sábado,09:00",
	"Edwin Blanco (Fisicoculturismo y Fitness),Sábado,10:00",
	"Edwin Blanco (Fisicoculturismo y Fitness),Sábado,11:00",
	"Edwin Blanco (Fisicoculturismo y Fitness),Sábado,12:00",
	"Edwin Blanco (Fisicoculturismo y Fitness),Sábado,13:00",
	"Edwin Blanco (Fisicoculturismo y Fitness),Sábado,14:00",

	"Silvia García (Fisicoculturismo y Fitness),Lunes,06:00",
	"Silvia García (Fisicoculturismo y Fitness),Lunes,07:00",
	"Silvia García (Fisicoculturismo y Fitness),Lunes,08:00",
	"Silvia García (Fisicoculturismo y Fitness),Lunes,09:00",
	"Silvia García (Fisicoculturismo y Fitness),Lunes,10:00",
	"Silvia García (Fisicoculturismo y Fitness),Lunes,11:00",
	"Silvia García (Fisicoculturismo y Fitness),Lunes,12:00",
	"Silvia García (Fisicoculturismo y Fitness),Lunes,13:00",
	"Silvia García (Fisicoculturismo y Fitness),Martes,06:00",
	"Silvia García (Fisicoculturismo y Fitness),Martes,07:00",
	"Silvia García (Fisicoculturismo y Fitness),Martes,08:00",
	"Silvia García (Fisicoculturismo y Fitness),Martes,09:00",
	"Silvia García (Fisicoculturismo y Fitness),Martes,10:00",
	"Silvia García (Fisicoculturismo y Fitness),Martes,11:00",
	"Silvia García (Fisicoculturismo y Fitness),Martes,12:00",
	"Silvia García (Fisicoculturismo y Fitness),Martes,13:00",	
	"Silvia García (Fisicoculturismo y Fitness),Miercoles,06:00",
	"Silvia García (Fisicoculturismo y Fitness),Miercoles,07:00",
	"Silvia García (Fisicoculturismo y Fitness),Miercoles,08:00",
	"Silvia García (Fisicoculturismo y Fitness),Miercoles,09:00",
	"Silvia García (Fisicoculturismo y Fitness),Miercoles,10:00",
	"Silvia García (Fisicoculturismo y Fitness),Miercoles,11:00",
	"Silvia García (Fisicoculturismo y Fitness),Miercoles,12:00",
	"Silvia García (Fisicoculturismo y Fitness),Miercoles,13:00",
	"Silvia García (Fisicoculturismo y Fitness),Jueves,06:00",
	"Silvia García (Fisicoculturismo y Fitness),Jueves,07:00",
	"Silvia García (Fisicoculturismo y Fitness),Jueves,08:00",
	"Silvia García (Fisicoculturismo y Fitness),Jueves,09:00",
	"Silvia García (Fisicoculturismo y Fitness),Jueves,10:00",
	"Silvia García (Fisicoculturismo y Fitness),Jueves,11:00",
	"Silvia García (Fisicoculturismo y Fitness),Jueves,12:00",
	"Silvia García (Fisicoculturismo y Fitness),Jueves,13:00",
	"Silvia García (Fisicoculturismo y Fitness),Viernes,06:00",
	"Silvia García (Fisicoculturismo y Fitness),Viernes,07:00",
	"Silvia García (Fisicoculturismo y Fitness),Viernes,08:00",
	"Silvia García (Fisicoculturismo y Fitness),Viernes,09:00",
	"Silvia García (Fisicoculturismo y Fitness),Viernes,10:00",
	"Silvia García (Fisicoculturismo y Fitness),Viernes,11:00",
	"Silvia García (Fisicoculturismo y Fitness),Viernes,12:00",
	"Silvia García (Fisicoculturismo y Fitness),Viernes,13:00"
	);
    ?>
    <h2>Sala de Máquina</h2>
    <table border="6" cellpadding="8" width="600px">
        <tr>
            <td>HORA</td>
    <?php
    foreach ($sem as $dia) {
        echo "<td>$dia</td>";
    }
    ?>
    </tr>
    <?php
    $x = 0;
    foreach ($horarios as $hora) {
        echo "<tr>";
        echo "<td>$hora</td>";
        foreach ($sem as $dia) {
            echo "<td>";
            foreach ($deportes as $dep) {
                $r = explode(',', $dep);
                if ($dia == $r[1] && $hora == $r[2]) {
                    echo $r[0];
                    $x = 1;
                }
            }
            if ($x == 0) {
                echo " LIBRE";
            }
            $x = 0;
            echo "</td>";
        }
        echo "</tr>";
    }
    ?>
    </table>













</body>
</html>