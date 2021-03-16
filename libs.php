<?php
//-----------------------------------------------------------------------------------------------------------------------------------------
// CONSTANTES y ARREGLOS
//-----------------------------------------------------------------------------------------------------------------------------------------

define ('CICLOACTUAL', '2020-2021');
define ('CICLOACTS', '20-1');
define ('CICLOSIGS', '20-2');
define ('CICLOACTA', '20-0');
define ('CICLONEXT', '2021-2022');
//define ('CICLOSIGS', '21-1');
define ('CICLOSIGA', '21-0');
define ('RINSC_SEM', '1');          // Variable para activar los datos de reinscripción semestral: 0 para desactivar, 1 para activar
define ('RINSC', '2');              // Variable para activar los menus de reinscripcion anual: 0 NO, 1 ANUAL, 2 SEMESTRAL
define ('ESTADOS', array(
 ['1','Aguascalientes'], ['2', 'Baja California'], ['3','Baja California Sur'], ['4','Campeche'], ['5','Coahuila'], ['6','Colima'], ['7','Chiapas'],
 ['8','Chihuahua'], ['9','Ciudad de México'], ['10','Durango'], ['11','Guanajuato'],['12','Guerrero'], ['13','Hidalgo'],['14','Jalisco'],
 ['15','México'], ['16','Michoacán'], ['17','Morelos'],['18','Nayarit'], ['19','Nuevo León'], ['20','Oaxaca'], ['21','Puebla'],
 ['22','Querétaro'], ['23','Quintana Roo'], ['24','San Luis Potosí'], ['25','Sinaloa'], ['26','Sonora'], ['27','Tabasco'], ['28','Tamaulipas'],
 ['29','Tlaxcala'], ['30','Veracruz'], ['31','Yucatán'], ['32','Zacatecas']));

define ('CARRERAS', array (['ARQ','ARQUITECTURA'],['LAV','ANIMACIÓN Y VIDEOJUEGOS'],['LDE','DERECHO'], ['LFC','FORMACIÓN CATEQUÉTICA'],
['LFR','FISIOTERAPIA Y REHABILITACIÓN'], ['LNI','NEGOCIOS INTERNACIONALES'], 
['ETO','TRAUMATOLOGÍA Y ORTOPEDIA'], ['ERD','REHABILITACIÓN DEPORTIVA'], ['ERN','REHABILITACIÓN NEUROLÓGICA']));
 
define ('MAXFILESIZE', 2097152);

//******************************************************************************************************************************
//******************************************************************************************************************************
//******************************************************************************************************************************
//******************************************************************************************************************************
//******************************************************************************************************************************

// FUNCIONES AUXILIARES AUXILIARES AUXILIARES AUXILIARES AUXILIARES AUXILIARES AUXILIARES AUXILIARES AUXILIARES AUXILIARES

//******************************************************************************************************************************
//******************************************************************************************************************************
//******************************************************************************************************************************
//******************************************************************************************************************************
//******************************************************************************************************************************
 
 
//*************************************************************************************************
// Funcion:     nomestado()
// Descripción: Cambia el numero del estado por su nombre
// Parametros:  numero de estado
// Regresa una variable texto con el nombre del estado
//*************************************************************************************************
function nomestado($state) {
    foreach (ESTADOS as list($clave, $valor)) {
        if ($clave == $state) {
            return $valor;
        }
    }
 }

function select_carrera($selected) {
    foreach (CARRERAS as list($clave, $valor)) {
        echo '<option value="'.$clave.'"';
        if ($clave == $selected) { echo ' selected'; }
        echo '>'.$valor.'</option>';
    }
}
 
 
function ciclo_actual() {
    if (isset($_SESSION['Seccion'])) {
        switch ($_SESSION['Seccion']) {
            case 0:
            case 1:
            case 2:
                $ciclo = CICLOACTA;
                break;
            case 3:
            case 4:
                $ciclo = CICLOACTS;
                break;
            }
        return $ciclo;
    } else {
        return CICLOACTA;
    }
}
//*************************************************************************************************
// Funcion:     tipobeca($tipo)
// Descripción: Cambia la clave de la beca por la descripcion completa
// Parametros:  tipo de beca
// Regresa una variable texto con la descripción
//*************************************************************************************************
function tipobeca($tipo) {
    switch ($tipo) {
        case 'INT':
            return "Interna";
            break;
        case 'SEP':
            return "SEP";
            break;
        case 'HNO':
            return "Hermanos";
            break;
        default:
            return "Sin definir";
    }
 }
//*************************************************************************************************
// Funcion:     Secciones
// Descripción: Cambia el numero de la sección por su nombre y/o carrera
// Parametros:  Ninguno
// Regresa una variable texto con el nombre de la sección correspondiente
//*************************************************************************************************
function secciones() {
    $nombre = "";
    switch ($_SESSION['Seccion']) {
        case 0:
            $nombre = "PREESCOLAR";
            break;
        case 1:
            $nombre = "PRIMARIA";
            break;
        case 2:
            $nombre = "SECUNDARIA";
            break;
        case 3:
            $nombre = "PREPARATORIA";
            break;
        case 4:
            switch ($_SESSION['Carrera']) {
                case 'ARQ':
                    $nombre = "ARQUITECTURA";
                    break;
                case 'IND':
                    $nombre = "INDUSTRIAL";
                    break;
                case 'LAV':
                    $nombre = "ANIMACIÓN y VIDEOJUEGOS";
                    break;
                case 'LDE':
                    $nombre = "DERECHO";
                    break;
                case 'LNI':
                    $nombre = "NEGOCIOS";
                    break;
                case 'LFR':
                    $nombre = "FISIOTERAPIA Y REHABILITACIÓN";
                    break;
                case 'LFC':
                    $nombre = "FORMACIÓN CATEQUÉTICA";
                    break;
                case 'EFT':
                    $nombre = "TRAUMATOLOGÍA y ORTOPEDIA";
                    break;
                case 'EFN':
                    $nombre = "REHABILITACIÓN NEUROLÓGICA";
                    break;
                case 'EFD':
                    $nombre = "REHABILITACIÓN DEPORTIVA";
                    break;
                default:
                    $nombre = "UNIVERSIDAD";
                    break;
                
            }
            break;
        default:
            $nombre = "INSTITUTO VALLADOLID";
            break;
                
    }
    return $nombre;
}

function corto_seccion() {
    $nombre = "";
    switch ($_SESSION['Seccion']) {
        case 0:
            $nombre = "PRE";
            break;
        case 1:
            $nombre = "PRI";
            break;
        case 2:
            $nombre = "SEC";
            break;
        case 3:
            $nombre = "BAC";
            break;
        case 4:
            $nombre = $_SESSION['Carrera'];
            break;
        default:
            $nombre = "UNI";
            break;
    }
    return $nombre;
}

//*************************************************************************************************
// Funcion:     Seccion_nombre para las circulares, convertir estas tres funciones en una sola aunque pases parametros
// Descripción: Cambia el numero de la sección por su nombre y/o carrera
// Parametros:  Ninguno
// Regresa una variable texto con el nombre de la sección correspondiente
//*************************************************************************************************
function seccion_nombre($seccion, $ctx) {
    $nombre = "";
    switch ($seccion) {
        case 0:
            $nombre = "PRE";
            break;
        case 1:
            $nombre = "PRI";
            break;
        case 2:
            $nombre = "SEC";
            break;
        case 3:
            $nombre = "BAC";
            break;
        case 4:
            if ($ctx != '') {
                $nombre = $ctx;
            } else {
                $nombre = "UNI";
            }
            break;
    }
    return $nombre;
}


function grado_seccion() {
$grados = 0;
    switch ($_SESSION['Seccion']) {
        case 0:
            $grados = 3;
            break;
        case 1:
            $grados = 6;
            break;
        case 2:
            $grados = 3;
            break;
        case 3:
            $grados = 6;
            break;
        case 4:
            $grados = 8;
            break;
    }
    return $grados;
}



