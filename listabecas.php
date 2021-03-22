 <?php
error_reporting(E_ALL);
//ini_set("display_errors","On");
//ini_set("session.gc_maxlifetime","14400");
session_start();

include ("libs.php");           /* Librerias */
include ("dbconect.php");
$title = 'Información';
// VALIDAR SI YA SE INICIO SESION
IF (isset($_SESSION['login'])&&($_SESSION['login'] == 1)) {
    // sesion iniciada
    if (isset($_SESSION['Activo'])) { $title = $title . ' - ' .$_SESSION['Activo']; }
} else {
    // Verificar si es la primera vez que envían el login
    $_SESSION['login'] = 0;
    $errores = array();
    if (isset($_POST['username']) && isset($_POST['psw'])) {
        // Viene de un login
        $error = Ingresar($_POST['username'], $_POST['psw']); // Validarlo, si es false no existe el usuario
    }
}


headerfull_('Información');

/* ---------------- AQUI COMIENZA LA SECCION CENTRAL DE INFORMACION -----------------------*/
if ($_SESSION['login'] == 1) { // realizó login exitoso
	navbar();
	echo '<section>';
    // validar el tipo de usuario
      switch ($_SESSION['Type']) {
    case 0:     // ALUMNO No debería estar aquí
        echo '<h3>No tienes privilegios suficientes, por favor comunicate con Sistemas </h3>';
        break;
    case 1:     // USUARIO
        switch ($_SESSION['Privs']) {
                
                case 4: // Becas
                case 5: // Coordinador
				case 6: // Administrador
                    if (isset($_SESSION['Activo']) && $_SESSION['Activo'] != '') {   // Grupo Seleccionado, mostrarlo
                        echo '<h3>Grupo: '.$_SESSION['Activo'].' - '.secciones().'</h3>';
                        echo '<p><b>Vista rápida</b>, si requieres detalle haz clic en la matrícula del alumno</p>';
                         listado_becas(1);
                    } else {    // verificar las demás opciones
                        if (isset($_SESSION['Carrera']) && $_SESSION['Carrera'] != '' || $_SESSION['Seccion'] != 'NO') {    // Ojo, ¿qué pasa si es básica
                            echo '<h3>'.secciones().'</h3>';
                            echo '<p><b>Vista rápida</b>, si requieres detalle haz clic en la matrícula del alumno</p>';
                            listado_becas(2);
                        } else {
                            echo '<p>No has seleccionado una sección o grupo para mostrar, hazlo desde el <a href="index.php">Inicio</a></p>';
                        }
                    }
                    break;
				Default: // Es titular o algún otro
                    echo '<h3>No tienes privilegios suficientes, por favor comunicate con Sistemas </h3>';
                    break;
                }
            break;
        }
} else {
    echo '<header class="major"><h2>Bienvenido al Sistema de Servicios <br>Escolares del Instituto Valladolid.</h2></header>';
    echo '<p><b>Ingresa con tus credenciales</b></p>';
    if (isset($error) && strlen($error)>2) { echo '<p>'.$error.'</p>'; }
}

echo '<div class="posts"></div>';
echo '</section>';

/* ------------------- AQUI TERMINA LA SECCION CENTRAL DE INFORMACION -------------------*/


/* Scripts */
scripts();

footer();

?>
