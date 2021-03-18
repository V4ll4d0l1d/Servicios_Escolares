<?php 
// Para no permitir que se descarguen archivos que no correspondan al usuario activo, ni que se vean las rutas
error_reporting(E_ALL);
//ini_set("display_errors","On");
//ini_set("session.gc_maxlifetime","14400");
session_start();
include ("libs.php");           /* Librerias */
include ("dbconect.php");
$consecutivo = '';
$tipo = '';

if(isset($_GET['id'])) {
    $consecutivo=$_GET['id'];
} 

if(isset($_GET['type'])) {
    $tipo = $_GET['type'];
} 
//Validamos que solo un administrador pueda realizar el desbloqueo
if (isset($_SESSION['Privs']) && $_SESSION['Privs'] == 5) {
    $conn = new Circular();
    
    if ($conn->lockcircular($consecutivo, $tipo)) {      // se pudo hacer el update, entonces actualizar el contenido del <td>
        switch ($tipo) {
            case '1':   // Bloquear
				echo '<center><a href="#"><i class="fas fa-eye-slash" onclick="unlockcircular('.$datos['IdCircular'].', 2)"></i></a></center>';
            case '2':       // Desbloquear
                echo '<center><a href="#"><i class="fas fa-eye" onclick="unlockcircular('.$datos['IdCircular'].', 1)"></i></a></center>';
                break;
        }
    }
} else {        // no tienes privilegios, no hacer cambios
	switch ($tipo) {
            case '1':   // lock
                echo '<center><a href="#"><i class="fas fa-eye" onclick="unlockcircular('.$datos['IdCircular'].', 2)"></i></a></center>';
            case '2':       // unlock
				echo '<center><a href="#"><i class="fas fa-eye-slash" onclick="unlockcircular('.$datos['IdCircular'].', 1)"></i></a></center>';
                break;
        }
}

?>
