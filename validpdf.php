<?php 
// Para no permitir que se descarguen archivos que no correspondan al usuario activo, ni que se vean las rutas
ob_start();
session_start();
//Validamos variables por get
if(isset($_GET['context']) && isset($_GET['id_alumno'])) {
    $contexto = $_GET['context'];
    $matricula=$_GET['id_alumno'];
} else {
    echo "<center><h3>Parametro Incorrecto...</br>Comunicate con el departamento de Control Escolar</h3></center>";
    echo '<a href='.$_SERVER['HTTP_REFERER'].'>Regresar...</a>'."\n";
}
//Validamos que esté buscando sus propios archivos o que la persona que consulta sea docente o administrador
if ($_SESSION['Id'] == $matricula or $_SESSION['Privs'] > 1) {
    // Accion a realizar en función al contexto
    switch ($contexto) {        // El contexto permite saber que es lo que estás descargando
        case 1:     // Calificaciones
            //Recuperamos Datos del alumno
            //$archivo = "boletas/".$_SESSION['Seccion']."/".$matricula.".pdf";   // Ruta de la boleta
            $archivo = "boletas/".$matricula.".pdf";   // Ruta de la boleta
            if (file_exists($archivo)) 	{   //La boleta no está bloqueada
                header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE 
                header ("Pragma: no-cache");  
                header('Content-type: application/pdf'); 
                readfile($archivo); 
            } else 	{   // Revisar si la boleta está bloqueada
                //$archivo2 = "boletas/".$_SESSION['Seccion']."/_".$matricula.".pdf";
                $archivo2 = "boletas/_".$matricula.".pdf"; 
                if (file_exists($archivo2)) { // Se encontro el archivo bloqueado, mostrar aviso de pago
                    $archivo = "boletas/Aviso_".$_SESSION['Seccion'].".pdf"; // Muestra el aviso correspondiente a la sección
                    header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE 
                    header ("Pragma: no-cache");  
                    header('Content-type: application/pdf'); 
                    readfile($archivo); 
                } else { // No se encuentra el archivo, solicitarlo impreso 
                    echo "<center><h3>Eror de consulta...</br>El archivo solicitado no existe</br>";
                    echo "Comunicate con el departamento de Control Escolar para una copia impresa</h3></center>";
                    echo '<a href='.$_SERVER['HTTP_REFERER'].'>Regresar...</a>'."\n";
                }
            }
            break;
        case 2:     // Recibo de pago Vigente
            $archivo = 'recibos/'.$_SESSION['Seccion'].'/'.$matricula.'.pdf';
            if (file_exists($archivo)) 	{   //La boleta no está bloqueada
                header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE 
                header ("Pragma: no-cache");  
                header('Content-type: application/pdf'); 
                readfile($archivo); 
            } else { // No se encuentra el archivo, solicitarlo impreso 
                echo "<center><h3>Error de consulta...</br>El archivo solicitado no existe</br>";
                echo "Comunicate con el departamento de Control Escolar para una copia impresa</h3></center>";
                echo '<a href='.$_SERVER['HTTP_REFERER'].'>Regresar...</a>'."\n";
            }
            break;
        case 3:     // Recibo de pago Inscripcion 1
            $archivo = 'recibos/'.$_SESSION['Seccion'].'/pago1/'.$matricula.'.pdf';
            if (file_exists($archivo)) 	{   //La boleta no está bloqueada
                header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE 
                header ("Pragma: no-cache");  
                header('Content-type: application/pdf'); 
                readfile($archivo); 
            } else { // No se encuentra el archivo, solicitarlo impreso 
                echo "<center><h3>Error de consulta...</br>El archivo solicitado no existe</br>";
                echo "Comunicate con el departamento de Control Escolar para una copia impresa</h3></center>";
                echo '<a href='.$_SERVER['HTTP_REFERER'].'>Regresar...</a>'."\n";
            }
            break;
        case 4:     // Recibo de pago Inscripcion 2
            $archivo = 'recibos/'.$_SESSION['Seccion'].'/pago2/'.$matricula.'.pdf';
            if (file_exists($archivo)) 	{   //La boleta no está bloqueada
                header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE 
                header ("Pragma: no-cache");  
                header('Content-type: application/pdf'); 
                readfile($archivo); 
            } else { // No se encuentra el archivo, solicitarlo impreso 
                echo "<center><h3>Error de consulta...</br>El archivo solicitado no existe</br>";
                echo "Comunicate con el departamento de Control Escolar para una copia impresa</h3></center>";
                echo '<a href='.$_SERVER['HTTP_REFERER'].'>Regresar...</a>'."\n";
            }
            break;
        case 5:     // Recibo de pago Inscripcion 3
            $archivo = 'recibos/'.$_SESSION['Seccion'].'/pago3/'.$matricula.'.pdf';
            if (file_exists($archivo)) 	{   //La boleta no está bloqueada
                header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE 
                header ("Pragma: no-cache");  
                header('Content-type: application/pdf'); 
                readfile($archivo); 
            } else { // No se encuentra el archivo, solicitarlo impreso 
                echo "<center><h3>Error de consulta...</br>El archivo solicitado no existe</br>";
                echo "Comunicate con el departamento de Control Escolar para una copia impresa</h3></center>";
                echo '<a href='.$_SERVER['HTTP_REFERER'].'>Regresar...</a>'."\n";
            }
            break;
        case 6:     // Solicitud Beca
            $archivo = 'becas/'.$_SESSION['Seccion'].'/formato/'.$matricula.'.pdf';
            if (file_exists($archivo)) 	{   //La boleta no está bloqueada
                header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE 
                header ("Pragma: no-cache");  
                header('Content-type: application/pdf'); 
                readfile($archivo); 
            } else { // No se encuentra el archivo, solicitarlo impreso 
                echo "<center><h3>Error de consulta...</br>El archivo solicitado no existe</br></h3>";
                echo '<a href='.$_SERVER['HTTP_REFERER'].'>Regresar...</a>'."\n";
            }
            break;
        case 7:     // Comprobante de ingresos
            $archivo = 'becas/'.$_SESSION['Seccion'].'/ingresos/'.$matricula.'.pdf';
            if (file_exists($archivo)) 	{   //La boleta no está bloqueada
                header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE 
                header ("Pragma: no-cache");  
                header('Content-type: application/pdf'); 
                readfile($archivo); 
            } else { // No se encuentra el archivo, solicitarlo impreso 
                echo "<center><h3>Error de consulta...</br>El archivo solicitado no existe</br></h3>";
                echo '<a href='.$_SERVER['HTTP_REFERER'].'>Regresar...</a>'."\n";
            }
            break;
        case 8:     // Identificación
            $archivo = 'becas/'.$_SESSION['Seccion'].'/idoficial/'.$matricula.'.pdf';
            if (file_exists($archivo)) 	{   //La boleta no está bloqueada
                header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE 
                header ("Pragma: no-cache");  
                header('Content-type: application/pdf'); 
                readfile($archivo); 
            } else { // No se encuentra el archivo, solicitarlo impreso 
                echo "<center><h3>Error de consulta...</br>El archivo solicitado no existe</br></h3>";
                echo '<a href='.$_SERVER['HTTP_REFERER'].'>Regresar...</a>'."\n";
            }
            break;
        case 9:     // Socioeconomico
            $archivo = 'becas/'.$_SESSION['Seccion'].'/estudio/'.$matricula.'.pdf';
            if (file_exists($archivo)) 	{   //La boleta no está bloqueada
                header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE 
                header ("Pragma: no-cache");  
                header('Content-type: application/pdf'); 
                readfile($archivo); 
            } else { // No se encuentra el archivo, solicitarlo impreso 
                echo "<center><h3>Error de consulta...</br>El archivo solicitado no existe</br></h3>";
                echo '<a href='.$_SERVER['HTTP_REFERER'].'>Regresar...</a>'."\n";
            }
            break;
		case 10:     // FichaReinscripcion
		if(isset($_GET['seccion'])){$seccion=$_GET['seccion'];}else{$seccion=0;} 
            $archivo = 'reinscripcion/'.$seccion.'/ficha/'.$matricula.'.pdf';
            if (file_exists($archivo)) 	{   //La boleta no está bloqueada
                header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE 
                header ("Pragma: no-cache");  
                header('Content-type: application/pdf'); 
                readfile($archivo); 
            } else { // No se encuentra el archivo, solicitarlo impreso 
                echo "<center><h3>Error de consulta...</br>El archivo solicitado no existe</br></h3>";
                echo '<a href='.$_SERVER['HTTP_REFERER'].'>Regresar...</a>'."\n";
            }
            break;
		case 11:     // INE 
		if(isset($_GET['seccion'])){$seccion=$_GET['seccion'];}else{$seccion=0;}         
			$archivo = 'reinscripcion/'.$seccion.'/idoficial/'.$matricula.'.pdf';
            if (file_exists($archivo)) 	{   //La ficha no se encuentra
                header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE 
                header ("Pragma: no-cache");  
                header('Content-type: application/pdf'); 
                readfile($archivo); 
            } else { // No se encuentra el archivo, solicitarlo impreso 
                echo "<center><h3>Error de consulta...</br>El archivo solicitado no existe</br></h3>";
                echo '<a href='.$_SERVER['HTTP_REFERER'].'>Regresar...</a>'."\n";
            }
            break;
		case 12:     // Domicilio Reinscripcion
            if(isset($_GET['seccion'])){$seccion=$_GET['seccion'];}else{$seccion=0;} 
			$archivo = 'reinscripcion/'.$seccion.'/domicilio/'.$matricula.'.pdf';
            if (file_exists($archivo)) 	{   //La boleta no está bloqueada
                header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE 
                header ("Pragma: no-cache");  
                header('Content-type: application/pdf'); 
                readfile($archivo); 
            } else { // No se encuentra el archivo, solicitarlo impreso 
                echo "<center><h3>Error de consulta...</br>El archivo solicitado no existe</br></h3>";
                echo '<a href='.$_SERVER['HTTP_REFERER'].'>Regresar...</a>'."\n";
            }
            break;
		case 13:     // Contrato
			if(isset($_GET['seccion'])){$seccion=$_GET['seccion'];}else{$seccion=0;} 
            $archivo = 'reinscripcion/'.$seccion.'/contrato/'.$matricula.'.pdf';
            if (file_exists($archivo)) 	{   //La boleta no está bloqueada
                header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE 
                header ("Pragma: no-cache");  
                header('Content-type: application/pdf'); 
                readfile($archivo); 
            } else { // No se encuentra el archivo, solicitarlo impreso 
                echo "<center><h3>Error de consulta...</br>El archivo solicitado no existe</br></h3>";
                echo '<a href='.$_SERVER['HTTP_REFERER'].'>Regresar...</a>'."\n";
            }
            break;
    }
            
} else {
	echo "<center><H3>Error de consulta, revisa tus datos por favor.</h3></center>";
	echo '<a href='.$_SERVER['HTTP_REFERER'].'>Regresar...</a>'."\n";
}

ob_end_flush();
?>
