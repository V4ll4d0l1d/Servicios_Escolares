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
        $error = Ingresar($_POST['username'], $_POST['psw']);
    }
}

headerfull_('Circulares');

/* ---------------- AQUI COMIENZA LA SECCION CENTRAL DE INFORMACION -----------------------*/
if ($_SESSION['login'] == 1) { // realizó login exitoso
    navbar();
    echo '<section>';
    // validar el tipo de usuario
    switch ($_SESSION['Type']) {
    case 0:     // ALUMNO
        // ¿Existen avisos?
        break;
    case 1:     // USUARIO - Validar el tipo de usuario----------------------------------
        switch ($_SESSION['Privs']) {
            case 2:     // Titular
           
                break;
            case 4: // Becas
            case 5: // Coordinador
			case 6: // Administrador
                // Validar si hay una selección de Grupo o de carrera o de sección
                $ValidaSeleccion = isset($_SESSION['Activo']) || isset($_SESSION['Carrera']) && $_SESSION['Carrera'] != 'NO' || isset($_SESSION['Seccion']) && $_SESSION['Seccion'] != '10';
                if ($ValidaSeleccion) {
                    // Mostrar seccion o grupo activo
                    echo '<h4>Selección: '.secciones();
                    if (isset($_SESSION['Activo']) && $_SESSION['Activo'] != '') {
                        echo ' - Grupo: '.$_SESSION['Activo'];
                    }
                    echo '</h4>';   
                }
                // PRIMER FORMULARIO-------------------------
                echo '
					<h4>Subir Circulares</h4>
					<form method="post" action="uploadcircular.php" enctype="multipart/form-data">
					<div class="row gtr-uniform">'."\n";
                if (!$ValidaSeleccion) {
                echo '	
					<div id="ListaSeccion" name="ListaSeccion" class="col-4 col-12-xsmall">
						<select id="seccion" name="seccion" onchange="showGrupos()" tabindex="1" required>
							<option value="" disabled selected>Elige la sección</option>
							<option value="0">Preescolar</option>
							<option value="1">Primaria</option>
							<option value="2">Secundaria</option>
							<option value="3">Bachillerato</option>
							<option value="4">Universidad</option>
						</select>
					</div>
					<div id="select1" name="select1" class="col-4 col-12-xsmall">
						<select id="Active" name="Active" tabindex="2">
							<option value="" disabled selected>Elige el Grupo</option>
						</select>
					</div>
					<div id="select2" name="select2" class="col-4 col-12-xsmall">
					</div>'."\n";
                } else {
                    echo '
						<input id="seccion" name="seccion" type="hidden" value="'.$_SESSION['Seccion'].'">
						<input id="ctx" name="ctx" type="hidden" value="'.$_SESSION['Carrera'].'">
						<input id="Active" name="Active" type="hidden" value="'.$_SESSION['Activo'].'">';
                }
                echo '
					<div id="inputDescripcion" name="inputDescripcion" class="col-12">
						<label>Descripción de la circular</label>
						<input id="descripcion" name="descripcion" type="text" tabindex="4" placeholder="Descripción" required>
					</div>
					<div id="inputArchivo" name="inputArchivo" class="col-6 col-12-xsmall">
						<label>Archivo</label>
						<input id="circular" name="circular"  accept=".pdf" tabindex="5" type="file" required>
					</div>
					<div class="col-6 col-12-xsmall"><br>
						<ul class="actions">
						<li><input type="submit" value="Subir Circular" class="primary" tabindex="6"></li>
						</ul>
					</div>
					</div>
					</form>'."\n";
            
                // MOSTRAR CIRCULARES ACTUALES-------------------------------------------------------
                if ($ValidaSeleccion) {
                    lista_circulares();
                }
                break;
            }       // switch privs
        break;
    }       // switch type
} else {
    echo '<h2>Bienvenido al Sistema de Servicios Escolares del Instituto Valladolid.</h2>'."\n";
    //echo '<header class="major"><h2>Bienvenido al Sistema de Servicios Escolares del Instituto Valladolid.</h2></header>'."\n";
    echo '<p><b>Ingresa con tus credenciales</b></p>'."\n";
    if (isset($error) && strlen($error)>2) { echo '<script type="text/javascript"> alert ("'.$error.'"); </script> '."\n"; }
}

echo '<div class="posts"></div>'."\n";
echo '</section>'."\n";

/* ------------------- AQUI TERMINA LA SECCION CENTRAL DE INFORMACION -------------------*/


/* Scripts */
scripts();

/*Footer*/
footer();
?>
