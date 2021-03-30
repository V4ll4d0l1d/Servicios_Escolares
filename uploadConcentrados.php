<?php
include ("libs.php");
session_start();
$dest_folder = 'Concentrados/';

if (!empty($_FILES)) {
	
	// if dest folder doesen't exists, create it
	if(!file_exists($dest_folder) && !is_dir($dest_folder)) mkdir($dest_folder);
    
    /**
     *  Multiple Files
     *  uploadMultiple = true
     *  @var $_FILES['file']['tmp_name'] array
     *
     */
    foreach($_FILES['file']['tmp_name'] as $key => $value) {
        $tempFile = $_FILES['file']['tmp_name'][$key];
        $targetFile =  $dest_folder. corto_seccion().$_FILES['file']['name'][$key];
        move_uploaded_file($tempFile,$targetFile);
    }
}  
    /**
     *	Response 
     *	
     */
	if( isset($_POST['eliminar'])){
	  $archivo= $_POST['name'];
	  if(unlink($dest_folder.$archivo.".pdf")){
		  echo"Archivo eliminado";
	  }
}else if( isset($_POST['modificar'])){
	$nombre = $_POST['nuevo'];
	$nombreAnt = $_POST['old'];
    $rutaArchivo1 = "./Concentrados/".$nombreAnt;
	$rutaArchivo2 = "./Concentrados/".$nombre.".pdf";
	rename($rutaArchivo1,$rutaArchivo2);
}else{
 $listaArchivos=listarDirectorio($dest_folder);
 $tabla='<table> <tr><th>Archivo</th><th>Fecha de subida</th><th>Grupo</th><th>Eliminar</th></tr>';
 $i=0;
 foreach($listaArchivos as $archivo){
	$nArchivo=explode("/",$archivo['Nombre']);
	$nomArchivo=explode(".",$nArchivo[1]);
	$_seccion=substr ( $nomArchivo[0] , 0 , 3 );
	if(strcmp(corto_seccion(),$_seccion) === 0){
		$i++;
		$tabla.='<tr><td><i class="fas fa-file-pdf"></i><a href="'.$archivo['Nombre'].'" target="_blank">'.$nomArchivo[0].'</a></td>';
		$tabla.='<td>'.date("F d Y", filectime($archivo['Nombre'])).'</td>';
		$tabla.='<td><input type="text"  name="'.$nArchivo[1].'"  value="'.$nomArchivo[0].'" maxlength="5"></td>';
		$tabla.='<td><a href="#"><i class="fas fa-trash remove_image" id="'.$nomArchivo[0].'"> </i></a></td>';
		$tabla.='</tr>';
		
	}
 }
 $tabla.='</table>';

echo $tabla;
}




?>