// for jpg 
function resize_imagejpg($file, $w, $h) {
   $src = imagecreatefromjpeg($file);
   $dst = imagescale($src, $w, $h);
   return $dst;
}

 // for png
function resize_imagepng($file, $w, $h) {
   $src = imagecreatefrompng($file);
   $dst = imagescale($src, $w, $h);
   return $dst;
}

// for gif
function resize_imagegif($file, $w, $h) {
   $src = imagecreatefromgif($file);
   $dst = imagescale($src, $w, $h);
   return $dst;
}




//-----------------------------------------------------------------------------------------------------------------------------------------

//******************************************************************************************************************************
//******************************************************************************************************************************
//******************************************************************************************************************************
//******************************************************************************************************************************
//******************************************************************************************************************************

// FUNCIONES DE ESTILO   ESTILO ESTILO ESTILO ESTILO ESTILO ESTILO ESTILO ESTILO ESTILO ESTILO ESTILO ESTILO ESTILO ESTILO ESTILO

//******************************************************************************************************************************
//******************************************************************************************************************************
//******************************************************************************************************************************
//******************************************************************************************************************************
//******************************************************************************************************************************

//*************************************************************************************************
// Funcion:     header
// Descripción: Header y Title de la página
// Parametros:  Titulo
//*************************************************************************************************

function headerfull_($title) {
echo '<!DOCTYPE HTML><html>'."\n";
echo '<head>'."\n";
echo '<title>'.$title.'</title>'."\n";
echo '<meta charset="utf-8" />'."\n";
echo '<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />'."\n";
echo '<link rel="stylesheet" href="assets/css/main.css" />'."\n";
echo '<link href="assets/css/fontawesome-all.min.css" rel="stylesheet">'."\n";
echo '</head>'."\n";
echo '<body class="is-preload">'."\n";
echo '<div id="wrapper">'."\n";         // Inicia el div que contiene todo  
echo '<div id="main">'."\n";            // Inicia el div que contiene el body
echo '<div class="inner">'."\n";        // Bloque derecho
echo '<div id="prueba_ylw">';			//División sólo para inicio de sesión
if ($_SESSION['login'] == 1) {
    echo '<header id="header"><a href="index.php" class="logo">'.$_SESSION['Nombres'].' - <strong>'.$title.'</strong></a>'."\n";
} else {
    echo '<header id="header"><a href="index.php" class="logo"><strong>Instituto Valladolid</strong> - Servicios Escolares</a>'."\n";
}
echo '<ul class="icons">'."\n";
if ($_SESSION['login'] == 1) {
    echo '<a href="logout.php" class="logo"><li class="icon solid fa-sign-out-alt" style="width:auto;">Salir</li></a>'."\n";
} else {
?>
    <a href="#" class="logo"><li class="icon solid fa-key" onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Ingresar</li></a>
<?php
    }
echo '</ul></header></div>'."\n";
 

}


//*************************************************************************************************
// Funcion:     login_logout
// Descripción: acceso al formulario de login o al exit
// Parametros:  Titulo
//*************************************************************************************************
function login_logout() {
//echo '<section>'."\n";
echo '<div id="id01" class="modal" width="30%";>'."\n";
echo '<form class="modal-content animate" action="index.php" method="post">'."\n";
echo '<div class="imgcontainer"><span onclick="document.getElementById(\'id01\').style.display=\'none\'" class="close" title="Close Modal">&times;</span></div>'."\n";
echo '<div class="container">'."\n";
echo '<label for="uname"><b>Usuario</b></label>'."\n";
echo '<input type="text" placeholder="Ingresar matrícula" name="username" required>'."\n";
echo '<label for="psw"><b>Contraseña</b></label>'."\n";
echo '<input type="password" placeholder="Ingresa Contraseña" name="psw" required>'."\n";
echo '<button type="submit" class="loginbutton">Ingresar</button>'."\n";
echo '</div>'."\n";
//echo '<div class="container" style="background-color:#f1f1f1"><span class="psw">¿Olvidaste tu <a href="#">Contraseña?</a></span><br><br></div>';
echo '</form>'."\n";
echo '</div> <!-- Modal -->'."\n";
//echo '</section>'."\n";
// Para la información de los alumnos, solo si es un docente
scriptmuestra(2);

echo '</div>  <!-- inner -->'."\n";
echo '</div>'."\n";
}
//*************************************************************************************************
// Funcion:     scriptmuestra
// Descripción: carga el script y el div dependiendo del contexto de la llamada (1 header, 2 footer) validando privilegios
// Parametros:  contexto
//*************************************************************************************************
function scriptmuestra($pos) {
if (isset($_SESSION['Privs']) && $_SESSION['Privs'] > 1) {      // Solo se ejecuta si los privilegios de usuario son mayores a 2

    switch ($pos) {
        case 1:     // se utiliza para copiar este texto en el header; el parametro es la matricula del alumno a consultar
            ?>
<script>
function showUser(str) {
  if (str == "") {
    document.getElementById("info").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        //document.getElementById("info").style.display='block';
        document.getElementById("info").innerHTML = this.responseText;
        document.getElementById("info").style.display='inline-block';
      }
    };
    xmlhttp.open("GET","getuser.php?q="+str,true);
    xmlhttp.send();
  }
}
</script>
<?php
        break;
    case 2:     // se utiliza para copiar este texto en el footer
        echo '<section>'."\n";
        echo '<div id="info" class="modal" width="30%";>'."\n";
        echo '<form class="modal-content animate">'."\n";
        echo '<div class="imgcontainer"><span onclick="document.getElementById(\'info\').style.display=\'none\'" class="close" title="Close Modal">&times;</span></div>'."\n";
        echo '<div class="container">'."\n";
        echo '<br><table width="60%">'."\n";
        echo '<tr><th colspan=2>Datos</th></tr>'."\n";
        echo '<tr><td>Calle:</td><td></td></tr>'."\n";
        echo '<tr><td>Colonia:</td><td></td></tr>'."\n";
        echo '<tr><td>Ciudad:</td><td></td></tr>'."\n";
        echo '<tr><td>Estado:</td><td></td></tr>'."\n";
        echo '<tr><td>Código Postal:</td><td></td></tr>';
        echo '<tr><td>Teléfono:</td><td></td></tr>'."\n";
        echo '<tr><td>Celular:</td><td></td></tr>'."\n";; 
        echo '<tr><td>Correo electrónico:</td><td></td></tr>'."\n";; 
        echo '</table>'."\n";
        echo '</div>'."\n";
        echo '</form>'."\n";
        echo '</div> <!-- Modal -->'."\n";
        echo '</section>'."\n";    
        break;
    }
}

}


//*************************************************************************************************
// Funcion:     Sidebar
// Descripción: Menús laterales en función a la sección
// Parametros:  $type: Tipo de usuario 'alumno' 0 /'usuario' 1
//*************************************************************************************************

