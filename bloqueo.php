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


headerfull_($title);

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
                case 2: // Es titular
                case 4: // Becas
                    echo '<h3>No tienes privilegios suficientes, por favor comunicate con Sistemas </h3>';
                    break;
                case 5: //Administrador
                    echo '
                    <h4>Bloquear Boletas</h4>
                    <form method="post" action="uploadlock.php" enctype="multipart/form-data">
                        <div class="row gtr-uniform">
                            <div class="col-12">
                                <label>Descripción del Bloqueo</label>
                                <input id="descripcion" name="descripcion" type="text" tabindex="1" placeholder="Descripción" required>
                            </div>
                            <div class="col-6 col-12-xsmall">
                                <label>Archivo</label>
                                <input id="archivo" name="archivo"  accept=".txt" tabindex="2" type="file" required>
                            </div>
                            <div class="col-6 col-12-xsmall"><br>
                                <ul class="actions">
                                <li><input type="submit" value="Bloquear" class="primary" tabindex="3"></li>
                                </ul>
                                <input id="usuario" name="usuario" type="hidden" value="'.$_SESSION['Id'].'">
                                <input id="tipo" name="tipo" type="hidden" value="lock">
                            </div>
                        </div>
                    </form>';
                    echo '
                    <h4>Desbloquear Boletas</h4>
                    <form method="post" action="uploadlock.php" enctype="multipart/form-data">
                        <div class="row gtr-uniform">
                            <div class="col-12">
                                <label>Descripción del Desbloqueo</label>
                                <input id="descripcion" name="descripcion" type="text" tabindex="4" placeholder="Descripción" required>
                            </div>
                            <div class="col-6 col-12-xsmall">
                                <label>Archivo</label>
                                <input id="archivo" name="archivo"  accept=".txt" tabindex="5" type="file" required>
                            </div>
                            <div class="col-6 col-12-xsmall"><br>
                                <ul class="actions">
                                <li><input type="submit" value="Desbloquear" class="primary" tabindex="6"></li>
                                </ul>
                                <input id="usuario" name="usuario" type="hidden" value="'.$_SESSION['Id'].'">
                                <input id="tipo" name="tipo" type="hidden" value="unlock">
                            </div>
                        </div>
                    </form>';
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
