<?php

include ("dbconect.php");
//include ("libs.php");
$seccion=$_GET['seccion'];
$contexto=$_GET['ctx'];
if (isset($_GET['origen'])){    // si viene de avisos hay que agregar un llamado a función
    $origen = $_GET['origen'];
} else { 
    $origen = ''; 
}

if ($seccion < 4) {     // Preescolar a Bachillerato, hay que seleccionar el grupo.
    $conexionBD=new titular();
    $resultado=$conexionBD->lista_seccion($seccion);
    if ($origen == 'aviso') {
        echo '<select name="Active" id="Active" onchange="hideGrados()" ><option value=""  disabled selected>Elige el grupo</option>'."\n";
    } else {
        echo '<select name="Active" id="Active"><option value="" disabled selected>Elige el grupo</option>'."\n";
    }
    if (!$resultado) {
        echo '<option value="" disabled selected>NO SE PUDIERON CARGAR LOS GRUPOS...</option>';
    } else {
        foreach ($resultado as $reg) {
            echo '<option value="'.$reg['IdGrupo'].'">'.$reg['IdGrupo'].'</option>'."\n";
        }
    }
    echo '</select>'."\n";
} else {    // universidad
    if ($contexto == '') {  // primera vez que elige carrera, utilizamos el div select1
        if ($origen == 'aviso') {   // viene de avisos, hay que cambiar la función
            echo '<select name="ctx" id="ctx" onchange="showGrupos2()"><option value="" disabled selected>Elige la carrera</option>'."\n";
        } else {        // viene del resto de funciones de selección de grados
            echo '<select name="ctx" id="ctx" onchange="showGrupos()"><option value="" disabled selected>Elige la carrera</option>'."\n";
        }
        echo '<option value="ARQ">Arquitectura</option>'."\n";
        echo '<option value="LAV">Animación y Videojuegos</option>'."\n";
        echo '<option value="LDE">Derecho</option>'."\n";
        echo '<option value="LFC">Catequética</option>'."\n";
        echo '<option value="LFR">Fisioterapia y Rehabilitación</option>'."\n";
        echo '<option value="LNI">Negocios Internacionales</option>'."\n";
        echo '<option value="ETO">Traumatología y Ortopedia</option>'."\n";
        echo '<option value="ERD">Rehabilitación Deportiva</option>'."\n";
        echo '<option value="ERN">Rehabilitación Neurológica</option>'."\n";
    } else {                // Ya eligió carrera, hay que mostrar la lista de grupos correspondiente
        if ($origen == 'aviso') {
            echo '<select name="Active" id="Active" onchange="hideGrados()" ><option value=""  disabled selected>Elige el grupo</option>'."\n";
        } else {
            echo '<select name="Active" id="Active"><option value="" disabled selected>Elige el grupo</option>'."\n";
        }
        $conexionBD=new titular();
        $resultado=$conexionBD->lista_carrera($contexto);
        if (!$resultado) {
            echo '<option value="" disabled selected>NO SE PUDIERON CARGAR LOS GRUPOS...</option>';
        } else {
            foreach ($resultado as $reg) {
                echo '<option value="'.$reg['IdGrupo'].'"';
                if (isset($_SESSION['Activo']) && $_SESSION['Activo'] == $reg['IdGrupo']) { echo ' selected';}
                echo '>'.$reg['IdGrupo'].'</option>'."\n";
            }
        }
    }
    echo '</select>'."\n";
    } 


?>
