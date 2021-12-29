<?php
error_reporting(E_ALL);
ini_set("display_errors","On");
ini_set("session.gc_maxlifetime","14400");
session_start();

include ("libs.php");           /* Librerias */
include("phpqrcode/qrlib.php"); 
include ("dbconect.php");

// VALIDAR SI YA SE INICIO SESION
if (isset($_SESSION['login'])&&($_SESSION['login'] == 1)) {
} else {
    $_SESSION['login'] = 0;
    $errores = array();
    if (isset($_POST['username']) && isset($_POST['psw'])) {
        $error = Ingresar($_POST['username'], $_POST['psw']); // Validarlo, si es false no existe el usuario
    }
}

headerfull_('Certificado diario');

/* ---------------- AQUI COMIENZA LA SECCION CENTRAL DE INFORMACION -----------------------*/
if ($_SESSION['login'] == 1) { // realizó login exitoso
		navbar();
            if (isset($_POST['matricula'])) {
                //Recuperamos datos del formulario
                $_matricula = $_POST['matricula'];
                $_nombre = $_POST['nombre'];
                $_grupo = $_POST['grupo'];
				$_autoriza = htmlentities($_POST['autoriza']);
				$_seccion = substr($_grupo, 0, 3);
				//Revisar datos
				
                if ($_matricula == $_SESSION['Id'] ) {
					
					// Grabar el registro de autorización en la BD
					$conn = new certificado();
					$cert = $conn->insert_autorizacion($_matricula, $_seccion, $_grupo, date('Y-m-d'), $_autoriza);
					if (!$cert) {
						echo '<p>ERROR AL ACTUALIZAR LA BD</P>';
					} else {
						echo '<table>'."\n";
						echo '<tr><td>Matricula</td><td>'.$_matricula.'</td></tr>'."\n";
						echo '<tr><td>Nombre</td><td>'.$_nombre.'</td></tr>'."\n";
						//echo '<tr><td>fecha</td><td>'.$_fecha.'</td></tr>'."\n";
						echo '<tr><td>Grupo</td><td>'.$_grupo.'</td></tr>'."\n";
						echo '<tr><td>Leyenda de autorización</td><td>'.$_autoriza.'</td></tr>'."\n";
						echo '<tr><td>Fecha de autorización</td><td>'.date("d").'/'.date("m").'/'.date("Y").'</td></tr>'."\n";
						echo '</table><hr/>'."\n";
						//$contenido = $_matricula.'-'.$_nombre.'-'.$_grupo.'-'.$_fecha;
						$host= gethostname();
						$ip = gethostbyname($host);
						//echo '<p>'.$ip.'</p>';
						//$contenido = 'http://'.$ip.'/servicios/registraqr2.php?id='.$_matricula.'&nombre='.$_nombre.'&grupo='.$_grupo;
						$cadena = $_matricula.'&&'.$_nombre.'&&'.$_grupo;
						$contenido = base64_encode($cadena);
						echo '<p>'.$contenido.'</p>';
						QRcode::png($contenido,"Codigo.png",QR_ECLEVEL_L,10,2);
						echo "<div><img src='Codigo.png'/></div>";
					}
				}
  
} // fin del else de validación
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
