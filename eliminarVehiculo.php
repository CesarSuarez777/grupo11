<?php
	session_start();
    require('funciones.php');
    $link = conectarABase();
    $id = $_SESSION['id'];
    $idVehiculo = $_GET['id'];
    
    $hoy = new DateTime('today');
    $viajesPendientes = mysqli_query($link,"SELECT fecha,hora FROM viajes where IDvehiculo=$idVehiculo");
    while($fila= $viajesPendientes->fetch_array(MYSQLI_NUM)){
          $fechaViaje = new DateTime($fila[0] . $fila[1]);
          if($hoy<$fechaViaje){
              header('Location: MiCuenta.php?vusadoe=true');
              exit();
          }
    }
            
    $viajes = mysqli_query($link,"SELECT * FROM viajes where IDconductor=$id");
    $vehiculoOcupado=false;
    while ($filaVe = $viajes -> fetch_array(MYSQLI_NUM)){
    	if($idVehiculo == $filaVe[3]){
    		$vehiculoOcupado=true;
    	}
    }
    if(!$vehiculoOcupado){
   	 	$sql = "DELETE FROM vehiculos WHERE IDvehiculo='$idVehiculo'";
    	mysqli_query($link, $sql);
   		mysqli_close($link);
   		header('Location: MiCuenta.php?veliminado=true');
   	}else{
   		header('Location: MiCuenta.php?vocupado=true');
   	}


