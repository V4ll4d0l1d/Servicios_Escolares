<?php
error_reporting(E_ALL);
ini_set("display_errors","On");
ini_set("session.gc_maxlifetime","14400");
session_start();

include ("libs.php");           /* Librerias */
include ("dbconect.php");

$errorflag = 0;         // Cuenta los errores encontrados
$flagOK = 0;            // Suma los archivos subidos, debe ser igual a 1 para que se considere completo el proceso
$uploadOk = 0;          // 0 si existe algún errro, 1 si es posible subir el archivo. Se inicializa en 1 al comenzar cada validación. Esta relacionada con la variable anterior
$errores = array();     // Acumula en un arreglo los errores para mostrarlos al final
$Valida_POST = FALSE;   // Bandera que revisa que los datos en el formulario no estén vacios.
$ValidaF1 = 0;          // Se recibió el archivo
$numarchivos = 0;		// Contador para ver cuantas boletas se modificaron
$numlineas = 0;			// contador para comparar vs archivos procesados

// VALIDAR SI YA SE INICIO SESION
if (isset($_SESSION['login'])&&($_SESSION['login'] == 1)) {
} else {
    $_SESSION['login'] = 0;
    $errores = array();
    if (isset($_POST['username']) && isset($_POST['psw'])) {
        $error = Ingresar($_POST['username'], $_POST['psw']); // Validarlo, si es false no existe el usuario
    }
}

headerfull_('Reinscripcion');

