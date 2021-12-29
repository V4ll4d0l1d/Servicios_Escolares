
<?php
error_reporting(E_ALL);
ini_set("display_errors","On");
ini_set("session.gc_maxlifetime","14400");
session_start();

include ("libs.php");           /* Librerias */
include ("dbconect.php");

//$contenido = 'http://localhost/servicios/registraqr.php?id='.$_matricula.'&fecha='.$_fecha.&grupo='.$_grupo;

?>
<!DOCTYPE HTML><html>
<head>
<title>Validación de QR</title>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
<link rel="stylesheet" href="assets/css/main.css" />
<link href="assets/css/fontawesome-all.min.css" rel="stylesheet">
</head>
<body class="is-preload">
<div id="wrapper">
<div id="main">
<div class="inner">
<header id="header"><a href="index.php" class="logo"><strong>Instituto Valladolid</strong> - Servicios Escolares</a>
<ul class="icons">
<!--<li class="icon solid fa-key" onclick="document.getElementById('id01').style.display='block'" style="width:auto;"><a href="#" class="logo"> Ingresar</a></li>-->
</ul></header>
<section>
<?php
/* ---------------- AQUI COMIENZA LA SECCION CENTRAL DE INFORMACION -----------------------*/
// recibir los datos
if (isset($_GET['id'])) {
	$_matricula = $_GET['id'];
}

if (isset($_GET['nombre'])) {
	$_nombre = $_GET['nombre'];
}

if (isset($_GET['fecha'])) {
	$_fecha = $_GET['fecha'];
}

if (isset($_GET['grupo'])) {
	$_grupo = $_GET['grupo'];
	$_seccion = substr($_grupo, 0, 3);
}

if ($_fecha == date("d-m-Y")) {
	echo '<h3>'.$_matricula.' - '.$_nombre.' - '.$_fecha.'</h3><p>'.$_grupo.'  '.$_seccion.'</p>';
    echo '<section>
    	<div class="box alt">
			<div class="row gtr-50 gtr-uniform">
				<div class="col-4"><span class="image fit"><img src="images/QRok.png" alt="Adelante" /></a></span>
				<h4>Adelante</h4>
			</div>
		</div>';
		$conn = new certificado();
		$cert = $conn->insert_certificado($_matricula, $_seccion, $_grupo, date('Y-m-d'));
		if (!$cert) {
			echo '<p>ERROR AL ACTUALIZAR LA BD</P>';
        }
} else {
	echo '<h3>'.$_matricula.' - '.$_nombre.' - '.$_fecha.'</h3><p>'.$_grupo.'  '.$_seccion.'</p>';
    echo '<section>
    	<div class="box alt">
			<div class="row gtr-50 gtr-uniform">
				<div class="col-4"><span class="image fit"><img src="images/QRbad.png" alt="No valido" /></a></span>
				<h4>QR NO VÁLIDO</h4>
			</div>
		</div>';
}
	
 echo ' </div>
        </section>'."\n";  
   

/* ------------------- AQUI TERMINA LA SECCION CENTRAL DE INFORMACION -------------------*/
// comienza el login
//<!-- main -->
footer();

/* Scripts */
scripts();


?>