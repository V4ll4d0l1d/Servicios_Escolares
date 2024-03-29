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
if(isset($_GET['id_alumno'])){$matricula=$_GET['id_alumno'];}else{$matricula = "";}

headerfull_($title);

/* ---------------- AQUI COMIENZA LA SECCION CENTRAL DE INFORMACION -----------------------*/
if ($_SESSION['login'] == 1) { // realizó login exitoso
	navbar();
	echo '<section>';
    // validar el tipo de usuario
      switch ($_SESSION['Type']) {
    case 0:     // ALUMNO No debería estar aquí
        echo '<p>Ola k ase</p>';
        break;
    case 1:     // USUARIO
        switch ($_SESSION['Privs']) {
                case 2: // Titular
				case 3: // Control Escolar
                    if (isset($_SESSION['Activo'])) {
                        echo '<h3>Grupo Activo: '.secciones(). ' - '.$_SESSION['Activo'].'</h3>';
                         listado($_SESSION['Activo']);
						 //showUser($matricula);
                    } else {
                        echo '  <h3>Esta página muestra la información académica de los alumnos de un grupo</h3>
                                <p>No has seleccionado un grupo para mostrar, hazlo desde el <a href="index.php">Inicio</a></p>'."\n";
                    }
                    break;
                case 4: // Becas hay que validar que es lo que quiere ver OJO, quizá esto sirva para el director - administrador
                    if (isset($_SESSION['Activo']) && $_SESSION['Activo'] != '') {   // Grupo Seleccionado, mostrarlo
                        echo '<h3>Grupo Activo: '.secciones(). ' - '.$_SESSION['Activo'].'</h3>';
                        echo '<p><b>Vista rápida</b>, si requieres detalle haz clic en la matrícula del alumno</p>';
                         listado_becas(1);
                    } else {    // verificar las demás opciones
                        if (isset($_SESSION['Carrera']) && $_SESSION['Carrera'] != '' || $_SESSION['Seccion'] != 'NO') {    // Ojo, ¿qué pasa si es básica
                            echo '<h3>Sección Activa: '.secciones().'</h3>';
                            echo '<p><b>Vista rápida</b>, si requieres detalle haz clic en la matrícula del alumno</p>';
                            listado_becas(2);
                        } else {
                            echo '  <h3>Esta página muestra la información de los trámites de beca por grupo o por sección</h3>
                                    <p>No has seleccionado un grupo/sección para mostrar, hazlo desde el <a href="index.php">Inicio</a></p>'."\n";
                        }
                    }
                    break; 					
                case 5: // Coordinador
				case 6: // Administrador
                    if (isset($_SESSION['Activo']) && ($_SESSION['Activo'] != '')) {
                        echo '<h3>Grupo: '.$_SESSION['Activo'].' - '.secciones().'</h3>';
                         listado_admon($_SESSION['Activo']);
                         echo '<hr>';
                    } else {
                        echo '  <h3>Esta página muestra la información académica de los alumnos de un grupo</h3>
                                <p>No has seleccionado un grupo para mostrar, hazlo desde el <a href="index.php">Inicio</a></p>'."\n";
                    }
                    break;
                }
            break;
        }
		echo '<section>
        <div id="info" class="modal" width="30%";>
        <form class="modal-content animate">
        <div class="imgcontainer"><span onclick="document.getElementById(\'info\').style.display=\'none\'" class="close" title="Close Modal">&times;</span></div>
        <div class="container">
        </div>
        </form>
        </div> <!-- Modal -->
        </section>'."\n";  
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

/*Footer*/
footer();

?>
