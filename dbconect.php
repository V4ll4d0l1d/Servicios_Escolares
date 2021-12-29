<?php
require_once 'conexionPDO.php';

//******************************************************************************************************************************
//******************************************************************************************************************************
//******************************************************************************************************************************
//******************************************************************************************************************************
//******************************************************************************************************************************
// funciones de BD relacionadas con los usuarios
class Usuario {
  private $id;
  private $pass;
  private $type;
  private $privs;
  private $Nombre;
  private $Apellido;

//*************************************************************************************************
// Funcion:     login
// Descripción: Consulta las bases de datos para verificar si el usuario existe
// Parametros:  usuario, contraseña del formulario
//*************************************************************************************************

public function login($id,$pass){
  $conn = new Conexion();
  //Preparamos la consulta
  $pass = md5($pass);//Se cifra la contraseña ingresada por el usuario para comparar con la contraseña cifrada en la BD
  $stmt = $conn->prepare ("SELECT * FROM usuarios WHERE Id = :ss AND Pass = :pp");
 $stmt->execute(array(':ss' => $id ,':pp'=> $pass));
 $stmt->setFetchMode(PDO::FETCH_ASSOC);
 if ($registro = $stmt->fetch()) {
   $usuario = array(
     'Id' => $registro['Id'],
     'Pass' => $registro['Pass'],
     'Type' => $registro['Type'],
     'Privs' => $registro['Privileges']
   );
   return $usuario;
 } //fin while
 // echo 'Error en la consulta';
 return false;
}

//*************************************************************************************************
// Funcion:     datosAlummno
// Descripción: Si el usuario existe y su type = 0, es alumno, entonces obten sus datos de la 
//              tabla correspondiente
// Parametros:  Matricula
//*************************************************************************************************

public function datosAlumno($Id){
 $alumno=null;
 $conn=new Conexion();
 try {
  $comando = $conn->prepare ("SELECT Nombre, Apellidos, Grado, Grupo, Seccion, IdGrupo, Correo FROM datosidalumno WHERE Id = :ss");
  $comando->execute(array(':ss' => $Id));
  if($row = $comando->fetch(PDO::FETCH_ASSOC)) {
    $alumno=array(
      'Nombres'=>$row['Nombre'],
      'Apellidos'=>$row['Apellidos'],
      'Grado'=>$row['Grado'],
      'Grupo'=>$row['Grupo'],
      'Seccion'=>$row['Seccion'],
      'IdGrupo'=>$row['IdGrupo'],
      'Correo'=>$row['Correo']
    );
    return $alumno;
  } else {
    echo 'No existen datos del alumno';
    return false;
  }
} catch(PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
}

//*************************************************************************************************
// Funcion:     datosUsuario
// Descripción: Si el usuario existe y su type = 1, es usuario (docente o administrador), 
//              entonces obten sus datos de la tabla correspondiente
// Parametros:  username
//*************************************************************************************************

public function datosUsuario($Id){
 $usuario=null;
 $conn=new Conexion();
 try {
  $comando = $conn->prepare ("SELECT Nombres, Seccion, Grado, Carrera FROM datosidusuario WHERE Id = :ss");
  $comando->execute(array(':ss' => $Id));
  if($row = $comando->fetch(PDO::FETCH_ASSOC)) {
    $usuario=array(
      'Nombres'=>$row['Nombres'],
      'Seccion'=>$row['Seccion'],
      'Grado'=>$row['Grado'],
      'Carrera'=>$row['Carrera'],
    );
    return $usuario;
  } else {
    echo 'No existen datos del Usuario';
    return false;
  }
} catch(PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
}

}

//******************************************************************************************************************************
//******************************************************************************************************************************
//******************************************************************************************************************************
//******************************************************************************************************************************
//******************************************************************************************************************************
// funciones relacionadas con los alumnos
class alumnos {
  private $id;
  private $nombre;
  private $apellidos;
  private $grado;
  private $grupo;
  private $seccion;
  // estos son para reinscripcion
  private $calle;
  private $colonia;
  private $ciudad;
  private $estado;
  private $postal;
  private $telfijo;
  private $celular;
  private $correo;
  private $ciclo;

public function lista_alumnos($Grupo){
    $listado=null;
    $conn=new Conexion();
    try {
        $stmt = $conn->prepare ("SELECT Id, Nombre, Apellidos, Grado, Grupo, Seccion, IdGrupo, Correo FROM datosidalumno WHERE IdGrupo = :gg order by Apellidos");
        $stmt->bindParam(':gg', $Grupo);
        $stmt->execute();
        $resultado= $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    } catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

// Actualiza los datos para determinar el grado al que se reinscribe el alumno
//public function 

// Consulta los datos de contacto para el formulario de reinscripcion
public function lista_alumnos_contacto($Matricula) {
    $listado=null;
    $conn=new Conexion();
    try {
        $stmt = $conn->prepare ("SELECT Calle, Colonia, Ciudad, Estado, Postal, TelFijo, Celular, Correo FROM contactoalumno WHERE Id = :gg");
        $stmt->bindParam(':gg', $Matricula);
        $stmt->execute();
        $resultado= $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    } catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

// Actualiza los datos de contacto en el formulario de reinscripcion
public function update_alumnos_contacto ($Matricula, $Calle, $Colonia, $Ciudad, $Estado, $Postal, $TelFijo, $Celular, $Correo) {
    try {
        $conn = new Conexion();
        $sql = "UPDATE contactoalumno SET Calle= :a, Colonia= :b, Ciudad=:c, Estado=:d, Postal=:e, TelFijo=:f, Celular=:g, Correo=:h WHERE Id=:i";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':a', $Calle);
        $stmt->bindParam(':b', $Colonia);
        $stmt->bindParam(':c', $Ciudad);
        $stmt->bindParam(':d', $Estado);
        $stmt->bindParam(':e', $Postal);
        $stmt->bindParam(':f', $TelFijo);
        $stmt->bindParam(':g', $Celular);
        $stmt->bindParam(':h', $Correo);
        $stmt->bindParam(':i', $Matricula);
        if ($stmt->execute()) {
            return true;
        } else {
            print_r($stmt->errorInfo());
            return false;
        }
    } catch(PDOException $e) {
        echo "Error en conexion: ".$e->getMessage();
        return false;
    }
}

// Actualiza los datos de contacto en el formulario de reinscripcion
public function update_correo ($Matricula, $Correo) {
    try {
        $conn = new Conexion();
        $sql = "UPDATE datosidalumno SET Correo=? WHERE Id=?";
        $stmt = $conn->prepare($sql);
        if ($stmt->execute(array($Correo, $Matricula))) {
            $_SESSION['Correo'] = $Correo;
            return true;
        } else {    // error al actualizar el correo en la tabla principal
            print_r($stmt->errorInfo());
            return false;
        }
        
    } catch(PDOException $e) {
        echo 'Error: '. $e->getMessage();
        return false;
    }
return true;
}


// Si el registro no existe, se tiene que insertar
public function insert_alumnos_contacto ($Matricula, $Calle, $Colonia, $Ciudad, $Estado, $Postal, $TelFijo, $Celular, $Correo) {
    try {
        $conn = new Conexion();
        $sql = "INSERT INTO contactoalumno (Id, Calle, Colonia, Ciudad, Estado, Postal, TelFijo, Celular, Correo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt->execute(array($Matricula, $Calle, $Colonia, $Ciudad, $Estado, $Postal, $TelFijo, $Celular, $Correo))) {
            return true;
        } else {        //Problema en inserción
            print_r($stmt->errorInfo());
            return false;
        }
    } catch(PDOException $e) {
        echo "Error en conexion: ".$e->getMessage();
        return false;
    }
}
    
// Actualizar bitácora de reinscripcion
public function insert_reinscripcion ($Matricula, $Seccion, $CicloAct, $CicloSig, $Grado,$flag) {
    try {
        $conn = new Conexion();
        $sql = "INSERT INTO reinscripciones (Id, Seccion, CicloAct, CicloSig, Grado, Fecha, flag) VALUES (?, ?, ?, ?, ?, now(),?)";
        $stmt = $conn->prepare($sql);
        if ($stmt->execute(array($Matricula, $Seccion, $CicloAct, $CicloSig, $Grado,$flag))) {
            return true;
        } else {        //Problema en inserción
            print_r($stmt->errorInfo());
            return false;
        }
    } catch(PDOException $e) {
        echo "Error en conexion: ".$e->getMessage();
        return false;
    }
}

// Actualiza Es Status de la solicitud de Beca de un alumno
public function status_reinscripcion ($Matricula, $Status, $CicloAct, $obs, $flag) {
    try {
        $conn = new Conexion();
        $sql = "UPDATE reinscripciones SET Status=?, Fecha=now(), Observaciones=? WHERE Id=? and CicloAct=?";
        $stmt = $conn->prepare($sql);
        if ($stmt->execute(array($Status,$obs, $Matricula, $CicloAct, $flag))) {
            return true;
        } else {    // error al actualizar el Status
            print_r($stmt->errorInfo());
            return false;
        }
        
    } catch(PDOException $e) {
        echo 'Error: '. $e->getMessage();
        return false;
    }
}

//Tabla de reinscripcion
public function infoReinscripcionGeneral($seccion){
	try{
		$conn = new Conexion();
		$stmt = $conn->prepare ("SELECT idgrupo,reinscripciones.grado, count(datosidalumno.Id), count(reinscripciones.Id), cicloAct, cicloSig, reinscripciones.grado, status FROM `datosidalumno` left join reinscripciones on reinscripciones.Id=datosidalumno.Id WHERE datosidalumno.seccion=:sc group by datosidalumno.IdGrupo, reinscripciones.Grado, status");
		$stmt->bindParam(':sc', $seccion);
        $stmt->execute();
        $resultado= $stmt->fetchAll(PDO::FETCH_ASSOC);
		print_r($resultado);
        return $resultado;	
	}catch(PDOException $e){
		 echo 'Error: '. $e->getMessage();
        return false;
	}
}
//Cantidad de alumnos inscritos por seccion, grupo 
//Nivel basico
public function infoInscritos($seccion,$car){
	$car1=$car."%";
	try{
		$conn = new Conexion();
		$stmt = $conn->prepare ("SELECT Grado, count(*) FROM datosidalumno where Seccion=:sc and IdGrupo like :car group by Grado order by Grado");
		$stmt->execute(array(':sc' => $seccion ,':car'=> $car1));
        $resultado= $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;	
	}catch(PDOException $e){
		 echo 'Error: '. $e->getMessage();
        return false;
	}
}
//Cantidad de alumnos inscritos por seccion, grupo 
//Nivel basico
public function infoInscritosgrado($seccion,$car,$grado){
	$car1=$car."%";
	try{
		$conn = new Conexion();
		$stmt = $conn->prepare ("SELECT count(*) FROM datosidalumno where Seccion=:sc and IdGrupo like :car and grado=:grado group by Grado order by Grado");
		$stmt->execute(array(':sc' => $seccion ,':car'=> $car1,':grado'=>$grado));
        $resultado= $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;	
	}catch(PDOException $e){
		 echo 'Error: '. $e->getMessage();
        return false;
	}
}
//Cantidad de alumnos que modificaron sus datos por seccion, grupo 
//Nivel basico
public function infoflagStatus($seccion,$car,$grado){
	$car1=$car."%";
	try{
		$conn = new Conexion();
		$stmt = $conn->prepare ("SELECT count(*) FROM reinscripciones inner join datosidalumno on reinscripciones.Id=datosidalumno.Id where reinscripciones.Seccion=:sc and IdGrupo like :car and reinscripciones.grado=:grado and flag>1");
		$stmt->execute(array(':sc' => $seccion ,':car'=> $car1,':grado'=>$grado));
        $resultado= $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;	
	}catch(PDOException $e){
		 echo 'Error: '. $e->getMessage();
        return false;
	}
}


//Cantidad de alumnos con proceso de reinscripcion
public function cantReinscripcion($seccion,$carrera,$grado){
	$car1=$carrera."%";
	try{
		$conn = new Conexion();
		$stmt = $conn->prepare ("SELECT  reinscripciones.Grado, count(*) FROM reinscripciones inner join datosidalumno on reinscripciones.Id=datosidalumno.Id where reinscripciones.Seccion=:sc and IdGrupo like :car and reinscripciones.Grado=:grado");
		$stmt->execute(array(':sc' => $seccion ,':car'=> $car1,':grado'=>$grado));
        $resultado= $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;	
	}catch(PDOException $e){
		 echo 'Error: '. $e->getMessage();
        return false;
	}
}

//Cantidad de alumnos por status
public function cantReinsStatus($seccion,$carrera,$grado,$estatus){
	$car1=$carrera."%";
	try{
		$conn = new Conexion();
		if($estatus==1){
		$stmt = $conn->prepare ("SELECT  reinscripciones.Grado,count(*) FROM reinscripciones inner join datosidalumno on reinscripciones.Id=datosidalumno.Id where reinscripciones.Seccion=:sc and IdGrupo like :car and reinscripciones.Grado=:grado and Status<=:estatus");
		}else{if($estatus==2){
		$stmt = $conn->prepare ("SELECT  reinscripciones.Grado,count(*) FROM reinscripciones inner join datosidalumno on reinscripciones.Id=datosidalumno.Id where reinscripciones.Seccion=:sc and IdGrupo like :car and reinscripciones.Grado=:grado and Status=:estatus");}}
		$stmt->execute(array(':sc' => $seccion ,':car'=> $car1,':grado'=>$grado,':estatus'=>$estatus));
        $resultado= $stmt->fetchAll(PDO::FETCH_ASSOC);
		//print_r ($resultado);
        return $resultado;	
	}catch(PDOException $e){
		 echo 'Error: '. $e->getMessage();
        return false;
	}
}
//Status de reinscripcion
public function estatusReinscripcion($matricula,$cicloAct){
	try{
		$conn = new Conexion();
		$stmt = $conn->prepare ("SELECT  Status FROM reinscripciones where Id=:matricula and CicloAct=:cicloAct");
		$stmt->execute(array(':matricula' => $matricula ,':cicloAct'=> $cicloAct));
        $resultado= $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;	
	}catch(PDOException $e){
		 echo 'Error: '. $e->getMessage();
        return false;
	}
}
//OBSERVACIONES DE Reinscripciones
public function ObservacionesReinscripcion($matricula,$cicloAct){
	try{
		$conn = new Conexion();
		$stmt = $conn->prepare ("SELECT  Observaciones FROM reinscripciones where Id=:matricula and CicloAct=:cicloAct");
		$stmt->execute(array(':matricula' => $matricula ,':cicloAct'=> $cicloAct));
        $resultado= $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;	
	}catch(PDOException $e){
		 echo 'Error: '. $e->getMessage();
        return false;
	}
}

public function lista_reinscripcion($_seccion,$_grado,$_carrera,$_estatus,$_cicloAct){
	$car1=$_carrera."%";
	try{
		$conn = new Conexion();
		$stmt = $conn->prepare ("SELECT  * FROM reinscripciones inner join datosidalumno on reinscripciones.Id=datosidalumno.Id where reinscripciones.Seccion=:sc and IdGrupo like :car and reinscripciones.Grado=:grado and Status=:estatus and CicloAct=:cicloAct");
		$stmt->execute(array(':sc' => $_seccion,':car'=>$car1,':grado'=>$_grado,':estatus'=>$_estatus,':cicloAct'=>$_cicloAct));
        $resultado= $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;	
	}catch(PDOException $e){
		 echo 'Error: '. $e->getMessage();
        return false;
	}
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// BECAS BECAS BECAS BECAS BECAS BECAS BECAS BECAS BECAS BECAS BECAS BECAS BECAS BECAS BECAS BECAS BECAS BECAS BECAS BECAS 
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// Consulta la bitácora de becas para saber si el alumno ha intentado llenar los datos de registro
public function lista_becas($Matricula, $Ciclo) {
    $listado=null;
    $conn=new Conexion();
    try {
        $stmt = $conn->prepare ("SELECT Id, Seccion, CicloAct, CicloSig, Grado, Tipo, Status, Fecha, Observaciones FROM becas WHERE Id = :gg and CicloAct = :cc");
        $stmt->bindParam(':gg', $Matricula);
        $stmt->bindParam(':cc', $Ciclo);
        $stmt->execute();
        $resultado= $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    } catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
// Consulta la bitácora de becas para alimentar el listado para revisión
public function lista_becas_alumno($Matricula, $Ciclo) {
    $listado=null;
    $conn=new Conexion();
    try {
    //SELECT becas.Id, becas.Seccion, becas.CicloAct, becas.CicloSig, becas.Grado, becas.Tipo, becas.Status, becas.Fecha, becas.Observaciones, datosidalumno.Apellidos, datosidalumno.Nombre FROM becas INNER JOIN datosidalumno ON becas.Id = datosidalumno.Id WHERE becas.Id ='160023'
        $stmt = $conn->prepare ("SELECT becas.Id, becas.Seccion, becas.CicloAct, becas.CicloSig, becas.Grado, becas.Tipo, becas.Status, becas.Fecha, becas.Observaciones, becas.Review, datosidalumno.Apellidos, datosidalumno.Nombre FROM becas INNER JOIN datosidalumno ON becas.Id = datosidalumno.Id WHERE becas.Id = :gg and becas.CicloAct = :cc");
        $stmt->bindParam(':gg', $Matricula);
        $stmt->bindParam(':cc', $Ciclo);
        $stmt->execute();
        $resultado= $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    } catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

public function lista_becas_grupos($Seccion, $Grupo) {
    $listado=null;
    $conn=new Conexion();
    //echo '<p>'.$Seccion.'-'.$Grupo.'</p>';
    try {
        $stmt = $conn->prepare ("SELECT becas.Id, datosidalumno.Nombre, datosidalumno.Apellidos, datosidalumno.Seccion, datosidalumno.IdGrupo, becas.Tipo, becas.Status, becas.Fecha FROM becas INNER JOIN datosidalumno ON becas.Id = datosidalumno.Id where becas.Seccion = :ss and datosidalumno.IdGrupo = :gg ORDER BY datosidalumno.Apellidos");
        $stmt->bindParam(':ss', $Seccion);
        $stmt->bindParam(':gg', $Grupo);
        $stmt->execute();
        $resultado= $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    } catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}


public function lista_becas_carrera($carrera) {
    $listado=null;
    $conn=new Conexion();
    //echo '<p>'.$Seccion.'-'.$Grupo.'</p>';
    try {            
        $stmt = $conn->prepare ("SELECT becas.Id, datosidalumno.Nombre, datosidalumno.Apellidos, datosidalumno.Seccion, datosidalumno.IdGrupo, becas.Tipo, becas.Status, becas.Fecha FROM becas INNER JOIN datosidalumno ON becas.Id = datosidalumno.Id where becas.Seccion = :ss ORDER BY datosidalumno.IdGrupo" );
        $stmt->bindParam(':ss', $carrera);
        $stmt->execute();
        $resultado= $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    } catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

// Actualizar la bitácora cuando el alumno ha subido datos
public function insert_beca ($Matricula, $Seccion, $CicloAct, $CicloSig, $Grado, $Tipo) {
    try {
        $conn = new Conexion();
        $sql = "INSERT INTO becas (Id, Seccion, CicloAct, CicloSig, Grado, Tipo, Fecha) VALUES (?, ?, ?, ?, ?, ?, now())";
        $stmt = $conn->prepare($sql);
        if ($stmt->execute(array($Matricula, $Seccion, $CicloAct, $CicloSig, $Grado, $Tipo))) {
            return true;
        } else {        //Problema en inserción
            print_r($stmt->errorInfo());
            return false;
        }
    } catch(PDOException $e) {
        echo "Error en conexion: ".$e->getMessage();
        return false;
    }
}

// Actualiza la fecha de la solicitud de Beca de un alumno
public function update_beca ($Matricula, $Tipo, $Cicloact) {
    try {
        $conn = new Conexion();
        $sql = "UPDATE becas SET Tipo=?, Fecha=now() WHERE Id=? and Cicloact=?";
        $stmt = $conn->prepare($sql);
        if ($stmt->execute(array($Tipo, $Matricula, $Cicloact))) {
            return true;
        } else {    // error al actualizar el Status
            print_r($stmt->errorInfo());
            return false;
        }
        
    } catch(PDOException $e) {
        echo 'Error: '. $e->getMessage();
        return false;
    }
}

// Actualiza la fecha de la solicitud de Beca de un alumno POR PARTE DEL COMITE
public function update_status_beca ($Matricula, $Status, $Tipo, $Cicloact, $Observaciones, $Review) {
    try {
        $conn = new Conexion();
        $sql = "UPDATE becas SET Tipo=?, Status=?, Observaciones=?, Review=? WHERE Id=? and Cicloact=?";
        $stmt = $conn->prepare($sql);
        if ($stmt->execute(array($Tipo, $Status, $Observaciones, $Review, $Matricula, $Cicloact))) {
            return true;
        } else {    // error al actualizar el Status
            print_r($stmt->errorInfo());
            return false;
        }
            
    } catch(PDOException $e) {
        echo 'Error: '. $e->getMessage();
        return false;
    }
}


// Actualiza Es Status de la solicitud de Beca de un alumno
public function status_beca ($Matricula, $Status, $Fecha) {
    try {
        $conn = new Conexion();
        $sql = "UPDATE becas SET Status=? WHERE Id=? and Fecha=?";
        $stmt = $conn->prepare($sql);
        if ($stmt->execute(array($Status, $Matricula, $Fecha))) {
            return true;
        } else {    // error al actualizar el Status
            print_r($stmt->errorInfo());
            return false;
        }
        
    } catch(PDOException $e) {
        echo 'Error: '. $e->getMessage();
        return false;
    }
}


}
  



//*************************************************************************************************************************
//*************************************************************************************************************************
//*************************************************************************************************************************
//*************************************************************************************************************************
//*************************************************************************************************************************
// funciones para los titulares y usuarios
class Titular {
  private $IdUsuario;
  private $Ciclo;
  private $IdGrupo;
  private $Consecutivo;


public function lista_grupos($Usuario){
    $listado=null;
    $conn=new Conexion();
    try {
        $stmt = $conn->prepare ("SELECT IdUsuario, Ciclo, IdGrupo, Consecutivo FROM titulares WHERE IdUsuario = :gg");
        $stmt->bindParam(':gg', $Usuario);
        $stmt->execute();
        $resultado= $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    } catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}


public function lista_seccion($Seccion){
    $listado=null;
    $conn=new Conexion();
    try {
        $stmt = $conn->prepare ("SELECT IdGrupo, Grado, Ciclo FROM grupos WHERE Seccion = :gg order By IdGrupo");
        $stmt->bindParam(':gg', $Seccion);
        $stmt->execute();
        $resultado= $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    } catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

public function lista_carrera($carrera) {
    $listado=null;
    $conn=new Conexion();
    try {
        $stmt = $conn->prepare ("SELECT IdGrupo, Grado, Ciclo FROM grupos WHERE IdGrupo LIKE :term ORDER BY IdGrupo");
        $stmt->bindValue(':term', $carrera.'%');
        //$stmt->bindParam('s', $search);
        $stmt->execute();
        $resultado= $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    } catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}



}


//*************************************************************************************************************************
//*************************************************************************************************************************
//*************************************************************************************************************************
//*************************************************************************************************************************
//*************************************************************************************************************************
// Se utiliza para los avisos de la página index
class aviso {
private $Consecutivo;
private $Seccion;
private $Grado;
private $Grupo;
private $Titulo;
private $Contenido;
private $Url;
private $Imagen;
private $Fecha_inicio;
private $Fecha_fin;
private $Activo;
private $Usuario;

//*************************************************************************************************
// Funcion:     getAvisos
// Descripción: Una vez que ingresó, buscar los avisos correspondientes a su sección o generales
// Parametros:  Seccion
//*************************************************************************************************

public function leer_avisos_grado($Seccion, $CortoSeccion, $Grado, $Grupo){
    $conn=new Conexion();
    try {
        //$sql1 = "SELECT Seccion, Grado, Titulo, Contenido, Url, Imagen FROM avisos WHERE (Grado = 0 OR Grado = :pp) AND (Seccion = :ss";
		$sql1 = "SELECT * FROM avisos WHERE (Grado = 0 OR Grado = :pp) AND (Seccion = :ss";
		if ($Seccion == '4') {
			$sqlint = " OR Seccion = 'UNI'";
		} else {
			$sqlint = "";
		}
		$sql2 = ") AND Grupo = '' AND (curdate() > Fecha_Inicio AND curdate() < Fecha_Fin) and Activo='Si' UNION SELECT * FROM avisos WHERE Grupo = :gg ORDER BY Fecha_Fin DESC LIMIT 3";
		$sql = $sql1.$sqlint.$sql2;
        $stmt = $conn->prepare ($sql);
        $stmt->bindParam(':pp', $Grado);
        $stmt->bindParam(':ss', $CortoSeccion);
        $stmt->bindParam(':gg', $Grupo);
        $stmt->execute();
        $resultado= $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    } catch(PDOException $e) {
        echo 'Error: '.$sql .' '. $e->getMessage();
    }
    close($conn);
}

public function leer_avisos_grupo($Seccion, $Grupo){
    $conn=new Conexion();
    try {                                                                                                      
        $stmt = $conn->prepare ("SELECT Seccion, Grado, Grupo, Titulo, Contenido, Url, Imagen FROM avisos WHERE Grupo = :gg AND (curdate() > Fecha_Inicio AND curdate() < Fecha_Fin) AND Activo = 'Si'");
        $stmt->bindParam(':gg', $Grupo);
        $stmt->execute();
        $resultado= $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    } catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

public function lista_avisos(){
    $conn=new Conexion();
    try {
        $stmt = $conn->prepare ("SELECT Consecutivo, Seccion, Grado, Grupo, Titulo, Contenido, Url, Activo, Imagen, Fecha_Inicio, Fecha_Fin, Usuario FROM avisos ORDER BY Seccion");
        $stmt->execute();
        $resultado= $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    } catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

public function insert_aviso ($Seccion, $Grado, $Grupo, $Titulo, $Contenido, $Url, $Imagen, $Finicio, $Ffin, $Activo, $Usuario) {
    try {
        $conn = new Conexion();
        $sql = "INSERT INTO avisos (Seccion, Grado, Grupo, Titulo, Contenido, Url, Imagen, Fecha_Inicio, Fecha_Fin, Activo, Usuario) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt->execute(array($Seccion, $Grado, $Grupo, $Titulo, $Contenido, $Url, $Imagen, $Finicio, $Ffin, $Activo, $Usuario))) {
            return true;
        } else {        //Problema en inserción
            print_r($stmt->errorInfo());
            return false;
        }
    } catch(PDOException $e) {
        echo "Error en conexion: ".$e->getMessage();
        return false;
    }
 }

 public function lockavisos($id, $tipo) {
    switch($tipo) {
        case '1':
            $sql = "UPDATE avisos SET Activo='No' WHERE Consecutivo = :cc";
            break;
        case 2:
            $sql = "UPDATE avisos SET Activo='Si' WHERE Consecutivo = :cc";
            break;
    }
    try {
        $conn = new Conexion();
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':cc', $id);
        if ($stmt->execute()) {
            return true;
        } else {    // error al actualizar el Status
            print_r($stmt->errorInfo());
            return false;
        }
    } catch(PDOException $e) {
        echo 'Error: '. $e->getMessage();
        return false;
    }
    
 }
 

}
//****************************************************************************************************************************************

class Circular {
  private $Seccion;
  private $Ciclo;
  private $Grupo;
  private $Descripcion;
  private $Archivo;

  public function insert_circular ($Seccion, $Grupo, $Descripcion, $Archivo, $Ciclo) {
    try {
        $conn = new Conexion();
        $sql = "INSERT INTO circulares (Seccion, IdGrupo, Descripcion, Archivo, Ciclo) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt->execute(array($Seccion, $Grupo, $Descripcion, $Archivo, $Ciclo))) {
            return true;
        } else {        //Problema en inserción
            print_r($stmt->errorInfo());
            return false;
        }
    } catch(PDOException $e) {
        echo "Error en conexion: ".$e->getMessage();
        return false;
    }
 }
 
  public function lista_circular_alumno($Grupo, $Seccion, $Ciclo) {
    try {
        $conn = new Conexion();
        $sql = "SELECT Seccion, IdGrupo, Descripcion, Archivo, Ciclo FROM circulares WHERE IdGrupo = :gg AND Ciclo = :cc AND Visible='Si' UNION (SELECT Seccion, IdGrupo, Descripcion, Archivo, Ciclo FROM
		circulares WHERE Seccion = :ss AND IdGrupo='' AND Ciclo = :cc AND Visible='Si')";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':gg', $Grupo);
		$stmt->bindParam(':ss', $Seccion);
        $stmt->bindParam(':cc', $Ciclo);
        $stmt->execute();
        $resultado= $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    } catch(PDOException $e) {
        echo "Error en conexion: ".$e->getMessage();
        return false;
    }
  }
 
  public function lista_circular_seccion($Seccion, $Ciclo) {
    try {
        $conn = new Conexion();
		$sql = "SELECT IdCircular, Seccion, IdGrupo, Descripcion, Archivo, Ciclo, Visible FROM circulares WHERE Seccion = :ss AND Ciclo = :cc";
        $stmt = $conn->prepare($sql);
		$stmt->bindParam(':ss', $Seccion);
        $stmt->bindParam(':cc', $Ciclo);
        $stmt->execute();
        $resultado= $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    } catch(PDOException $e) {
        echo "Error en conexion: ".$e->getMessage();
        return false;
    }
  }
 
 public function lockcircular($id, $tipo) {
    switch($tipo) {
        case '1':
            $sql = "UPDATE circulares SET Visible='No' WHERE IdCircular = :cc";
			echo 'alert("Ocultar")';
            break;
        case 2:
            $sql = "UPDATE circulares SET Visible='Si' WHERE IdCircular = :cc";
			echo 'alert("Mostrar")';
            break;
    }
    try {
        $conn = new Conexion();
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':cc', $id);
        if ($stmt->execute()) {
            return true;
        } else {    // error al actualizar el Status
            print_r($stmt->errorInfo());
            return false;
        }
    } catch(PDOException $e) {
        echo 'Error: '. $e->getMessage();
        return false;
    }
    
 }
  
}

//*************************************************************************************************************************
//*************************************************************************************************************************
//*************************************************************************************************************************
//*************************************************************************************************************************
//*************************************************************************************************************************
// Se utiliza para la validación y lectura de codigos QR de los certificados
class certificado {

private $Consecutivo;
private $Id;
private $Seccion;
private $Grupo;
private $Fecha;
private $Timestamp;


//*************************************************************************************************
// Funcion:     leer_Matricula
// Descripción: Buscar los ingresos por matrícula
// Parametros:  Seccion
//*************************************************************************************************

public function leer_Matricula($Seccion, $Grado){
    $conn=new Conexion();
    try {
        $stmt = $conn->prepare ("SELECT Consecutivo, Id, Seccion, Grupo, Fecha, Timestamp FROM certificado WHERE Id = :ss");
        $stmt->bindParam(':ss', $Id);
        $stmt->execute();
        $resultado= $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    } catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

public function insert_certificado ($Id, $Seccion, $Grupo, $Fecha) {
    try {
        $conn = new Conexion();
        $sql = "INSERT INTO certificado (Id, Seccion, Grupo, Fecha) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt->execute(array($Id, $Seccion, $Grupo, $Fecha))) {
            return true;
        } else {        //Problema en inserción
            print_r($stmt->errorInfo());
            return false;
        }
    } catch(PDOException $e) {
        echo "Error en conexion: ".$e->getMessage();
        return false;
    }
 }

public function select_autorizacion($Id) {
	$conn=new Conexion();
    try {
        $stmt = $conn->prepare ("SELECT Consecutivo, Id, Seccion, Grupo, Fecha, Autoriza, Timestamp FROM autorizacion WHERE Id = :ss");
        $stmt->bindParam(':ss', $Id);
        $stmt->execute();
        $resultado= $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    } catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
 
public function insert_autorizacion ($Id, $Seccion, $Grupo, $Fecha, $Autoriza) {
    try {
        $conn = new Conexion();
        $sql = "INSERT INTO autorizacion (Id, Seccion, Grupo, Fecha, Autoriza) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt->execute(array($Id, $Seccion, $Grupo, $Fecha, $Autoriza))) {
            return true;
        } else {        //Problema en inserción
            print_r($stmt->errorInfo());
            return false;
        }
    } catch(PDOException $e) {
        echo "Error en conexion: ".$e->getMessage();
        return false;
    }
 }
 
}


?>
