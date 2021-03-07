<?php
error_reporting(E_ALL);
ini_set("display_errors","On");
ini_set("session.gc_maxlifetime","14400");
session_start();

include ("libs.php");           /* Librerias */
include ("dbconect.php");

$errorflag = 0;         // Cuenta los errores encontrados
$flagOK = 0;            // Suma los archivos subidos, debe ser igual a 4 para que se considere completo el proceso
$uploadOk = 0;          // 0 si existe algún errro, 1 si es posible subir el archivo. Se inicializa en 1 al comenzar cada validación. Esta relacionada con la variable anterior
$errores = array();     // Acumula en un arreglo los errores para mostrarlos al final
$Valida_POST = FALSE;   // Bandera que revisa que los datos en el formulario no estén vacios.
$ValidaF1 = 0;          // Se envío Circular
$circular='';
$existe = 0;
$ruta = 'circulares/';

// VALIDAR SI YA SE INICIO SESION
if (isset($_SESSION['login'])&&($_SESSION['login'] != 1)) {
    $_SESSION['login'] = 0;
}

headerfull_('Avisos');

/* ---------------- AQUI COMIENZA LA SECCION CENTRAL DE INFORMACION -----------------------*/
if ($_SESSION['login'] == 1) { // realizó login exitoso
    navbar();
    echo '<section>';
    switch ($_SESSION['Type']) {
        case 0:     // alumno
            echo '<h3>No cuentas con privilegios suficientes, por favor comunicate con Sistemas</p>';
            break;
        case 1:     // usuario, validar los privs
            switch ($_SESSION['Privs']) {
                case 2: // Titular
                    echo '<h3>No cuentas con privilegios suficientes, por favor comunicate con Sistemas</p>';
                    break;
                case 4:     // Becas
                case 5:     // Administrador
                    $imagen = basename($_FILES['imagen']['name'])   ;
                    $Valida_POST = (isset($_POST['seccion']) && !empty($_POST['seccion']) &&
                                    isset($_POST['titulo']) && !empty($_POST['titulo']) &&
                                    isset($_POST['contenido']) && !empty($_POST['contenido']) &&
                                    isset($_POST['estatus']) && !empty($_POST['estatus']) &&
                                    isset($_POST['finicio']) && !empty($_POST['finicio']) &&
                                    isset($_POST['ffin']) && !empty($_POST['ffin']));
                    
                    if (is_uploaded_file($_FILES['imagen']['tmp_name'])) { $ValidaF1 = 1; }
                    if ($Valida_POST == FALSE || $ValidaF1 == 0) {
                        echo '<script type="text/javascript">'."\n";
                        echo 'alert("Los datos están incompletos, por favor revisa el formulario nuevamente");'."\n"; 
                        echo 'window.location = avisos.php"'."\n"; 
                        echo '</script>'."\n";
                        //header("Location: comunicacion.php");
                    } else  {
                        if (isset($_POST['ctx'])) {
                            $ctx = $_POST['ctx'];
                        } else { 
                            $ctx = '';
                        }
                        if (isset($_POST['Active'])) {
                            $grupo = $_POST['Active'];  
                        } else {
                            $grupo = '';
                        }
                         if (isset($_POST['grado'])) {
                            $grado = $_POST['grado'];
                        } else {
                            $grado = 0;
                        }
                        if (isset($_POST['url'])) {
                            $url = htmlentities($_POST['url'], ENT_QUOTES, "UTF-8");
                        } else {
                            $url = '';
                        }
                        // Nota: recordar que los campos son excluyentes, si elijo grupo no puedo elegir grado y viceversa.
                        // los únicos obligatorios son sección y si esta es 4 entonces ctx (carrera)
                        $ruta = 'images';
                        
                        $seccion = seccion_nombre($_POST['seccion'], $ctx);     // Convierte la sección en las iniciales
                        $titulo = htmlentities($_POST['titulo'], ENT_QUOTES, "UTF-8");
                        $contenido = htmlentities($_POST['contenido'], ENT_QUOTES, "UTF-8");
                        $estatus = $_POST['estatus'];
                        $finicio = $_POST['finicio'];
                        $ffin = $_POST['ffin'];
                        if ($_FILES["imagen"]["error"] == 0 && $ValidaF1 == 1) {  // Probamos a subir el archivo
                            $uploadOk = 1;  // inicializamos banderas de subida
                            $target_file = $ruta."/".$imagen;
                            // Revisar si el archivo existe
                            if (file_exists($target_file)) {
                                $flagOK = 1;
                                array_push ($errores, "Imagen: El archivo ya existe");
                            } else {
                                // Revisar el tipo de archivo
                                $FileType1 = strtolower(pathinfo($imagen,PATHINFO_EXTENSION));
                                if($FileType1 != "jpg" && $FileType1 != "jpeg" && $FileType1 != "png" ) {
                                    $errorflag += 1;
                                    array_push ($errores, "Imagen: Solo se aceptan archivos JPEG o PNG: ".$FileType1);
                                    $uploadOk = 0;
                                }
                                if ($uploadOk == 1) {
                                    if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
                                        $flagOK = 1;
                                        // cambiar tamaño de imagen|
                                        switch ($FileType1) {
                                            case 'jpg':
                                            case 'jpeg':
                                                $temp_img = resize_imagejpg($target_file, -1, 256);
                                                imagejpeg($temp_img, $target_file);
                                                break;
                                            case 'png':
                                                $temp_img = resize_imagepng($target_file, -1, 256);
                                                imagepng($temp_img, $target_file);
                                                break;
                                            }
                                        imagedestroy($temp_img);                                        
                                    } else {
                                        $errorflag += 1;
                                        array_push ($errores, "Imagen: Error al cargar archivo");
                                    }
                                }
                                // Si cumple con todas las condiciones anteriores, es momento de subirlo
                            }
                        }
                        // Validar si los archivos se subieron correctamente y no hay errores, entonces intentar actualizar la BD
                        if ($flagOK == 1 && $errorflag == 0) {
                            //Subir los datos del formulario
                            $conexionBD=new Aviso();
                            $result=$conexionBD->insert_aviso ($seccion, $grado, $grupo, $titulo, $contenido, $url, $target_file, $finicio, $ffin, $estatus, $_SESSION['Id']);
                            if (!$result) {
                                $errorflag += 1;
                                array_push ($errores, "Base de Datos: Error al actualizar los datos");
                            }
                        }
                        // Validar si se actualizó la BD y se subió el archivo
                        echo '<table id="errores">'."\n";
                        echo '<tr><td>Seccion</td><td>'.$seccion.'</td></tr>';
                        echo '<tr><td>Grado</td><td>'.$grado.'</td></tr>';
                        echo '<tr><td>Grupo</td><td>'.$grupo.'</td></tr>';
                        echo '<tr><td>Título</td><td>'.$titulo.'</td></tr>';
                        echo '<tr><td>Contenido</td><td>'.$titulo.'</td></tr>';
                        echo '<tr><td>Imagen</td><td><a href="'.$target_file.'" target="_blank">'.$target_file.'</a></td></tr>';
                        echo '<tr><td>Url</td><td><a href="'.$url.'" target="_blank">'.$url.'</a></td></tr>';
                        echo '<tr><td>Fecha de inicio</td><td>'.$finicio.'</td></tr>';
                        echo '<tr><td>Fecha de término</td><td>'.$ffin.'</td></tr>';
                        echo '<tr><td>Activo</td><td>'.$estatus.'</td></tr>';
                        
                        if ($errorflag > 0) { // o no se subieron los archivos o no se actualizó la BD
                            echo '<tr><th colspan=2><h4>ERRORES ENCONTRADOS</h4> No se pudo subir la circular...</th></tr>'."\n";

                            $max = sizeof($errores);
                            for($i = 0; $i < $max;$i++) {
                                $j = $i+1;
                                echo '<tr><td>'. $j .'</td><td>'.$errores[$i].'</td></tr>'."\n";
                            }
                        }
                        echo '</table><br>'."\n"; 
                        echo '<a href='.$_SERVER['HTTP_REFERER'].'>Regresar a formulario</a>'."\n";
                    }
                    break;
                default:
                    echo '<p>¿Qué haces aquí?</p>';
                }   // termina case privs
            
            }           // Fin del Switch type
    } // fin del else de validación


//echo '<div class="posts"></div>'."\n";
//echo '</section>'."\n";
/* ------------------- AQUI TERMINA LA SECCION CENTRAL DE INFORMACION -------------------*/


/* Scripts */
scripts();

?>
