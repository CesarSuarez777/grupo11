<?php

    include 'funciones.php';
    
    $link = conectarABase();
    session_start();
    
    $IDusuario = $_SESSION['id'];
    $idviaje = $_GET['id'];
    

    
    $calificacionPendientes = false;
    $calificaciones = mysqli_query($link,"SELECT * FROM calificaciones where IDorigen=$IDusuario");
    $hace30 = new DateTime('-30 days');
    
    while($cali = $calificaciones->fetch_array(MYSQLI_NUM)){
        $fechaCal = new DateTime($cali[3]);
        if((($cali[4])==0) && ($hace30 > $fechaCal)){
            $calificacionPendientes=true;
        }
    }
    
    $viaje = mysqli_query($link, "SELECT IDconductor,asientos_disponibles FROM viajes where IDviaje=$idviaje");
    $viaje = $viaje->fetch_array(MYSQLI_NUM);
    
    if($viaje[0]==$IDusuario){
        header("Location: verViaje.php?id=$idviaje&viajepropio=true");
        exit();
    }
    
    if($viaje[1]==0){
        header("Location: verViaje.php?id=$idviaje&asientosNO=true");
        exit();
    }
    
    if($calificacionPendientes){
        header("Location: verViaje.php?id=$idviaje?califpendientes=true");
        exit();
    }
    
    $tarjetas = mysqli_query($link, "SELECT fecha_vencimiento FROM tarjetas where IDtarjeta=$IDusuario");
    
    if ($tarjetas->num_rows == 0){
        header("Location: verViaje.php?id=$idviaje&notarjeta=true");
        exit();
    }
    
    $postulados = mysqli_query($link,"SELECT IDusuario FROM postulados_usuarios_viajes where IDusuario=$IDusuario and IDviaje=$idviaje");
    
    if($postulados->num_rows > 0){
        header("Location: verViaje.php?id=$idviaje&yapostulado=true");
        exit();
    }
            
    
    $tarjetas = $tarjetas -> fetch_Array(MYSQLI_NUM);
    $hoy = new DateTime('today');
    $vencimiento = new DateTime($tarjetas[0]);
    
    if($hoy>$vencimiento){
        header("Location: verViaje.php?id=$idviaje&tarjetavencida=true");
        exit();
    }
    
    if(mysqli_query($link, "INSERT INTO postulados_usuarios_viajes (IDusuario,IDviaje) VALUES ($IDusuario,$idviaje)")){
         header("Location: verViaje.php?id=$idviaje&exito=true");
    }else{
         header("Location: verViaje.php?id=$idviaje&exito=false");
    }
   
    exit();