function navbar(){
	$type = $_SESSION['Type'];
	echo '<div class="topnav" id="myTopnav">
		<a class="active" href="index.php"><i class="fa fa-fw fa-home"></i> INICIO</a>';
	switch ($type) {
    case '0':   // Es ALUMNO
		echo '<div class="dropdown">
			<button class="dropbtn"><i class="fa fa-fw fa-graduation-cap"></i> ACADÉMICO</button>
			<div class="dropdown-content">
				<a href="validpdf.php?context=1&id_alumno='.$_SESSION['Id'].'" target="_blank">Boleta</a>
				<a href="circulares.php">Circulares</a>
				<a href="reglamento.php">Reglamento</a>';
				if (RINSC == 1 && $_SESSION['Seccion'] > 2) { // Se activa la reinscripcion semestral para prepa y uni
                    echo '<a href="reinscripcion.php">Reinscripción</a>';
				} else {
					if (RINSC == 2) { //  Se activa reinscripcion anual, para todos
						echo '<a href="reinscripcion.php">Reinscripción</a>';
					}
				}
		echo '</div></div>
		<div class="dropdown">
		<button class="dropbtn"><i class="fa fa-fw fa-money-check-alt"></i> FINANCIERO</button>
			<div class="dropdown-content">
			<a href="recibos.php">Recibo de pago</a>
			<a href="formapago.php">Formas de pago</a>
			<a href="becas.php">Trámite de Beca</a>
			</div>
		</div>
		<a class="active" href="index.php#contactUs" style><i class="fa fa-fw fa-user"></i> CONTACTO</a>
		<div class="dropdown">
			<a href="javascript:void(0);" class="icon" onclick="responsiveMenu()">
			<i class="fa fa-bars"></i></a>
		</div>';
		//</div>';
	break;
	case '1': // Es USUARIO
    // Validar el tipo de usuario y los privilegios
		switch ($_SESSION['Privs']) {
			case '2':     // Titulares
				echo '<div class="dropdown">
				<button class="dropbtn"><i class="fa fa-fw fa-graduation-cap"></i> ACADÉMICO</button>
					<div class="dropdown-content">
						<a href="informacion.php">Información</a>
						<a href="circulares.php">Circulares</a>
						<a href="avisos.php">Enviar mensajes</a>
					</div>
				</div>
				<div class="dropdown">
				<button class="dropbtn"><i class="fa fa-fw fa-link"></i> ENLACES</button>
					<div class="dropdown-content">
						<a href="http://aulavirtual.umvalla.edu.mx" target="_blank">Aula Virtual</a>
						<a href="http://valladolid.edu.mx" target="_blank">Instituto Valladolid</a>
						<a href="http://umvalla.edu.mx" target="_blank">Universidad Marista Valladolid</a>';
						if (isset($_SESSION['Id'])) {
							switch ($_SESSION['Seccion']) {
								case 0:
									echo '<a href="media/Anuario_Preescolar.pdf" target="_blank">Anuario Escolar</a>';
								break;
								case 1:
									echo '<a href="media/Anuario_Primaria.pdf" target="_blank">Anuario Escolar</a>';
								break;
								case 2:
									echo '<a href="media/Anuario_Secundaria.pdf" target="_blank">Anuario Escolar</a>';
								break;
								case 3:
									echo '<a href="media/Anuario_Bachillerato.pdf" target="_blank">Anuario Escolar</a>';
								break;
								case 4:
									echo '<a href="media/Anuario_Universidad.pdf" target="_blank">Anuario Escolar</a>';
								break;
							}
						}
				echo	'</div>
				</div>
				<a class="active" href="index.php#contactUs" style><i class="fa fa-fw fa-user"></i> CONTACTO</a>
				<div class="dropdown">
					<a href="javascript:void(0);" class="icon" onclick="responsiveMenu()">
				<i class="fa fa-bars"></i></a>
				</div>';
            break;
				case '3':     // ControlEscolar
				echo '<div class="dropdown">
				<button class="dropbtn"><i class="fa fa-fw fa-graduation-cap"></i> ACADÉMICO</button>
					<div class="dropdown-content">
						<a href="reinscripciones.php">Reporte preinscripcion</a>
					</div>
				</div>
				<div class="dropdown">
				<button class="dropbtn"><i class="fa fa-fw fa-link"></i> ENLACES</button>
					<div class="dropdown-content">
						<a href="http://aulavirtual.umvalla.edu.mx" target="_blank">Aula Virtual</a>
						<a href="http://valladolid.edu.mx" target="_blank">Instituto Valladolid</a>
						<a href="http://umvalla.edu.mx" target="_blank">Universidad Marista Valladolid</a>';
						if (isset($_SESSION['Id'])) {
							switch ($_SESSION['Seccion']) {
								case 0:
									echo '<a href="media/Anuario_Preescolar.pdf" target="_blank">Anuario Escolar</a>';
								break;
								case 1:
									echo '<a href="media/Anuario_Primaria.pdf" target="_blank">Anuario Escolar</a>';
								break;
								case 2:
									echo '<a href="media/Anuario_Secundaria.pdf" target="_blank">Anuario Escolar</a>';
								break;
								case 3:
									echo '<a href="media/Anuario_Bachillerato.pdf" target="_blank">Anuario Escolar</a>';
								break;
								case 4:
									echo '<a href="media/Anuario_Universidad.pdf" target="_blank">Anuario Escolar</a>';
								break;
							}
						}
				echo	'</div>
				</div>
				<div class="dropdown">
					<a href="javascript:void(0);" class="icon" onclick="responsiveMenu()">
					<i class="fa fa-bars"></i></a>
				</div>';
            break;
			
			case '4':
				echo '<a class="active" href="listabecas.php">BECAS</a>
				<a class="active" href="#">REPORTE ENTREGA</a>
				<div class="dropdown">
				<button class="dropbtn"><i class="fa fa-fw fa-link"></i> ENLACES</button>
					<div class="dropdown-content">
						<a href="http://aulavirtual.umvalla.edu.mx" target="_blank">Aula Virtual</a>
						<a href="http://valladolid.edu.mx" target="_blank">Instituto Valladolid</a>
						<a href="http://umvalla.edu.mx" target="_blank">Universidad Marista Valladolid</a>';
						if (isset($_SESSION['Id'])) {
							switch ($_SESSION['Seccion']) {
								case 0:
									echo '<a href="media/Anuario_Preescolar.pdf" target="_blank">Anuario Escolar</a>';
								break;
								case 1:
									echo '<a href="media/Anuario_Primaria.pdf" target="_blank">Anuario Escolar</a>';
								break;
								case 2:
									echo '<a href="media/Anuario_Secundaria.pdf" target="_blank">Anuario Escolar</a>';
								break;
								case 3:
									echo '<a href="media/Anuario_Bachillerato.pdf" target="_blank">Anuario Escolar</a>';
								break;
								case 4:
									echo '<a href="media/Anuario_Universidad.pdf" target="_blank">Anuario Escolar</a>';
								break;
							}
						}
				echo	'</div>
				</div>
				<a class="active" href="index.php#contactUs" style><i class="fa fa-fw fa-user"></i> CONTACTO</a>
				<div class="dropdown">
					<a href="javascript:void(0);" class="icon" onclick="responsiveMenu()">
					<i class="fa fa-bars"></i></a>
				</div>';
            break;
			case '5':     // Admin
				echo '<div class="dropdown">
				<button class="dropbtn"><i class="fa fa-fw fa-graduation-cap"></i> ACADÉMICO</button>
					<div class="dropdown-content">
						<a href="informacion.php">Información</a>
						<a href="reinscripciones.php">Reinscripciones</a>
						<a href="comunicacion.php">Circulares</a>
						<a href="avisos.php">Avisos</a>
						<a href="bloqueo.php">Bloqueo/Desbloqueo</a>
					</div>
				</div>
				<div class="dropdown">
				<button class="dropbtn"><i class="fa fa-fw fa-money-check-alt"></i> FINANCIERO</button>
					<div class="dropdown-content">
						<a href="listabecas.php">Becas</a>
						<a href="#">Recibos de Pago</a>
					</div>
				</div>
				<div class="dropdown">
				<button class="dropbtn"><i class="fa fa-fw fa-user-shield"></i>ADMINISTRATIVO</button>
					<div class="dropdown-content">
						<a href="#">Usuarios</a>
						<a href="#">Perfiles</a>
					</div>
				</div>
				<a class="active" href="index.php#contactUs" style><i class="fa fa-fw fa-user"></i> CONTACTO</a>
				<div class="dropdown">
					<a href="javascript:void(0);" class="icon" onclick="responsiveMenu()">
					<i class="fa fa-bars"></i></a>
				</div>';
            break;
		}
	}
	echo '</div>';
}

// Footer
function footer(){
echo '<footer id="footer">'."\n";
echo '<p class="copyright">&copy; Instituto   Valladolid.   Todos los derechos reservados.</a></p>'."\n";
echo '</footer>'."\n";
}

