<?php
error_reporting(E_ALL);
ini_set("display_errors","On");
ini_set("session.gc_maxlifetime","14400");
session_start();

include ("libs.php");           /* Librerias */
include ("dbconect.php");

// VALIDAR SI YA SE INICIO SESION
IF (isset($_SESSION['login'])&&($_SESSION['login'] == 1)) {
} else {        // Verificar si es la primera vez que envían el login
    $_SESSION['login'] = 0;
    $errores = array();
    if (isset($_POST['username']) && isset($_POST['psw'])) {    // Viene de un login
        $error = Ingresar($_POST['username'], $_POST['psw']); // Validarlo, si es false no existe el usuario
    }
}

headerfull_('Solicitud / Renovación de Becas');

/* ---------------- AQUI COMIENZA LA SECCION CENTRAL DE INFORMACION -----------------------*/
if ($_SESSION['login'] == 1) { // realizó login exitoso
	navbar();
	echo '<section>';
    $fecha=0;
    // validar el tipo de usuario
    switch ($_SESSION['Type']) {
    case 0:     // ALUMNO
        // INICIALIZAMOS LOS VALORES DE REINSCRIPCION
        $GradoSig = $_SESSION['Grado']+1;
        if ($_SESSION['Seccion'] > 2) { $CicloSig = CICLOSIGS; } else { $CicloSig = CICLOSIGA; }
        if ($_SESSION['Seccion'] > 2) { $CicloAct = CICLOACTS; } else { $CicloAct = CICLOACTA; }
        $tipo = '';
        // hacemos una consulta para verificar si hay datos previos.
        $conexionBD=new alumnos();
        $resultado=$conexionBD->lista_becas($_SESSION['Id'], $CicloAct);
        if (!$resultado) { 
            $flagfile = 0; // Es la primera vez que sube datos

        } else {    // tomamos los valores
            $flagfile = 1;
            foreach ($resultado as $registro) {
                $cicloact = $registro['CicloAct'];
                $ciclosig = $registro['CicloSig'];
                $status = $registro['Status'];
                $tipo = $registro['Tipo'];
                $fecha = $registro['Fecha'];
                $observaciones = $registro['Observaciones'];
            }
            // Validamos que documentos existen, ponemos un 1 en cada posición si existe el fichero
            $ficheros = array('0','0','0','0', '0');
            $directorio = "becas/".$_SESSION['Seccion'];
            $directorios = ["formato", "boleta", "ingresos", "idoficial", "estudio"];
            //$extensiones = ['pdf','jpg','jpeg','png'];
            for ($i = 0; $i < 5; $i++) {
                $target_file = $directorio . '/'.$directorios[$i]. '/'. $_SESSION['Id'].'.pdf';
                    if (file_exists($target_file)) { $ficheros[$i] = '1'; }
                }
        }
        
        if (isset($status)) {
            // Existe un registro, ¿Cómo va el proceso?
            switch ($status) {
                case 0:     // En proceso
                    echo '<h3 style="color: #0000ad;">Trámite En Proceso De Revisión</h3>';
                    break;
                case 1:     // Denegado
                    echo '<h3 style="color: #dc0000;">Trámite Con Resultado Negativo</h3>';
                    break;
                case 2:     // Aceptado
                    echo '<h3 style="color: #008d00;">Trámite Con Resultado Favorable</h3>';
                    break;
            }
            echo '<div class="col-12">'.$observaciones.'<hr/></div>';
            
        } else {
            texto_becas($_SESSION['Seccion']);
            echo '<h3>Revisa la información y actualiza los datos necesarios</h3>';
        }
        ?>
        
        <form id="beca" action="uploadbecas.php" method="post" enctype="multipart/form-data" >
         <div class="row gtr-uniform">
            <div class="col-3 col-12-small">
                Matricula <input id="matricula" name="matricula" type="text" value="<?php echo $_SESSION['Id'] ?>" readonly /> 
            </div>
            <div class="col-3 col-12-small">
                Sección <input id="seccion" name="seccion" type="text" value="<?php echo corto_seccion() ?>" readonly />
            </div>
            <div class="col-3 col-12-small">
                Ciclo Reinscripción <input id="ciclosig" name="ciclosig" type="text" value="<?php echo $CicloSig ?>" readonly /> 
            </div>
            <div class="col-3 col-12-small">
                Grado <input id="gradosig" name="gradosig" type="text" value="<?php echo $GradoSig ?>" readonly /> 
            </div>

            <div class="col-12">
                <input id="nombre" name="nombre" type="text" value="<?php echo $_SESSION['Nombres'] ?>" readonly /> 
            </div>
            <div class="col-12"><hr></div>
             <?php
        if ($flagfile == 1) {       // Ya existen archivos de este alumno.
            echo '<div class="col-12">'."\n";
            echo '<h3>Documentos Entregados anteriormente:</h3>'."\n";
            echo '</div>'."\n";
            echo '<div class="col-6 col-12-small">'."\n";
            if ($ficheros[0] == '1') { 
                echo '<input type="checkbox" id="formato_" name="formato_" checked  disabled>'."\n".'<h4><a href="'.$directorio.'/formato/'.$_SESSION['Id'].'.pdf" target = "_blank">Formato de Solicitud</a></h4>'."\n";
            } else { 
                echo '<input type="checkbox" id="formato_" name="formato_" disabled>'."\n".'<h4>Formato de Solicitud</h4>'."\n"; 
            }
            echo '</div>'."\n";
            echo '<div class="col-6 col-12-small">'."\n";
            if ($ficheros[1] == '1') { 
                echo '<input type="checkbox" id="boleta_" name="boleta_" checked disabled>'."\n".'<h4><b><a href="'.$directorio.'/boleta/'.$_SESSION['Id'].'.pdf" target = "_blank">Boleta</a></h4>'."\n";
            } else {
                echo '<input type="checkbox" id="boleta_" name="boleta_" disabled>'."\n".'<h4>Boleta</h4>'."\n";
            }
            echo '</div>'."\n";
            echo '<div class="col-6 col-12-small">'."\n";
            if ($ficheros[2] == '1') { 
                echo '<input type="checkbox" id="ingresos_" name="ingresos_" checked disabled>'."\n".'<h4><a href="'.$directorio.'/ingresos/'.$_SESSION['Id'].'.pdf" target = "_blank">Comprobante de Ingresos</a></h4>'."\n";
            } else {
                echo '<input type="checkbox" id="ingresos_" name="ingresos_" disabled>'."\n".'<h4>Comprobante de Ingresos</h4>'."\n";
            }
            echo '</div>'."\n";
            echo '<div class="col-6 col-12-small">'."\n";
            if ($ficheros[3] == '1') { 
                echo '<input type="checkbox" id="idoficial_" name="idoficial_" checked disabled>'."\n".'<h4><a href="'.$directorio.'/idoficial/'.$_SESSION['Id'].'.pdf" target = "_blank">Identificación Oficial</a></h4>'."\n";
            } else {
                echo '<input type="checkbox" id="idoficial_" name="idoficial_" disabled>'."\n".'<h4>Identificación Oficial</h4>'."\n";
            }
            echo '</div>'."\n";
            echo '<div class="col-6 col-12-small">'."\n";
            if ($ficheros[4] == '1') { 
                echo '<input type="checkbox" id="estudio_" name="estudio_" checked disabled>'."\n".'<h4><a href="'.$directorio.'/estudio/'.$_SESSION['Id'].'.pdf" target = "_blank">Estudio Socioeconómico</a></h4>'."\n";
            } else {
                echo '<input type="checkbox" id="estudio_" name="estudio_" disabled>'."\n".'<h4>Estudio Socioeconómico</h4>'."\n";
            }
            echo '</div>'."\n";
            if (isset($status) && $status == 0) {
                echo '<h3>Si lo requiere, suba los documentos solicitados en formato PDF, no mayores de 2 Mb</h3>'."\n";
            }
        } else  {       // Aún no ha subido ningun archivo, hay que solicitarlos
            echo '<h3>A continuación suba los documentos solicitados en formato PDF, no mayores de 2 Mb</h3>'."\n";
        }            
            
            if (isset($status) && $status != 0) {
                echo '<div class="col-6 col-12-small">'."\n";
                echo '<input id="tipo" name="tipo" type="text" value="'.$tipo.'" readonly />';
            } else {
                echo '<div class="col-12">'."\n";
                echo '<select name="tipo" id="tipo" tabindex="1" required>';
                echo '<option value="" disabled';
                if ($tipo=='') { echo ' selected'; }
                echo '>Tipo de Beca solicitada</option>'."\n";
                echo '<option value="int" ';
                if ($tipo == 'INT') { echo ' selected'; }
                echo '>Interna</option>'."\n";
                echo '<option value="sep" ';
                if ($tipo == 'SEP') { echo ' selected'; }
                echo '>SEP</option>'."\n";
                echo '<option value="hno" ';
                if ($tipo == 'HNO') { echo ' selected'; }
                echo '>Hermanos</option>'."\n";
                echo '</select>'."\n";
            }
            echo '</div>'."\n";
            if (!isset($status) || $status == 0) {
            ?>
            <div class="col-6 col-12-small">
            <h4>Formato de Solicitud</h4>
            <input placeholder="Formato de Solicitud" id="formato" name="formato" accept=".pdf" tabindex="2" type="file" <?php if ($flagfile == 0) {echo 'required';} ?>/> 
            <hr/></div>
            <div class="col-6 col-12-small">
            <h4>Boleta de Calificaciones</h4>
            <input placeholder="Boleta de Calificaciones" id="boleta" name="boleta" accept=".pdf" tabindex="3" type="file" <?php if ($flagfile == 0) {echo 'required';} ?>/>  
            <hr/></div>
            <div class="col-6 col-12-small">
            <h4>Comprobantes de Ingresos</h4>
            <input placeholder="Comprobantes de Ingresos" id="ingresos" name="ingresos" accept=".pdf" tabindex="4" type="file" <?php if ($flagfile == 0) {echo 'required';} ?>/>  
            <hr/></div>
            <div class="col-6 col-12-small">
            <h4>Identificación Oficial</h4>
            <input placeholder="Identificación" id="idoficial" name="idoficial" accept=".pdf" tabindex="5" type="file" <?php if ($flagfile == 0) {echo 'required';} ?>/> 
            </div>
            <div class="col-6 col-12-small">
            <h4>Pago Estudio Socioeconómico</h4>
            <input placeholder="Pago Estudio Socioeconómico" id="estudio" name="estudio" accept=".pdf" tabindex="6" type="file" class="primary"/> 
            </div>
            <input id="Flag" name="Flag" type="hidden" value="<?php echo $flagfile; ?>">
            <input id="cicloact" name="cicloact" type="hidden" value="<?php echo $CicloAct; ?>">
            <input id="fecha" name="fecha" type="hidden" value="<?php echo $fecha; ?>">
            <div class="col-12"><hr></div>
            <div class="col-12">
                <ul class="actions fit">
            <?php
            if ($flagfile == 0) {
                echo '<li><input type="submit" tabindex="7" value="Solicitar" class="primary" /></li>'."\n";
            } else {
                echo '<li><input type="submit" tabindex="7" value="Actualizar Solicitud" class="primary" /></li>'."\n";
            }
            ?>
                </ul>
            </div>
            <?php
            }
            echo '</div>'."\n";
            echo '</form>'."\n";
        break;
    case 1:     // USUARIO - Validar el tipo de usuario
        echo '<p>Regresar al <a href="index.php">inicio</a></p>'."\n";
        break;
    }
} else {
    echo '<header class="major"><h2>Bienvenido al Sistema de Servicios <br>Escolares del Instituto Valladolid.</h2></header>'."\n";
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
