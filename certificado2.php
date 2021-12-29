<?php
error_reporting(E_ALL);
ini_set("display_errors","On");
ini_set("session.gc_maxlifetime","14400");
session_start();

include ("libs.php");           /* Librerias */
include ("dbconect.php");
include("phpqrcode/qrlib.php"); 

// VALIDAR SI YA SE INICIO SESION
IF (isset($_SESSION['login'])&&($_SESSION['login'] == 1)) {
    // sesion iniciada
} else {
    // Verificar si es la primera vez que envían el login
    $_SESSION['login'] = 0;
    $errores = array();
    if (isset($_POST['username']) && isset($_POST['psw'])) {
        // Viene de un login
        $error = Ingresar($_POST['username'], $_POST['psw']); // Validarlo, si es false no existe el usuario
    }
}

headerfull_('Filtro sanitario');

/* ---------------- AQUI COMIENZA LA SECCION CENTRAL DE INFORMACION -----------------------*/
if ($_SESSION['login'] == 1) { // realizó login exitoso
	navbar();
		$conn = new certificado();
	$auto = $conn->select_autorizacion($_SESSION['Id']);
	if (!$auto) {		// No ha generado la actualización
	echo '<h2>Código QR para identificación</h2>';
		echo '<p>Como parte del protocolo para el regreso seguro a clases implementado en el Instituto Valladolid/Universidad Marista Valladolid, se solicita que se entregue diariamente
		la "Constancia de Aplicación del Filtro en Casa".</p>';
		echo '<p>Al generar el código QR de identificación y utilizarlo en lugar de la constancia aceptas que la lectura electrónica con registro de hora y fecha, suple el formato en papel y representa
		la aceptación de que en ese día tu hijo/a no tuvo ninguno de los síntomas que a continuación se menciona<</p>';
		echo '<p>
		<ul>
		<li>Fiebre (temperatura corporal superior a 37.5°C)</li>
		<li>Dolor de cabeza</li>
		<li>Tos</li>
		<li>Dificultad para respirar</li>
		<li>Dolor de garganta</li>
		<li>Escurrimiento nasal</li>
		<li>Alergias respiratorias</li>
		</ul>';
		// NOTA: Cambiar este mensaje en el caso de que sea Universidad
		echo '
		<h3>Por medio del presente formulario hago constar que he revisado a mi hijo(a) antes de salir de casa y NO presentó ninguno de los siguientes síntomas:</h3>
		<form id="certificado" action="generarqr2.php" method="post" enctype="multipart/form-data" >
		<div class="row gtr-uniform">
			<div class="row gtr-uniform">
			<div class="col-12">
				Nombre Completo del Padre de Familia o tutor
				<input id="Autoriza" type="text" name="autoriza" required>
			</div>
			<div class="col-3 col-12-small">
				Fecha <input id="fecha" name="fecha" type="text" value="'.date("d-m-Y").'" readonly />
			</div>
			<div class="col-3 col-12-small">
				Matricula <input id="matricula" name="matricula" type="text" value="'.$_SESSION['Id'].'" readonly />
			</div>
			<div class="col-3 col-12-small">
				Nombre <input id="nombre" name="nombre" type="text" value="'.$_SESSION['Nombres'].'" readonly />
			</div>
			<div class="col-3 col-12-small">
				Grupo <input id="grupo" name="grupo" type="text" value="'.$_SESSION['IdGrupo'].'" readonly />
			</div>
			<div class="col-12">
				<ul class="actions fit">
					<li><input type="submit" tabindex="7" value="Confirmar y Generar código QR" class="primary" /></li>
				</ul>
			</div>
		</div>
		</div>
	</form>';
	
	} else  {			// Ya había generado un QR, hay que mostrarlo
		$indice = count($auto);
		if ($indice>0) {
			//echo '
			//<h3>Ya has autorizado el uso del código QR como reemplazo de tu certificado diario<br/>
			//Los siguientes son los datos de autorización:</h3>
			//<table>
			//	<tr><th>Matrícula</th><th>Sección</th><th>Grupo</th><th>Fecha</th><th>Autorización</th><th>Marca de tiempo</th></tr>';
			// foreach($auto as $datos) {
            //    echo '<tr><td>'.$datos['Id'].'</td><td>'.$datos['Seccion'].' </td><td>'.$datos['Grupo'].'</td><td>'.$datos['Fecha'].'</td><td>'.$datos['Autoriza'].'</td><td>'.$datos['Timestamp'].'</td></tr>';
            //}
			//echo '</table>';
			$host= gethostname();
			$ip = gethostbyname($host);
			//echo '<p>'.$ip.'</p>';
			//$contenido = 'http://'.$ip.'/servicios/registraqr2.php?id='.$_SESSION['Id'].'&nombre='.$_SESSION['Nombres'].'&grupo='.$_SESSION['IdGrupo'];
			$cadena = $_SESSION['Id'].'&&'.$_SESSION['Nombres'].'&&'.$_SESSION['IdGrupo'];
			$contenido = base64_encode($cadena);
			echo '<p>'.$contenido.'</p>';
			QRcode::png($contenido,"Codigo.png",QR_ECLEVEL_L,10,2);
			echo '<div><center><h2>'.$_SESSION['Nombres'].'<br/>'.$_SESSION['IdGrupo'].'</h2><img src="Codigo.png"/>
			<br>'.base64_decode($contenido).'</center></div>';
		}
	}
	
} else {
    echo '<header class="major"><h2>Bienvenido al Sistema de Servicios <br>Escolares del Instituto Valladolid.</h2></header>'."\n";
    echo '<p><b>Ingresa con tus credenciales</b></p>'."\n";
    if (isset($error) && strlen($error)>2) { echo '<script type="text/javascript"> alert ("'.$error.'"); </script> '."\n"; }
}

echo '<div class="posts"></div>'."\n";
echo '</section>'."\n";

/* ------------------- AQUI TERMINA LA SECCION CENTRAL DE INFORMACION -------------------*/
// comienza el login
//<!-- main -->
footer();

/* Scripts */
scripts();

?>