//*************************************************************************************************
// Funcion:     scripts
// Descripción: carga los scripts al final de la pagina
// Parametros:  Ninguno
//*************************************************************************************************
function scripts() {
echo '<script src="assets/js/jquery.min.js"></script>'."\n";
echo '<script src="assets/js/browser.min.js"></script>'."\n";
echo '<script src="assets/js/breakpoints.min.js"></script>'."\n";
echo '<script src="assets/js/util.js"></script>'."\n";
echo '<script src="assets/js/main.js"></script>'."\n";
echo '<script src="assets/js/auxiliar.js"></script>'."\n";
echo '<script src="https://kit.fontawesome.com/7a8670926a.js" crossorigin="anonymous"></script>'."\n";
echo '</body>'."\n";
echo '</html>'."\n";
}

//*************************************************************************************************

//******************************************************************************************************************************
//******************************************************************************************************************************
//******************************************************************************************************************************
//******************************************************************************************************************************
//******************************************************************************************************************************

// FUNCIONES BACKEND BACKEND BACKEND BACKEND BACKEND BACKEND BACKEND BACKEND BACKEND BACKEND BACKEND BACKEND BACKEND BACKEND BACKEND

//******************************************************************************************************************************
//******************************************************************************************************************************
//******************************************************************************************************************************
//******************************************************************************************************************************
//******************************************************************************************************************************


//*************************************************************************************************
// Funcion:     Ingresar
// Descripción: Realiza el login de usuario
// Parametros:  $Id, $Pass
//*************************************************************************************************

function Ingresar($Id, $Pass) {
$errorflag = 0;
$errortext = "";
$conn = new Usuario();
$user = $conn->login($_POST['username'], $_POST['psw']);
if ($user) {
	// Consiguio los datos
	$_SESSION['Id'] = $user['Id'];
	$_SESSION['Type'] = $user['Type'];
	$_SESSION['Privs'] = $user['Privs'];
	if ($_SESSION['Type'] == 0) {
		// Es alumno
		$alumno = $conn->datosAlumno($_SESSION['Id']);
		if ($alumno) {
			$_SESSION['Nombres'] = $alumno['Nombres']." ".$alumno['Apellidos'];
			$_SESSION['Grado'] = $alumno['Grado'];
			$_SESSION['Grupo'] = $alumno['Grupo'];
			$_SESSION['Seccion'] = $alumno['Seccion'];
			$_SESSION['Correo'] = $alumno['Correo'];
			$_SESSION['IdGrupo'] = $alumno['IdGrupo'];
			if ($_SESSION['Seccion'] == 4) {
					$_SESSION['Carrera'] = substr($alumno['IdGrupo'],0,3);
			}
		} else {
			$errorflag += 1;
            $errortext = "No existen datos del alumno";
		}
	} else {
		// Es Usuario
		$usuario = $conn->datosUsuario($_SESSION['Id']);
		if ($usuario) {
			$_SESSION['Nombres'] = $usuario['Nombres'];
			$_SESSION['Seccion'] = $usuario['Seccion'];
			$_SESSION['Grado'] = $usuario['Grado'];
			$_SESSION['Carrera'] = $usuario['Carrera'];
		} else {
			$errorflag += 1;
            $errortext = "No existen datos de usuario";
		}
	}
	$_SESSION['login'] = 1;
} else {
	$errorflag += 1;
	$_SESSION['login'] = 0;
	$errortext = "Credenciales de acceso no válidas";
}

return $errortext;

}


//*************************************************************************************************
// Funcion:     getAvisos
// Descripción: Una vez que ingresó, buscar los avisos correspondientes a su sección o generales
// Parametros:  Seccion, grado
//*************************************************************************************************

function getAvisos($seccion, $grado, $grupo) {
    
    echo '<section>'."\n";
    echo '<header class=""><h2>Avisos</h2></header>'."\n";
    echo '<div class="box alt">'."\n";
    echo '<div class="row gtr-50 gtr-uniform">'."\n";
    $conn = new aviso();

    $aviso2 = $conn->leer_avisos_grado($seccion, $grado, $grupo);
    $indice = count($aviso2);
    if ($indice>0) {
        foreach($aviso2 as $contenido) {
            if (empty($contenido['Url'])) { 
                echo '<div class="col-4"><span class="image fit"><a href="#"  class="image"><img src="'.$contenido['Imagen'].'" alt="" /></a></span>'."\n";
            } else {
                echo '<div class="col-4"><span class="image fit"><a href="'.$contenido['Url'].'" target="_blank" class="image"><img src="'.$contenido['Imagen'].'" alt="" /></a></span>'."\n";
            }
            echo '<h4>'.html_entity_decode($contenido['Titulo']).'</h4>'."\n";
            echo '<p>'.$contenido['Contenido'].'</p>'."\n";
            echo '</div>'."\n";
        }
    }
    echo '</div>'."\n";
    echo '</div>'."\n";
    echo '</section>'."\n";        
}

function showAvisos() {
    $conn = new aviso();
    $lista = $conn->lista_avisos();
    $indice = count($lista);
    if ($indice>0) {
        echo '  <table>
                <tr><th>Sección</th><th>Grado</th><th>Grupo</th><th>Título</th><th>URL</th><th>Activo</th><th>Inicio</th><th>Fin</th><th>Usuario</th></tr>'."\n"; // 10 columnas
        foreach($lista as $datos) {
            echo '  <tr><td>'.$datos['Seccion'].'</td><td>'.$datos['Grado'].' </td><td>'.$datos['Grupo'].'</td>
                    <td>'.$datos['Titulo'].'</td><td>'.$datos['Url'].' </td><td id="lock_'.$datos['Consecutivo'].'" >';
                    if ($datos['Activo'] == 'Si') {
                        echo '<a href="#"><i class="fas fa-eye" onclick="unlockaviso('.$datos['Consecutivo'].', 1)"></i></a>'; 
                    } else { 
                        echo '<a href="#"><i class="fas fa-eye-slash" onclick="unlockaviso('.$datos['Consecutivo'].', 2)"></i></a>'; 
                    }
                    echo '</td><td>'.$datos['Fecha_Inicio'].'</td><td>'.$datos['Fecha_Fin'].' </td><td>'.$datos['Usuario'].'</td></tr>
                    <tr><td colspan = 9><b>Contenido:</b> '.$datos['Contenido'].'</td></tr>';
        }
        echo '</table>'."\n";
    }
}

//*************************************************************************************************
// Funcion:     GrupoActivo
// Descripción: Si el usuario es Docente Titular, buscar sus grupos y mostrarlos.
// Parametros:  Id
//*************************************************************************************************

function GrupoActivo($IdUsuario, $GrupoActivo) {
    $conn = new Titular();
    $grupo = $conn->lista_grupos($IdUsuario);
    $indice = count($grupo);
    if ($indice>0) {
        echo '
		<form method="post" action="index.php">
		<div class="row gtr-uniform">
			<div class="col-6 col-12-xsmall">
			<legend>Grupo Activo</legend>
			<select name="Active" id="Active">';
        
		if ($GrupoActivo == '0') {
            echo '<option value="">Selecciona el Grupo Activo</option>'."\n";
        } else {
            echo '<option value="'.$GrupoActivo.'">'.$GrupoActivo.'</option>'."\n";
        }
        foreach($grupo as $contenido) {
            echo '<option value="'.$contenido['IdGrupo'].'">'.$contenido['IdGrupo'].'</option>'."\n";
        }
        echo '
			</select>
			</div>
			<div class="col-12">
				<ul class="actions">
				<li><input type="submit" value="Activar " class="primary" /></li>
				</ul>
			</div>
        </div>
        </form>'."\n";
    }
}

//*************************************************************************************************
// Funcion:     grupos
// Descripción: Si el usuario es Administrador, permitirle seleccionar la sección y el grupo a trabajar
// Parametros:  Id, grupoactivo
//*************************************************************************************************

