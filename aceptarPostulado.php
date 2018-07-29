<?php
    session_start();
    include 'funciones.php';
    
    $link= conectarABase();
    
    $idviaje=$_GET['idV'];
    $iduser=$_GET['idU'];
    
    $viaje = mysqli_query($link,"SELECT IDDestino,asientos_disponibles FROM viajes where idviaje=$idviaje");
    $viaje = $viaje->fetch_array(MYSQLI_NUM);
  
    if($viaje[1]>0){
        if((mysqli_query($link, "UPDATE viajes SET asientos_disponibles=asientos_disponibles-1 where IDviaje=$idviaje"))&&
        (mysqli_query($link, "UPDATE postulados_usuarios_viajes SET estado=1 where IDviaje=$idviaje AND IDusuario=$iduser"))){
            $nombreUser1 = mysqli_query($link,"SELECT nombre,apellido FROM usuarios where ID=$iduser");
            $nombreUser1 = $nombreUser1->fetch_array(MYSQLI_NUM);
            $viaje1 = mysqli_query($link, "SELECT fecha,hora,IDDestino FROM viajes where IDviaje=$viaje[0]");
            $viaje1 = $viaje1->fetch_array(MYSQLI_NUM);
            $ciudad1 = mysqli_query($link, "SELECT nombre FROM ciudades where IDCiudad=$viaje1[2]");
            $ciudad1 = $ciudad1 ->fetch_array(MYSQLI_NUM);
            
            $mail=$_SESSION['email'];
            
            $cuerpo = "Hola $nombreUser1[0] $nombreUser1[1], " . "\r\n \r\n" . "Usted fue aceptado para el viaje con destino $ciudad1[0] para la fecha $viaje1[0] en el horario $viaje1[1] \r\n Consultas a $mail";

            $file = fopen('Archivos_texto/aceptado' . $iduser . $idviaje . '.txt', "w");
            fwrite($file, $asunto . "\r\n \r\n" . $cuerpo);
            header("Location: verSolicitudes.php?id=$idviaje&exito=true");
            
        }else{
            header("Location: verSolicitudes.php?id=$idviaje&exito=false");
        }
    }
    else{
        header("Location: verSolicitudes.php?id=$idviaje&noAsientos=true");
    }
    