/* ---------------- AQUI COMIENZA LA SECCION CENTRAL DE INFORMACION -----------------------*/
if ($_SESSION['login'] == 1) { // realizó login exitoso
    navbar();
    echo '<section>';
    // verifica que todos los datos vengan en el formulario y no sean vacios, en caso contrario debe Regresar al formulario
    $Valida_POST = (isset($_POST['descripcion']) && !empty($_POST['descripcion'])) &&
               (isset($_POST['usuario']) && !empty($_POST['usuario']));
    if (is_uploaded_file($_FILES['archivo']['tmp_name'])) { $ValidaF1 = 1; }
    
    if ($Valida_POST == FALSE) {
        echo '<script type="text/javascript">'."\n";
        echo 'alert("Los datos están incompletos, por favor revisa el formulario nuevamente");'."\n"; 
        echo 'window.location = "bloqueo.php"'."\n"; 
        echo '</script>'."\n";
        header("Location: bloqueo.php");
    } else  {
        // validar el tipo de usuario       
        switch ($_SESSION['Type']) {
            case 0:     // ALUMNO 
                echo '<h3>Bienvenido</h3>'."\n";
                echo '<p>No deberías estar aquí</p>'."\n";
                break;
            case 1:     // Usuario
                switch ($_SESSION['Privs']) {
                    case 2:
                    case 3:
                    case 4:
                        echo '  <h3>Bienvenido</h3>
                                <p>No deberías estar aquí</p>';
                        break;
                        
                    case 5:     
                        $descripcion = htmlentities($_POST['descripcion']);
                        $usuario = $_POST['usuario'];
                        $fecha = date("F j, Y, g:i a");
                        $tipo = $_POST['tipo'];
                        $target_dir = "upload/";
                        $archivo = basename($_FILES["archivo"]["name"]);                    
                        if ($_FILES["archivo"]["error"] == 0 && $ValidaF1 == 1) {
                            $uploadOk = 1;  // inicializamos banderas de subida
                            //Renombrar los archivos
                            $FileType1 = strtolower(pathinfo($archivo,PATHINFO_EXTENSION));
                            if ($tipo == 'lock') {
                                $target_file = $target_dir.'lock.txt';    // es un lock
                            } else {
                                $target_file = $target_dir.'unlock.txt';    // es un lock
                            }
                            if (file_exists($target_file)) {
                                unlink($target_file);
                            }
                            // Revisar el tipo de archivo
                            if($FileType1 != "txt") {
                                $errorflag += 1;
                                array_push ($errores, "Archivo: Solo se aceptan archivos txt");
                                $uploadOk = 0;
                            }
                            // Si cumple con todas las condiciones anteriores, es momento de subirlo
                            if ($uploadOk == 1) {
                                if (move_uploaded_file($_FILES["archivo"]["tmp_name"], $target_file)) {
                                $flagOK = 1;
                                } else {
                                    $errorflag += 1;
                                    array_push ($errores, "Archivo: Error al cargar archivo");
                                }
                            }
                        }
                        // Validar si los archivos se subieron correctamente y no hay errores, realizar el proceso
                        if ($flagOK == 1 && $errorflag == 0) {
                            $filesnumber = 0;
                            //$errormat = array();		//guarda las matriculas con error	
                            if ($tipo == 'lock') {
                                echo "<h3>Bloqueando boletas</h3>";
                                $lista = fopen("upload/lock.txt","r");
                            } else {
                                echo "<h3>Desbloqueando boletas</h3>";
                                $lista = fopen("upload/unlock.txt","r");
                            }
                            if (! $lista) {	
                                array_push($errores, "Archivo: Error al abrir el archivo");
                                $errorflag += 1;
                                echo "<p>Error al abrir el archivo: ".$php_errormsg."</p>";
                            } else {
                                // preparando archivo para logs de errores
                                $log = fopen("locks.log","a");
                                $linea = "-------- ".$usuario." - ".$tipo." - ".$fecha." ---------\n";
								echo '<p>'.$linea.'</p>';
                                fwrite($log, $linea );
                                // leyendo archivo de matriculas
                                if ($tipo == 'lock') {
                                    while (!feof($lista)) {
                                        $file=fgets($lista);
                                        // preparando nombres
                                        $filename = "boletas/".trim($file).".pdf";
                                        $newfilename = "boletas/_".trim($file).".pdf";
                                        if (@rename($filename, $newfilename)) {   // no hay errores
                                            $linea = '- ' . date('d/m/y') . ' - ' . $filename . ' - ' . $usuario .  " - ".$tipo."\n";
                                            fwrite($log, $linea );
											echo '<p>'.$file.'</p>';
                                        } else {
                                            // incrementa el contador y registralo en logs
                                            array_push($errores, $filename." no encontrado");
                                            $errorflag +=1;
                                            //fwrite($errorlog, "$filename \n");
                                        }   
                                    }
                                } else {
                                    while (!feof($lista)) {
                                        $file=fgets($lista);
                                        // preparando nombres
                                        $filename = "boletas/_".trim($file).".pdf";
                                        $newfilename = "boletas/".trim($file).".pdf";				
                                        if (@rename($filename, $newfilename)) {   // no hay errores
                                            $linea = '- ' . date('d/m/y') . ' - ' . $filename . ' - ' . $usuario .  " - ".$tipo."\n";
                                            fwrite($log, $linea );
											echo '<p>'.$file.'</p>';
                                        } else {
                                            // incrementa el contador y registralo en logs
                                            array_push($errores, $filename." no encontrado");
                                            $errorflag +=1;
                                            //fwrite($errorlog, "$filename \n");
                                        }   
                                    }
                                }
                                fclose($log);
                            }
                            // cierra archivos
                            fclose($lista);
                            
                        }
                    if ($flagOK != 1 || $errorflag > 0) { // o no se subieron los archivos o no se actualizó la BD
                        echo '
                        <h4>Errores encontrados:</h4>
                        <table id="errores">'."\n";
                        $max = sizeof($errores);
                        for($i = 0; $i < $max;$i++) {
                            $j = $i+1;
                            echo '<tr><td>'. $j .'</td><td>'.$errores[$i].'</td></tr>'."\n";
                        }
                        echo '</table><br>
                        <a href='.$_SERVER['HTTP_REFERER'].'>Regresar...</a>'."\n";
                    } else {
						echo '	<h4>Proceso terminado de forma exitosa.</h4>
								<a href='.$_SERVER['HTTP_REFERER'].'>Regresar...</a>'."\n";
					}
                    break;
                }     // switch session privs
                break;
        }       // switch type
                        
    } // fin del else de validación
}


echo '<div class="posts"></div>'."\n";
echo '</section>'."\n";
/* ------------------- AQUI TERMINA LA SECCION CENTRAL DE INFORMACION -------------------*/

/* Scripts */
scripts();

?>
