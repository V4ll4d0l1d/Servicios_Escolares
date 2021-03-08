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

headerfull_('Reinscripcion');

if ($_SESSION['login'] == 1) { // realizó login exitoso
    // validar el tipo de usuario
	navbar();
    switch ($_SESSION['Type']) {
    case 0:     // ALUMNO No debería estar aquí
        break;
    case 1:     // USUARIO
        switch ($_SESSION['Privs']) {
                case 2: // Es titular
                    if (isset($_SESSION['Activo'])) {
                        echo '<h3>Grupo: '.$_SESSION['Activo'].' - '.secciones().'</h3>';
                         listado($_SESSION['Activo']);
                    } else {
                        echo '<p>No has seleccionado un grupo para mostrar, hazlo desde el <a href="index.php">Inicio</a></p>';
                    }
                    break;
                case 3: // Es controlEscolar
/* ---------------- AQUI COMIENZA LA SECCION CENTRAL DE INFORMACION -----------------------*/
   $_matricula = $_GET['matricula'];
   $_seccion=$_GET['seccion'];
   $_cicloAct=$_GET['cicloAct'];
   $fecha=date("Y-m-d H:i:s"); 
    $status=(estatus_reinscripcion($_matricula,$_cicloAct));
   
   $conexionBD1=new Usuario();
   $resultado=$conexionBD1->datosAlumno($_matricula);
   $nombre= $resultado['Nombres'];
   $apellidos=$resultado['Apellidos'];
   $correo=$resultado['Correo'];
   $conexionBD=new alumnos();
        $resultado=$conexionBD->lista_alumnos_contacto($_matricula);
        foreach ($resultado as $registro) {
            $calle= $registro['Calle'];
            $colonia = $registro['Colonia'];
            $ciudad = $registro['Ciudad'];
            $estado = $registro['Estado'];
            $postal = $registro['Postal'];
            $tel1= $registro['TelFijo'];
            $cel1 = $registro['Celular'];
         }
		
            // Validamos que documentos existen, ponemos un 1 en cada posición si existe el fichero
            $ficheros = array('0','0','0','0');
            $directorio = "reinscripcion/".$_seccion;
            $directorios = ["ficha", "contrato", "idoficial", "domicilio"];
            $extensiones = ['pdf','jpg','jpeg','png'];
            for ($i = 0; $i < 4; $i++) {
                $target_file = $directorio . '/'.$directorios[$i]. '/'. $_matricula;
                for ($j = 0; $j < 4; $j++) {
                    $target_fileext = $target_file . '.' . $extensiones[$j];
                    if (file_exists($target_fileext)) { $ficheros[$i] = '1'; }
                }
            }
        
    
		echo '<section><h3>Datos del alumno</h3>'."\n";
        echo '<table>'."\n";
        echo '<tr><td>Matricula</td><td>'.$_matricula.'</td></tr>'."\n";
        echo '<tr><td>Nombre</td><td>'.$nombre." ".$apellidos.'</td></tr>'."\n";
        echo '<tr><td>Correo Electrónico</td><td>'.$correo.'</td></tr>'."\n";
        echo '<tr><td>Calle</td><td>'.$calle.'</td></tr>'."\n";
        echo '<tr><td>Colonia</td><td>'.$colonia.'</td></tr>'."\n";
        echo '<tr><td>Ciudad</td><td>'.$ciudad.'</td></tr>'."\n";
        echo '<tr><td>Estado</td><td>'.nomestado($estado).'</td></tr>'."\n";
        echo '<tr><td>Teléfono</td><td>'.$tel1.'</td></tr>'."\n";
        echo '<tr><td>Celular</td><td>'.$cel1.'</td></tr>'."\n";
        echo '<tr><td>Ficha de Control Escolar</td><td><a href="validpdf.php?context=10&id_alumno='.$_matricula.'&seccion='.$_seccion.'" target="_blank"> <i class="fas fa-clipboard-list"></i></a></td></tr>'."\n";
        echo '<tr><td>Contrato de Servicios*</td><td><a href="validpdf.php?context=13&id_alumno='.$_matricula.'&seccion='.$_seccion.'" target="_blank"> <i class="fas fa-file-pdf"></i></a></td></tr>'."\n";
        echo '<tr><td>Identificación Oficial*</td><td><a href="validpdf.php?context=11&id_alumno='.$_matricula.'&seccion='.$_seccion.'" target="_blank"> <i class="fas fa-address-card"></i></a></td></tr>'."\n";
        echo '<tr><td>Comprobante de Domicilio*</td><td><a href="validpdf.php?context=12&id_alumno='.$_matricula.'&seccion='.$_seccion.'" target="_blank"> <i class="fas fa-house-user"></i></a></td></tr>'."\n";
        echo '</table><hr/>'."\n";
		echo '<form id="detalleReinscripcion" action="uploaddatos.php" method="post" enctype="multipart/form-data" >';
        echo '<div class="col-12">'."\n";
            echo '<p>Actualizar el registro</p>';
            echo '</div>'."\n";
            echo '<div class="col-6 col-12-small">'."\n";
            echo 'Estatus <select name="status" id="status" tabindex="2" required>';
            echo '<option value=0 ';
            if ($status == '0') { echo ' selected'; }
            echo '>TRÁMITE EN PROCESO DE REVISIÓN</option>'."\n";
            echo '<option value=1 ';
            if ($status == '1') { echo ' selected'; }
            echo '>REVISA LA DOCUMENTACION FALTANTE</option>'."\n";
            echo '<option value=2 ';
            if ($status == '2') { echo ' selected'; }
            echo '>TRÁMITE FINALIZADO</option>'."\n";
            echo '</select>'."\n";
            echo '</div>'."\n";
            echo '<div class="col-12">'."\n";
            echo 'Observaciones para el alumno <textarea id="obs" name="obs" rows="4">';
            echo observaciones_reinscripcion($_matricula,$_cicloAct).'</textarea>';
            echo '</div>';
			echo '<input id="cicloact" name="cicloact" type="hidden" value="'.$_cicloAct.'">'."\n";
            echo '<input id="fecha" name="fecha" type="hidden" value="'.$fecha.'">'."\n";
			echo '<input id="mat" name="matricula" type="hidden" value="'.$_matricula.'">'."\n";
            echo '<div class="col-12">'."\n";
            echo '<ul class="actions fit">'."\n";
            echo '<li><input type="submit" tabindex="7" value="Actualizar" class="primary" /></li>'."\n";
            echo '</ul>'."\n";
            echo '</div>'."\n";
            
            echo '</div>'."\n";
            echo '</form>'."\n";


        break;
        }  // Fin del Switch
} // fin del else de validación
}


echo '<div class="posts"></div>'."\n";
echo '</section>'."\n";
/* ------------------- AQUI TERMINA LA SECCION CENTRAL DE INFORMACION -------------------*/

/* Scripts */
scripts();

footer();
?>
