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
    
    $viaje = mysqli_query($link, "SELECT fecha,hora,IDconductor,llegada,asientos_disponibles FROM viajes where IDviaje=$idviaje");
    $viaje = $viaje->fetch_array(MYSQLI_NUM);
    
    if($viaje[2]==$IDusuario){
        header("Location: verViaje.php?id=$idviaje&viajepropio=true");
        exit();
    }
    
    if($viaje[4]==0){
        header("Location: verViaje.php?id=$idviaje&asientosNO=true");
        exit();
    }
    
    $horaViajeIinicio = new DateTime($viaje[0] . $viaje[1]);
    $horaViajeFin = new DateTime($viaje[3]);
    
    $viajes = mysqli_query($link, "SELECT fecha,hora,llegada FROM viajes where IDconductor=$IDusuario ");
    
    while ($cadaViaje = $viajes->fetch_array(MYSQLI_NUM)){                                                       
        $fechaDeViaje = new DateTime($cadaViaje[0] . $cadaViaje[1]);
        $fechaFinViaje = new DateTime($cadaViaje[2]);

        if(($horaViajeInicio > $fechaDeViaje)&&($horaViajeIinicio < $fechaFinViaje)){
            header("Location: verViaje.php?id=$idviaje&yaPoseeViaje=true");
            exit();
        }

        if(($horaViajeFin >= $fechaDeViaje) && ($horaViajeFin <= $fechaFinViaje)){
            header("Location: verViaje.php?id=$idviaje&yaPoseeViaje=true");
            exit();
        }
        if (($horaViajeIinicio <= $fechaDeViaje) && ($horaViajeFin >= $fechaFinViaje)) {
            header("Location: verViaje.php?id=$idviaje&yaPoseeViaje=true");
            exit();
        }
    }
    
    $viajesAcom = mysqli_query($link, "SELECT fecha,hora,llegada,estado FROM viajes,postulados_usuarios_viajes where viajes.IDviaje=postulados_usuarios_viajes.IDviaje AND IDusuario=$IDusuario");
    
    while ($cadaViajeA = $viajesAcom->fetch_array(MYSQLI_NUM)){
        if($cadaViajeA[3]>-1){
            $fechaDeViajeA = new DateTime($cadaViajeA[0] . $cadaViajeA[1]);
            $fechaFinViajeA = new DateTime($cadaViajeA[2]);

            if(($horaViajeInicio > $fechaDeViajeA)&&($horaViajeIinicio < $fechaFinViajeA)){
                header("Location: verViaje.php?id=$idviaje&yaPoseeViajeA=true");
                exit();
            }

            if(($horaViajeFin >= $fechaDeViajeA) && ($horaViajeFin <= $fechaFinViajeA)){
                header("Location: verViaje.php?id=$idviaje&yaPoseeViajeA=true");
                exit();
            }
            if (($horaViajeIinicio <= $fechaDeViajeA) && ($horaViajeFin >= $fechaFinViajeA)) {
                header("Location: verViaje.php?id=$idviaje&yaPoseeViajeA=true");
                exit();
            }
        }
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