function grupos($IdUsuario) {
        echo '
		<form method="post" action="index.php">
        <div class="row gtr-uniform">
			<div id="ListaSeccion" name="ListaSeccion" class="col-3 col-12-small">
				<select id="seccion" name="seccion" onchange="showGrupos()">
					<option value="" disabled selected>Elige la sección</option>
					<option value="0">Preescolar</option>
					<option value="1">Primaria</option>
					<option value="2">Secundaria</option>
					<option value="3">Bachillerato</option>
					<option value="4">Universidad</option>
				</select>
			</div>
			<div id="select1" name="select1" class="col-3 col-12-small">
				<select id="Active" name="Active"><option value="" disabled selected>Elige el Grupo</option></select>
			</div>
			<div id="select2" name="select2" class="col-3 col-12-small">
			</div>
			<div id="" name="select2" class="col-3 col-12-small">
			</div>
			<div class="col-12">
				<ul class="actions">
				<li><input type="submit" value="Activar " class="primary" /></li>
				</ul>
			</div>
			<input id="flag" name="flag" type="hidden" Value="1">
        </div>
		</form>'."\n";
}


//*************************************************************************************************
// Funcion:     listado
// Descripción: Obtener un listado de los alumnos correspondientes al grupo activo del Titular
// Parametros:  IdGrupo
//*************************************************************************************************

function listado($grupo) {
    $conn = new alumnos();
    $lista = $conn->lista_alumnos($grupo);
    $indice = count($lista);
    if ($indice>0) {
        echo '<table>'."\n";
        echo '<tr><th>Matrícula</th><th>Apellidos</th><th>Nombres</th><th><center>Boleta</center></th><th><center>Recibo de Pago</center></th><th><center>Información</center></th></tr>'."\n";
        foreach($lista as $datos) {
            echo '<tr><td>'.$datos['Id'].'</td><td>'.$datos['Apellidos'].' </td><td>'.$datos['Nombre'].'</td>'."\n";
            echo '<td><center><a href="validpdf.php?context=1&id_alumno='.$datos['Id'].'" target="_blank"><i class="fas fa-book-open"></i></a></center></td>'."\n";
            echo '<td><center><a href="validpdf.php?context=2&id_alumno='.$datos['Id'].'" target="_blank"><i class="fas fa-money-check-alt"></i></a></center></td>'."\n";
            echo '<td><center><a href="#" class="logo"><i class="fas fa-address-card" onclick="showUser('.$datos['Id'].')" style="width:auto;"></a></i></center></td></tr>'."\n";
        }
        echo '</table>'."\n";
        
    }
}

//*************************************************************************************************
// Funcion:     listado_admon
// Descripción: Obtener un listado de los alumnos correspondientes al grupo activo del Administrador, permite bloquear o desbloquear directamente desde el listado
// Parametros:  IdGrupo (el grupo activo)
//*************************************************************************************************

function listado_admon($grupo) {
    $ruta = "boletas/";
    $conn = new alumnos();
    $lista = $conn->lista_alumnos($grupo);
    $indice = count($lista);
    if ($indice>0) {
        echo '<section><table>'."\n";
        echo '<tr><th>Matrícula</th><th>Apellidos</th><th>Nombres</th><th colspan=2><center>Boleta</center></th><th><center>Recibo de Pago</center></th><th><center>Información</center></th></tr>'."\n";
        foreach($lista as $datos) {
            echo '<tr><td>'.$datos['Id'].'</td><td>'.$datos['Apellidos'].' </td><td>'.$datos['Nombre'].'</td>'."\n";
            echo '<td><center><a href="validpdf.php?context=1&id_alumno='.$datos['Id'].'" target="_blank"> <i class="fas fa-file-pdf"></i></center></td>';
            $archivo = $ruta.$datos['Id'].'.pdf';
            if (file_exists($archivo)) 	{ 
                echo '<td><center><a href="#"><i class="fas fa-unlock" onclick="unlock('.$datos['Id'].')"></i></a></center></td>';
            } else {
                echo '<td><center><a href="#"><i class="fas fa-lock" onclick="unlock('.$datos['Id'].')"></i></a></center></td>';
            }
            echo '<td><center><a href="validpdf.php?context=2&id_alumno='.$datos['Id'].'" target="_blank"><i class="fas fa-money-check-alt"></i></a></center></td>';
            echo '<td><center><a href="#" class="logo"><i class="fas fa-address-card" onclick="showUser('.$datos['Id'].')"></a></i></center></td></tr>'."\n";
        }
        echo '</table></section>'."\n";
        
    }
}


//*************************************************************************************************
// Funcion:     lista_circulares
// Descripción: Consulta las circulares en la BD correspondientes al alumno y las muestra
// Parametros:  Los consulta de las variables de sesión
//*************************************************************************************************
function lista_circulares() {
    // Toma los datos activos
    if (isset($_SESSION['IdGrupo']) && $_SESSION['IdGrupo'] != '') {    // Es alumno!!
        $Grupo = $_SESSION['IdGrupo'];
    } else {    
        if (isset($_SESSION['Activo']) && $_SESSION['Activo'] != '') {  // Es usuario
            $Grupo = $_SESSION['Activo'];
        } else {
            $Grupo = '';
        }
    }
    $Seccion = corto_seccion();
    $Ciclo = ciclo_actual();
    echo '<section> <h4>Seccion: '.$Seccion.' - Grupo: '.$Grupo.' - Ciclo: '.$Ciclo.'</h4>
		<table>
		<tr><th>Seccion</th><th>Grupo</th><th>Descripción</th><th><center>Enlace</center></th></tr>'."\n";
    $conn = new Circular();
    if ($Grupo != '') {
        $lista = $conn->lista_circular_grupo($Grupo, $Ciclo);
        $indice = count($lista);
        if ($indice>0) {
            foreach($lista as $datos) {
                echo '<tr><td>'.$datos['Seccion'].'</td><td>'.$datos['IdGrupo'].' </td><td>'.$datos['Descripcion'].'</td>'."\n";
                echo '<td><center><a href="'.$datos['Archivo'].'" target="_blank"><i class="fas fa-file-alt"></i></a></center></td>'."\n";
            }
        }
    }
    if ($Grupo == '' && $_SESSION['Privs'] > 3) {    // Es usuario y solo seleccionó carrera
        $lista = $conn->lista_circular_seccion2 ($Seccion, $Ciclo);
    } else {
        $lista = $conn->lista_circular_seccion1 ($Seccion, $Ciclo);
    }
    $indice = count($lista);
    if ($indice>0) {
        foreach($lista as $datos) {
            echo '<tr><td>'.$datos['Seccion'].'</td><td>'.$datos['IdGrupo'].' </td><td>'.$datos['Descripcion'].'</td>'."\n";
            echo '<td><center><a href="'.$datos['Archivo'].'" target="_blank"><i class="fas fa-file-alt"></i></a></center></td>'."\n";
        }
    }
    echo '</table></section>'."\n";
        
}

//*************************************************************************************************
// Funcion:     listado_becas
// Descripción: Obtener un listado de los alumnos que realizaron algún trámite de beca
// Parametros:  IdGrupo y Seccion
//*************************************************************************************************

