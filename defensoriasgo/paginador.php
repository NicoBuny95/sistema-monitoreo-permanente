<?php
 
 $estado_session = session_status();

if($estado_session == 1)
{
    session_start();
}

 $auth = $_SESSION['login'];
 $nombreempleado = $_SESSION['nombreempleado'];
 
 if(!$auth){
     header('Location: login.php');
 } 




$CantidadMostrar=5;
//Conexion  al servidor mysql
$conetar = new mysqli("localhost", "root", "", "defensoriadb");
if ($conetar->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
}else{
                    // Validado  la variable GET
    $compag         =(int)(!isset($_GET['pag'])) ? 1 : $_GET['pag']; 
	$TotalReg       =$conetar->query($query = "SELECT * FROM mediciones WHERE nombre_empleado = '$nombreempleado'");
	//Se divide la cantidad de registro de la BD con la cantidad a mostrar 
	$TotalRegistro  =ceil($TotalReg->num_rows/$CantidadMostrar);
	//Consulta SQL
	$consultavistas ="SELECT
						*
						FROM
						mediciones WHERE nombre_empleado = '$nombreempleado'
						ORDER BY
						id_medicion ASC
						LIMIT ".(($compag-1)*$CantidadMostrar)." , ".$CantidadMostrar;
                       // echo $consultavistas;
	$consulta=$conetar->query($consultavistas);
         echo "<table><tr><th>Codigo</th><th>Nombre</th><th>punto monitoreo</th><th>fecha</th><th>hora</th><th>temperatura</th><th>ph</th><th>phmv</th><th>orpmv</th><th>mscm</th><th>ntu</th><th>mgldo</th><th>gltds</th><th>ppt</th><th>densidad</th><th>observaciones</th><th>modificar</th><th>eliminar</th></tr>";
	while ($lista=$consulta->fetch_row()) {
	     echo "<tr><td>".$lista[0]."</td><td>".$lista[1]."</td><td>".$lista[2]."</td><td>".$lista[3]."</td><td>".$lista[4]."</td><td>".$lista[5]."</td><td>".$lista[6]."</td><td>".$lista[7]."</td><td>".$lista[8]."</td><td>".$lista[9]."</td><td>".$lista[10]."</td><td>".$lista[11]."</td><td>".$lista[12]."</td><td>".$lista[13]."</td><td>".$lista[14]."</td><td>".$lista[15]."</td>
		 <td>"."<a class='boton-modificar' href=modificarmedicion.php?id=".$lista[0].">"."modificar"."</a>"."</td>
		 <td>"."<form method='POST'>".
		 "<input type='hidden' name='id' value='$lista[0]' ".">".
		 "<input class='boton-eliminar' type='submit' class='boton-eliminar' value='Eliminar' ".">".
		 "</form>"
		 ."</td></tr>";
	}
	    echo "</table>";
    /*Sector de Paginacion */
    
    //Operacion matematica para boton siguiente y atras 
	$IncrimentNum =(($compag +1)<=$TotalRegistro)?($compag +1):1;
  	$DecrementNum =(($compag -1))<1?1:($compag -1);
  
	echo "<ul><li class=\"btn\"><a href=\"?pag=".$DecrementNum."\">◀</a></li>";
    //Se resta y suma con el numero de pag actual con el cantidad de 
    //numeros  a mostrar
     $Desde=$compag-(ceil($CantidadMostrar/2)-1);
     $Hasta=$compag+(ceil($CantidadMostrar/2)-1);
     
     //Se valida
     $Desde=($Desde<1)?1: $Desde;
     $Hasta=($Hasta<$CantidadMostrar)?$CantidadMostrar:$Hasta;
     //Se muestra los numeros de paginas
     for($i=$Desde; $i<=$Hasta;$i++){
     	//Se valida la paginacion total
     	//de registros
     	if($i<=$TotalRegistro){
     		//Validamos la pag activo
     	  if($i==$compag){
           echo "<li class=\"active\"><a href=\"?pag=".$i."\">".$i."</a></li>";
     	  }else {
     	  	echo "<li><a href=\"?pag=".$i."\">".$i."</a></li>";
     	  }     		
     	}
     }
	echo "<li class=\"btn\"><a href=\"?pag=".$IncrimentNum."\">▶</a></li></ul>";


	/* para borrar registros */

	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		$id = $_POST['id'];
	// borrar el registro
	$res2=$conetar->query($query = "DELETE FROM mediciones WHERE id_medicion = '$id'");
		if($res2){
			header('Location: paneladministracion.php?resultado=3');
		}
	}
  
}
?>
 
   