<?php
	session_start();
    require('funciones.php');
    $link = conectarABase();
    $id = $_SESSION['id'];
    $idVehiculo = $_GET['id'];
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