function listado_becas($tipo) { // El tipo determina qué es lo que buscará (1: grupo, 2: carrera, 3: seccion) las variables están en sesion
    $conn = new alumnos();
    switch ($tipo) {
        case 1:
            $lista = $conn->lista_becas_grupos(substr($_SESSION['Activo'],0,3), $_SESSION['Activo']);
            break;
        case 2:
            $seccion = corto_seccion();
            $lista = $conn->lista_becas_carrera($seccion);
            echo '<h4>'.$seccion.'</h4>';
            break;
        case 3:
            $lista = $conn->lista_becas_seccion($_SESSION['Seccion']);
            break;
    }

    $indice = count($lista);
    if ($indice>0) {
        echo '<table>'."\n";
        echo '<tr><th>Matrícula</th><th>Apellidos</th><th>Nombres</th>';
        if ($tipo == 2) { echo '<th>Grupo</th>'; }
        echo '<th><center>Estatus</center></th><th><center>Solicitud</center></th><th><center>Boleta</center></th>';
        echo '<th><center>Ingresos</center></th><th><center>INE/IFE</center></th><th><center>Socioeconómico</center></th></tr>'."\n";
        foreach($lista as $datos) {
            echo '<tr><td><a href="detallebecas.php?id_alumno='.$datos['Id'].'&seccion='.$_SESSION['Seccion'].'">'.$datos['Id'].'</td><td>'.$datos['Apellidos'].' </td><td>'.$datos['Nombre'].'</td>'."\n";
            if ($tipo == 2) { echo '<td>'.$datos['IdGrupo'].'</td>'; }
            echo '<td><center>'.estatus($datos['Status']).'</i></center></td>';
            echo '<td><center><a href="validpdf.php?context=6&id_alumno='.$datos['Id'].'" target="_blank"> <i class="fas fa-clipboard-list"></i></center></td>';
            echo '<td><center><a href="validpdf.php?context=1&id_alumno='.$datos['Id'].'" target="_blank"> <i class="fas fa-file-pdf"></i></center></td>';
            echo '<td><center><a href="validpdf.php?context=7&id_alumno='.$datos['Id'].'" target="_blank"> <i class="fas fa-file-invoice-dollar"></i></center></td>';
            echo '<td><center><a href="validpdf.php?context=8&id_alumno='.$datos['Id'].'" target="_blank"> <i class="fas fa-address-card"></i></center></td>';
            echo '<td><center><a href="validpdf.php?context=9&id_alumno='.$datos['Id'].'" target="_blank"> <i class="fas fa-hand-holding-usd"></i></center></td>';
        }
        echo '</table>'."\n";
        
    } else  {
        echo '<p>No se encontraron solicitudes en este grupo</p>';
    }
}

//*************************************************************************************************
// Funcion:     estatus
// Descripción: Cambia el icono del estatus en beca listado_becas()
// Parametros:  IdGrupo
//*************************************************************************************************
function estatus($status) {
$cadena = '';
switch ($status) {
    case 0:
         $cadena = '<i class="fas fa-search" style="color: #00008d"></i>';
        break;
    case 1:
        $cadena = '<i class="fas fa-times" style="color: #ca0000"></i>';
        break;
    case 2:
        $cadena = '<i class="fas fa-check" style="color: #008500"></i>';
        break;
}
return $cadena;
}


//*************************************************************************************************
// Funcion:     listado_recibo
// Descripción: Obtener un listado de los alumnos correspondientes al grupo activo del Titular
// Parametros:  IdGrupo
//*************************************************************************************************

function listado_recibo($grupo) {
    $conn = new alumnos();
    $lista = $conn->lista_alumnos($grupo);
    $indice = count($lista);
    if ($indice>0) {
        echo '<table>'."\n";
        foreach($lista as $datos) {
            echo '<tr><td><a href="validpdf.php?context=2&id_alumno='.$datos['Id'].'" target="_blank">'.$datos['Id'].'</a></td><td>'.$datos['Apellidos'].' </td><td>'.$datos['Nombre'].'</td><td>'.$datos['IdGrupo'].'</td></tr>'."\n";
        }
        echo '</table>'."\n";
        
    }
}

//*************************************************************************************************

//******************************************************************************************************************************
//******************************************************************************************************************************
//******************************************************************************************************************************
//******************************************************************************************************************************
//******************************************************************************************************************************

// FUNCIONES ETIQUETAS ETIQUETAS ETIQUETAS ETIQUETAS ETIQUETAS ETIQUETAS ETIQUETAS ETIQUETAS ETIQUETAS ETIQUETAS ETIQUETAS

//******************************************************************************************************************************
//******************************************************************************************************************************
//******************************************************************************************************************************
//******************************************************************************************************************************
//******************************************************************************************************************************

//*************************************************************************************************
// Funcion:     texto_reinscripcion
// Descripción: Imprime el HTML previo al formulario, eventualmente deberá desaparecer
// Parametros:  Seccion del alumno ingresado
// Regresa:     Nada
//*************************************************************************************************
function texto_reinscripcion($seccion) {
    switch ($seccion) {
        case 0:     // Preescolar
            echo '<p>Preescolar</p>'."\n";
            break;
        case 1:     // Primaria
            ?>
            <ol>
            <li>Descarga la <strong>ficha de reinscripción</strong></li>
            <li>Llena solamente el <strong>primer recuadro</strong> de la ficha de reinscripción.</li>
            <li>Guarda la ficha de reinscripción con el <strong>nombre completo y grado al cual se reinscribe el alumno.</strong></li>
            <li>Envía por correo electrónico la ficha de reinscripción a <strong>cmaciel@valladolid.edu.mx</strong> encargada del Departamento de Control Escolar Carmen Lucia Maciel Domínguez</li>
            <li>Realiza los pagos para la reinscripción, para ello <strong>descarga las <a href='recibos.php'>fichas referenciadas.</a></strong></li>
            </ol> 
            <p>NOTA:  Para la entrega y firma de documentos oficiales, como es el contrato de servicios, ficha médica y la carta compromiso del alumno se hará de manera presencial, por lo cual, como Institución estamos esperando indicaciones de nuestras autoridades.</p>
            <center><h3>COSTOS DEL CICLO ESCOLAR 2020 – 2021</h3></center>
            <p> Reinscripción <b>$5,100.00</b><br>
            Para su comodidad se han divido los pagos en 3 partes</p>
            <table id="alumnos" width="80%">
            <tr><th>Pago</th><th>Fecha de vencimiento</th><th>Cantidad</th></tr>
            <tr><td>1°</td><td>*20 de junio</td><td>$1,500.00</td></tr>
            <tr><td>2°</td><td>31 de julio</td><td>**$1,800.00</td></tr>
            <tr><td>3°</td><td>31 de agosto</td><td>**$1,800.00</td></tr>
            </table>
            <p>*Para los alumnos que realicen el tramite de convenio o beca interna deberán realizar el primer pago de $1,500.00 antes del 23 de mayo, para poder realizar este trámite.</p>
            <p>**Para los alumnos con convenio para el ciclo escolar 2020-2021 al pago de la reinscripción se le debe realizar el descuento otorgado. También se divide en 3 partes quedando de la siguiente manera: el primer pago es de $1,500.00 y los otros dos pagos son del resto del pago divido en 2, por lo anterior, las fichas referenciadas no se podrán utilizar para estos dos pagos.</p>
            <?php
            break;
        case 2:     //Secundaria
            ?>
            <ol>
            <li>Descarga la <strong><a href="/media/Ficha_Control_Escolar_Secundaria_Formulario.pdf" target="_blank">Ficha de control escolar</a></strong></li>
            <li>Llena los datos solicitados y guarda el archivo con el <strong>nombre completo y grado al cual se reinscribe el alumno.</strong></li>
            <li>Envía por correo electrónico la ficha de reinscripción a <strong>secundaria@valladolid.edu.mx</strong>, con atención a la encargada del Departamento de Control Escolar: Nancy Dueñas Arroyo</li>
            <li>Realiza los pagos para la reinscripción, para ello <strong>descarga las <a href='recibos.php'>fichas referenciadas.</a></strong></li>
            </ol> 
            <p>NOTA:  Para la entrega y firma de documentos oficiales, como es el contrato de servicios, ficha médica y la carta compromiso del alumno se hará de manera presencial, por lo cual, como Institución estamos esperando indicaciones de nuestras autoridades.</p>
            <center><h3>COSTOS DEL CICLO ESCOLAR 2020 – 2021</h3></center>
            <p> Reinscripción <b>$6,500.00</b><br>
            Para su comodidad se han divido los pagos en 3 partes</p>
            <table id="alumnos" width="80%">
            <tr><th>Pago</th><th>Fecha de vencimiento</th><th>Cantidad</th></tr>
            <tr><td>1°</td><td>*20 de junio</td><td>$1,500.00</td></tr>
            <tr><td>2°</td><td>31 de julio</td><td>**$2,500.00</td></tr>
            <tr><td>3°</td><td>31 de agosto</td><td>**$2,500.00</td></tr>
            </table>
            <p>* Para los alumnos que realicen el tramite de convenio o beca interna deberán realizar el primer pago de $1,500.00 antes del 23 de mayo, para poder realizar este trámite.</p>
            <p>** Para los alumnos con convenio para el ciclo escolar 2020-2021 al pago de la reinscripción se le debe realizar el descuento otorgado. También se divide en 3 partes quedando de la siguiente manera: el primer pago es de $1,500.00 y los otros dos pagos son del resto del pago divido en 2, por lo anterior, las fichas referenciadas no se podrán utilizar para estos dos pagos.</p>
            <?php
            break;
        case 3:     //Preparatoria
            ?>
            <ol>
            <li>Descarga la <strong><a href="media/Ficha_de_Control_Escolar_Preparatoria.pdf" target="_blank">Ficha de Registro</a></strong></li>
            <li>Llena los datos solicitados y guarda el archivo con el <strong>nombre completo y grado al cual se reinscribe el alumno.</strong></li>
            <li>Envía por correo electrónico la ficha de reinscripción a <strong>controlescolar@valladolid.edu.mx</strong>, con atención a la encargada del Departamento de Control Escolar: <b>María del Carmen Vázquez Zepeda.</b></li>
            <li>Realiza los pagos para la reinscripción, para ello <strong>descarga las <a href='recibos.php'>fichas referenciadas.</a></strong></li>
            </ol> 
            <p>NOTA:  Para la entrega y firma de documentos oficiales, como es el contrato de servicios y la carta compromiso del alumno se hará de manera presencial, por lo cual, como Institución estamos esperando indicaciones de nuestras autoridades.</p>
            <?php
            break;
        case 4:     //Universidad
            ?>
            <ol>
            <li>Descarga la <strong><a href="media/Formulario_Ficha_de_Registro.pdf" target="_blank">Ficha de Registro</a></strong></li>
            <li>Llena los datos solicitados y guarda el archivo con el <strong>nombre completo y grado</strong> al cual se reinscribe el alumno.</li>
            <li>Envía por correo electrónico la ficha de reinscripción a <strong>controlescolar@umvalla.edu.mx</strong>, con atención a la encargada del Departamento de Control Escolar: <b>Adriana Navarro.</b></li>
            <li>Realiza los pagos para la reinscripción, para ello <strong>descarga las <a href='recibos.php'>fichas referenciadas.</a></strong></li>
            </ol> 
            <p>NOTA:  Para la entrega y firma de documentos oficiales, como es el contrato de servicios y la carta compromiso del alumno se hará de manera presencial, por lo cual, como Institución estamos esperando indicaciones de nuestras autoridades.</p>
            <?php
            break;
        default:     //
            echo '<p>PROCESO DEFAULT</p>';
            break;
        }

}



