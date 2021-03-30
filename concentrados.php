 <?php
error_reporting(E_ALL);
ini_set("display_errors","On");
ini_set("session.gc_maxlifetime","14400");
session_start();

include ("libs.php");           /* Librerias */
include ("dbconect.php");
$title = 'Concentrados';
// VALIDAR SI YA SE INICIO SESION
if (isset($_SESSION['login'])&&($_SESSION['login'] == 1)) {
    // sesion iniciada
    if (isset($_SESSION['Activo'])) { $title = $title . ' - ' .$_SESSION['Activo'];}
} else {
    // Verificar si es la primera vez que envían el login
    $_SESSION['login'] = 0;
    $errores = array();
    if (isset($_POST['username']) && isset($_POST['psw'])) {
        // Viene de un login
        $error = Ingresar($_POST['username'], $_POST['psw']); // Validarlo, si es false no existe el usuario
    }
}
//if(isset($_GET['id_alumno'])){$matricula=$_GET['id_alumno'];}else{$matricula = "";}

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
                case 2: // Es titular
                    if (isset($_SESSION['Activo'])) {
                        echo '<h3>Concentrado: '.secciones(). ' - '.$_SESSION['Activo'].'</h3>';?>
                         <?php 
						 $archivo='Concentrados/'.$_SESSION['Activo'].'.pdf'; 
						 if (file_exists($archivo)) {?>
						 <table> <tr><th>Archivo</th><th>Fecha de subida</th></tr>
						    <tr><td><a href="<?php echo $archivo; ?>"  target="_blank"><i class="fas fa-file-pdf"></i></a></td>
							    <td><?php echo date("F d Y", filectime($archivo)); ?></td>;								
							</tr>
							</table>
							<?php 
							} else {
								echo "No existe concentrado, favor de verificarlo con el encargado de Control Escolar ";
 							}?>
					<?php
                    } else {
                        echo '  <h3>Concentrado</h3>
                                <p>No has seleccionado un grupo para mostrar, hazlo desde el <a href="index.php">Inicio</a></p>'."\n";
                    }
                    break;
                case 3://Control Escolar
				case 5://Coordinador
				case 6://Administrador
					//echo '<h3>Grupo Activo: '.secciones(). ' - '.$_SESSION['Activo'].'</h3>';	
						if(isset($_POST["submitDropzone"])) {  
							// Do something    
							print_r($_POST);
						}

						?>
							<form id="dropzone-form" action=#"" method="POST" enctype="multipart/form-data">
								<div id="dropzone" class="dropzone col-12 col-12-small"></div>
								<div class="col-12 col-12-small">
									<input id="submit-dropzone" class="primary" type="submit" name="submitDropzone" value="Subir Archivos" />
								</div>
							</form>
							<h3>Concentrados</h3>
							<div>Para que el titular pueda ver el archivo debe escribir el grupo al cual pertenece el concentrado. El nombre del archivo debe ser
							<?php echo corto_seccion()?>21 
							3 Caracteres[Seccion]
							1 digito[Grado]
							1 digito[Grupo]
							<br/><br/>
							</div>
							<div class="col-12 col-12-small" id="preview"></div>

						<?php
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
        </section>';  
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
//Funcion para subir concentrados arrastrando el archivo
echo '<script src="assets/js/dropzone.js"></script>'."\n";
echo '<script src="assets/js/drop.js"></script>'."\n";
/*Footer*/
footer();

?>


