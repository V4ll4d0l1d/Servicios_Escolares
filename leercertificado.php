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

headerfull_('Usuario - Filtro sanitario');

/* ---------------- AQUI COMIENZA LA SECCION CENTRAL DE INFORMACION -----------------------*/
if (($_SESSION['login'] == 1) && ($_SESSION['Type']>0)) { // realizó login exitoso y es usuario de cualquier tipo
		navbar();

		echo '
		<form id="validar" action="registraqr3.php" method="post" enctype="multipart/form-data" >
		<div class="row gtr-uniform">
			<div class="row gtr-uniform">
			<div class="col-12">
				Lectura del código
				<input id="lectura" type="text" name="lectura" tabindex="1" autofocus required>
			</div>
			<div class="col-12">
				<ul class="actions fit">
					<li><input type="submit" tabindex="2" value="Validar código QR" class="primary" /></li>
				</ul>
			</div>
		</div>
		</div>
	</form>';
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