//*************************************************************************************************
// Funcion:     listado_infoGeneralReinsc
// Descripción: Obtiene cantidad de alumnos inscritos, por seccion, carrera, grado y la cantidad de los alumnos con proceso de reinscripcion y su estatus 
// Parametros:  seccion y carreras
//*************************************************************************************************

function listado_infoGeneralReinsc($seccion, $carrera) {
	$conn = new alumnos();
	$conn2 = new alumnos();
	if (isset($carrera) && $carrera != '') {  
	echo '<table>'."\n";
		echo '<tr><th  colspan= "3"><center>CICLO ACTUAL '.CICLOACTS.'</center></th><th  colspan= "4"><center>CICLO SIGUIENTE '.CICLOSIGS.'</center></th></tr>';		
		echo '<th><center>Grado</center></th><th><center>Total de alumnos</center></th><th><center>Proceso de reinscripcion</center></th><th><center>Pendiente</center></th><th><center>Modificar datos</center></th><th><center>Inscritos</th></tr>';
	    $lista = $conn->infoInscritos($seccion,$carrera);		
		$indice = count($lista);
			if ($indice>0) {
			   	foreach($lista as $datos) {
					$cantReinscripcion=$conn2->cantReinscripcion($seccion,$carrera,$datos['Grado']);
					echo '<tr>';
					echo '<td><center>'.$datos['Grado'].'</center></td><td><center>'.$datos['count(*)'].'</center></td>';
					echo '<td><center>'.$cantReinscripcion[0]['count(*)'].'</td>';
					for($i=0;$i<3;$i++){
					$cantidadStatus=$conn2->cantReinsStatus($seccion,$carrera,$datos['Grado'],$i);
						echo '<td><center><a href="informacionReinscripciones.php?claveCarrera='.$carrera.'&grado='.$datos['Grado'].'&estatus='.$i.'&cicloAct='.CICLOACTS.'&seccion='.$seccion.'">'.$cantidadStatus[0]['count(*)'].'</center></td>';
					}
					echo '</tr>';
				}
			}
		 echo '</table>'."\n";  
	}else{
	 if($seccion==4 ){
		echo '<table>'."\n";
		echo '<tr><th  colspan= "3"><center>CICLO ACTUAL '.CICLOACTS.'</center></th><th  colspan= "4"><center>CICLO SIGUIENTE '.CICLOSIGS.'</center></th></tr>';		
		echo '<tr><th>Carrera</th>';
	 echo '<th><center>Grado</center></th><th><center>Total de alumnos</center></th><th><center>Proceso de reinscripcion</center></th><th><center>Pendiente</center></th><th><center>Modificar datos</center></th><th><center>Inscritos</th></tr>';
		foreach(CARRERAS as list ($claveCarrera,$nombreCarrera)){
			$lista = $conn->infoInscritos($seccion,$claveCarrera);		
			$indice = count($lista);
			if ($indice>0) {
			   	foreach($lista as $datos) {
					$cantReinscripcion=$conn2->cantReinscripcion($seccion,$claveCarrera,$datos['Grado']);
					echo '<tr>';
					echo '<td>'.$claveCarrera.'</td>';
					echo '<td><center>'.$datos['Grado'].'</center></td><td><center>'.$datos['count(*)'].'</center></td>';
					echo '<td><center>'.$cantReinscripcion[0]['count(*)'].'</td>';
					for($i=0;$i<3;$i++){
					$cantidadStatus=$conn2->cantReinsStatus($seccion,$claveCarrera,$datos['Grado'],$i);
						echo '<td><center><a href="informacionReinscripciones.php?claveCarrera='.$claveCarrera.'&grado='.$datos['Grado'].'&estatus='.$i.'&cicloAct='.CICLOACTS.'&seccion='.$seccion.'">'.$cantidadStatus[0]['count(*)'].'</center></td>';
					}
					echo '</tr>';
				}
			}
		 }
		 echo '</table>'."\n";  
	 }//UNIVERSIDAD
	 else{
		 echo '<table>'."\n";
		echo '<tr><th  colspan= "2"><center>CICLO ACTUAL '.CICLOACTUAL.'</center></th><th  colspan= "4"><center>CICLO SIGUIENTE '.CICLONEXT.'</center></th></tr><tr>';
		echo '<th><center>Grado</center></th><th><center>Total de alumnos</center><th><center>Proceso de reinscripcion</center></th><th><center>Pendiente</center></th></th><th><center>Modificar datos</center></th><th><center>Inscritos</center></th></tr>';
		$lista = $conn->infoInscritos($seccion,"");
		//lista2=$conn2->infoReinscripcionGeneral($seccion);
			$indice = count($lista);
			if ($indice>0) {
			   foreach($lista as $datos) {
					$cantReinscripcion=$conn2->cantReinscripcion($seccion,"",$datos['Grado']);
					echo '<tr>';
					echo '<td>'.$datos['Grado'].'</td><td>'.$datos['count(*)'].' </td>';
					echo '<td>'.$cantReinscripcion[0]['count(*)'].'</td>';
					for($i=0;$i<3;$i++){
						$cantidadStatus=$conn2->cantReinsStatus($seccion,"",$datos['Grado'],$i);
						echo '<td><a href="informacionReinscripciones.php?grado='.$datos['Grado'].'&estatus='.$i.'&cicloAct='.CICLOACTA.'&seccion='.$seccion.'">'.$cantidadStatus[0]['count(*)'].'</a></td>';
						}
					echo '</tr>';
				}
			} 
		 echo '</table>'."\n";  
	}}
}
//*************************************************************************************************
// Funcion:     listado_reinscripcion
// Descripción: Obtener un listado de los alumnos que realizaron tramite de reinscripcion
// Parametros:  seccion, grado,carrera,estatus
//*************************************************************************************************

