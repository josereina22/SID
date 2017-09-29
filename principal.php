<?php session_start();?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>SID</title>
		<link rel="shortcut icon" href="imagenes/icon.ico" type="image/ico" />
		<link rel="stylesheet" href="fonts/estilo.css"/>
		<link rel="stylesheet" href="fonts/style.css">
		<style type="text/css">
			body {
			background-image: url("imagenes/logonuevo.jpg");
			background-repeat: no-repeat;
			background-attachment:fixed;
			background-size: 130px 75px;
		  }		
		</style>
		<script type="text/javascript" src="jquery/jquery.js"></script>
	</head>
<body>
	<header>
		<nav>
		  <ul>
			<?php
			if ($_SESSION['id_tipo_usuario']){
				$id_tipo_usuario=$_SESSION['id_tipo_usuario'];
				switch($id_tipo_usuario){
					case 1://Administrador?>
						<li><a href=""><span class="primero"><i class="icon icon-home"></i></span>Inicio</a></li>
						<li id="nav"><a href="deportista.php" target="cuerpo"><span class="segundo"><i class="icon icon-user"></i></span>Atleta</a></li>
		                <li><a href="#"><span class="tercero"><i class="icon icon-dribbble"></i></span>Clases</a>
		                   <ul>
								<li id="nav"><a href="clases.php" target="cuerpo">Crear</a></li>
								<li id="nav"><a href="clases/from_eliminar_clase.php" target="cuerpo">Gestionar</a></li>
						   </ul>
		                </li>
		                <li id="nav"><a href="entrenadores.php" target="cuerpo"><span class="cuarto"><i class="icon icon-user"></i></span>Personal</a></li>
		                <li id="nav"><a href="estadisticas.php" target="cuerpo"><span class="quinto"><i class="icon icon-bar-graph"></i></span>Estadisticas</a></li>
						<li><a href="#"><span class="sexto"><i class="icon icon-location"></i></span>Centros Deportivos</a>
		                	<ul>
								<li id="nav"><a href="instalaciones.php" target="cuerpo">Instalaciones</a></li>
								<li id="nav"><a href="canchas.php" target="cuerpo">Canchas</a></li>
		                        <li id="nav"><a href="disciplinas.php" target="cuerpo">Disciplina</a></li>
							</ul>
		                </li>
		                <li id="nav"><a href="cambio_clave.php" target="cuerpo"><span class="septimo"><i class="icon icon-key"></i></span>Administrar Perfil</a></li>
						<li><a href="destruirseccion.php"><span class="primero"><i class="icon icon-log-out"></i></span>Salir</a></li>
					<?php break;
					case 2://coordinador ?>
					
						<li><a href=""><span class="primero"><i class="icon icon-home"></i></span>Inicio</a></li>
		                <li id="nav"><a href="entrenadores_coord.php" target="cuerpo"><span class="cuarto"><i class="icon icon-user"></i></span>Entrenadores</a></li>
		                <li id="nav"><a href="cambio_clave.php" target="cuerpo"><span class="sexto"><i class="icon icon-key"></i></span>Administrar Perfil</a></li>
						<li><a href="destruirseccion.php"><span class="septimo"><i class="icon icon-log-out"></i></span>Salir</a></li>
					<?php break;
					case 3: //entrenador?>
					
						<li><a href=""><span class="primero"><i class="icon icon-home"></i></span>Inicio</a></li>
		                <li><a href="clases/clase_consulta.php" target="cuerpo"><span class="tercero"><i class="icon icon-dribbble"></i></span>Clases</a>
		                </li>
		                <li id="nav"><a href="horario/horario_entrenador.php" target="cuerpo"><span class="cuarto"><i class="icon icon-user"></i></span>Horario</a></li>
		                <li id="nav"><a href="cambio_clave.php" target="cuerpo"><span class="sexto"><i class="icon icon-key"></i></span>Administrar Perfil</a></li>
						<li><a href="destruirseccion.php"><span class="septimo"><i class="icon icon-log-out"></i></span>Salir</a></li>
				    <?php break;
				    case 4: //Cargador?>
				    
						<li><a href=""><span class="primero"><i class="icon icon-home"></i></span>Inicio</a></li>
						<li id="nav"><a href="deportista.php" target="cuerpo"><span class="segundo"><i class="icon icon-user"></i></span>Atleta</a></li>

		                <li id="nav"><a href="cambio_clave.php" target="cuerpo"><span class="sexto"><i class="icon icon-key"></i></span>Administrar Perfil</a></li>
						<li><a href="destruirseccion.php"><span class="septimo"><i class="icon icon-log-out"></i></span>Salir</a></li>
					<?php break; 
					case 5://Observador ?>
					
						<li><a href=""><span class="primero"><i class="icon icon-home"></i></span>Inicio</a></li>
		                <li id="nav"><a href="cambio_clave.php" target="cuerpo"><span class="sexto"><i class="icon icon-key"></i></span>Administrar Perfil</a></li>
						<li><a href="destruirseccion.php"><span class="septimo"><i class="icon icon-log-out"></i></span>Salir</a></li>
					<?php break;
				} // FIN CASE ?>
			<?php 
			}else{
				header('Location: index.php');
			}?>
		  </ul>
		</nav>
	</header>
	<div id="usuario" align="right" style="font-family:Georgia, 'Times New Roman', Times, serif">
					Usuario:  <?php print $_SESSION['usu']; /*print $_SESSION['id_tipo_usuario'];*/?>
	</div>
	<div id="cuerpo">
	  <script language="JavaScript">//Ajusta el tamaño de un iframe al de su contenido interior para evitar scroll
		function autofitIframe(id){
			if (!window.opera && document.all && document.getElementById){
				id.style.height=id.contentWindow.document.body.scrollHeight;
			}else if(document.getElementById){
				id.style.height=id.contentDocument.body.scrollHeight+"px";
			}
		}
	  </script>
	<iframe width="100%" height="90%" src="buscador.php" id="cuerpo" scrolling="NO" frameborder="0" name="cuerpo" transparency="transparency" onload="autofitIframe(this);"></iframe>
	</div>
</body>
</html>