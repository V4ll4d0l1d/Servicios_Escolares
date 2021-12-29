<?php
error_reporting(E_ALL);
ini_set("display_errors","On");
ini_set("session.gc_maxlifetime","14400");
session_start();

include ("libs.php");           /* Librerias */
include ("dbconect.php");

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
	echo '<h2>Constancia de Aplicación del filtro sanitario en casa</h2>';
	echo '<p>Recuerda que el código solo es válido el mismo día que se generó</p>';
	// NOTA: Cambiar este mensaje en el caso de que sea Universidad
	echo '<h3>Por medio del presente formulario hago constar que he revisado a mi hijo(a) antes de salir de casa y NO presentó ninguno de los siguientes síntomas:</h3>';
	echo '
	<form id="certificado" action="generarqr.php" method="post" enctype="multipart/form-data" >
	<div class="row gtr-uniform">
		<div class="col-3 col-12-small">
			<input type="checkbox" id="temp" name="temp" required><label for="temp">Fiebre (temperatura corporal superior a 37.5°C)</label>
		</div>
		<div class="col-3 col-12-small">
			<input type="checkbox" id="dcabeza" name="dcabeza" required><label for="dcabeza">Dolor de cabeza</label>
		</div>
		<div class="col-3 col-12-small">
			<input type="checkbox" id="tos" name="tos" required><label for="tos">Tos</label>
		</div>
		<div class="col-3 col-12-small">
			<input type="checkbox" id="drespirar" name="drespirar" required><label for="drespirar">Dificultad para respirar</label>
		</div>
		<div class="col-3 col-12-small">
			<input type="checkbox" id="dgarganta" name="dgarganta" required><label for="dgarganta">Dolor de garganta</label>
		</div>
		<div class="col-3 col-12-small">
			<input type="checkbox" id="escurrimiento" name="escurrimiento" required><label for="escurrimiento">Escurrimiento nasal</label>
		</div>
		<div class="col-3 col-12-small">
			<input type="checkbox" id="alergias" name="alergias" required><label for="alergias">Alergias respiratorioas</label>
		</div>
		<div class="row gtr-uniform">
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
	//echo '<p>'.date("d-m-Y").' - '.$_SESSION['Id'].' - '.$_SESSION['Nombres'].' - '.$_SESSION['IdGrupo'].'</p>';
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