function listado_reinscripcion($_seccion,$_grado,$_carrera,$_estatus,$_cicloAct) { // El tipo determina qué es lo que buscará (1: grupo, 2: carrera, 3: seccion) las variables están en sesion
    $conn = new alumnos();
    $lista = $conn->lista_reinscripcion($_seccion,$_grado,$_carrera,$_estatus,$_cicloAct);
    $indice = count($lista);
    if ($indice>0) {
        echo '<table>'."\n";
        echo '<tr><th>Matrícula</th><th>Apellidos</th><th>Nombres</th>';
        echo '<th><center>Estatus Beca</center></th><th><center>Ficha</center></th><th><center>Contrato</center></th>';
        echo '<th><center>Domicilio</center></th><th><center>INE/IFE</center></th></tr>'."\n";
        foreach($lista as $datos) {
            echo '<tr><td><a href="detalleReinscripcion.php?matricula='.$datos['Id'].'&seccion='.$_seccion.'&cicloAct='.$_cicloAct.'">'.$datos['Id'].'</td><td>'.$datos['Apellidos'].' </td><td>'.$datos['Nombre'].'</td>'."\n";
            echo '<td><center>'.estatus($datos['Status']).'</i></center></td>';
            echo '<td><center><a href="validpdf.php?context=10&id_alumno='.$datos['Id'].'&seccion='.$_seccion.'" target="_blank"> <i class="fas fa-clipboard-list"></i></a></center></td>';
            echo '<td><center><a href="validpdf.php?context=13&id_alumno='.$datos['Id'].'&seccion='.$_seccion.'" target="_blank"> <i class="fas fa-file-pdf"></i></a></center></td>';
            echo '<td><center><a href="validpdf.php?context=12&id_alumno='.$datos['Id'].'&seccion='.$_seccion.'" target="_blank"> <i class="fas fa-house-user"></i></a></center></td>';
            echo '<td><center><a href="validpdf.php?context=11&id_alumno='.$datos['Id'].'&seccion='.$_seccion.'" target="_blank"> <i class="fas fa-address-card"></i></a></center></td>';
     
        }
        echo '</table>'."\n";
        
    } else  {
        echo '<p>No se encontraron solicitudes en este grupo</p>';
    }
}

function estatus_reinscripcion($matricula,$cicloAct){
	$conn = new alumnos();
	$estatus=$conn->estatusReinscripcion($matricula,$cicloAct);
	if($estatus != Null){
		return $estatus[0]['Status'];
	}
	else {
		return 10;
	}
}
function observaciones_reinscripcion($matricula,$cicloAct){
	$conn = new alumnos();
	$estatus=$conn->ObservacionesReinscripcion($matricula,$cicloAct);
	if($estatus != Null){
		return $estatus[0]['Observaciones'];
	}
	else {
		return "";
	}
	
}


//*************************************************************************************************
// Funcion:     texto_becas
// Descripción: Imprime el HTML previo al formulario, uno para preescolar a bachillerato, uno para universidad
// Parametros:  Seccion del alumno ingresado
// Regresa:     Nada
//*************************************************************************************************
function texto_becas($seccion) {
    if ($seccion <4) {      // Instituto
        ?>
        <h3>Proceso de Solicitud o Renovación de Beca</h3>
        <ol>
            <li>Descarga el <strong><a href="media/FormatoBecasInstituto.pdf" target="_blank">Formato de Solicitud</a></strong>. Este es un archivo PDF que deberás llenar digitalmente.</li>
            <li>Prepara los archivos digitales indicados en el formato. Recomendamos que los escanees en formato PDF (menores a 1 Mb)</li>
            <li>Realiza el primer pago de reinscripción, para ello <strong>descarga las <a href='recibos.php'>fichas referenciadas.</a></strong>. Es requisito realizarlo antes del 20 de mayo para ser tomado en cuenta en el proceso de asignación/reasignación de becas.</li>
            <li>Sube los archivos en esta página.
        </ol> 
        <p>* En el caso de INE y Comprobantes de pago, en el mismo archivo deberán incluirse los datos de ambos Padres o Tutores.</p>
        <?php
    } else {        // Universidad
        ?>
        <h3>Proceso de Solicitud o Renovación de Beca</h3>
        <ol>
             <li>Descarga el <strong><a href="media/FormatoBecasUniversidad.pdf" target="_blank">Formato de Solicitud</a></strong>. Este es un archivo PDF que deberás llenar digitalmente.</li>
            <li>Prepara los archivos digitales indicados en el formato. Recomendamos que los escanees en formato PDF (menores a 1 Mb)</li>
            <li>Realiza el primer pago de reinscripción, para ello <strong>descarga las <a href='recibos.php'>fichas referenciadas.</a></strong>. Es requisito realizarlo antes del 20 de mayo para ser tomado en cuenta en el proceso de asignación/reasignación de becas.</li>
            <li>Sube los archivos en esta página.
        </ol> 
        <p>* En el caso de INE y Comprobantes de pago, en el mismo archivo deberán incluirse los datos de ambos Padres o Tutores.</p>
        <?php
    }
}

//*************************************************************************************************
// Funcion:     contacto
// Descripción: Escribe los datos de contacto en funcion a la seccion del alumno
// Parametros:  Ninguno, los toma de variables de sesion
//*************************************************************************************************
function contacto(){
// verificar si hay login y determinar las cadenas necesarias
	if (isset($_SESSION['login']) && $_SESSION['login'] == 1) {
		switch($_SESSION['Seccion']) {
    case '0':
      $correo="preescolar@valladolid.edu.mx";
      $telefono="4433 13 2098 / 4433 41 6978";
      break;
    case '1':
      $correo="primaria@valladolid.edu.mx";
      $telefono="4433 12 3280 / 4433 12 3392";
      break;
    case '2':
      $correo="secundaria@valladolid.edu.mx";
      $telefono="4433 12 7137 / 4433 13 9886";
      break;
    case '3':
      $correo="preparatoria@valladolid.edu.mx";
      $telefono="4433 23 5150 / 4433 23 7130";
      break;
    case '4':
      $correo="secretaria@umvalla.edu.mx";
      $telefono="4433 43 0295 / 4433 23 7161";
      break;
  }
	if ($_SESSION['Seccion']<5) {   //No es Administrativo, es necesario poner los datos de contacto
    echo '<section id="contactUs">'."\n";
    echo '<p id="specialMargin">La comunicación del Instituto con sus alumnos es importante. Para ello ponemos a tu disposición los siguientes medios:</p>'."\n";
	  echo '<ul class="contact">'."\n";
    echo '<li class="icon solid fa-envelope">'.$correo.'</li>'."\n";
    echo '<li class="icon solid fa-phone">'.$telefono.'</li>'."\n";
    echo '</ul>'."\n";
	  echo '</section>'."\n";
  }
	}
}

