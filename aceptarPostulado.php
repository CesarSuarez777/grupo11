<?php
    session_start();
    include 'funciones.php';
    
    $link= conectarABase();
    
    $idviaje=$_GET['idV'];
    $iduser=$_GET['idU'];
    
    $viaje = mysqli_query($link,"SELECT IDDestino,asientos_disponibles,fecha,hora FROM viajes where idviaje=$idviaje");
    $viaje = $viaje->fetch_array(MYSQLI_NUM);
  
    if($viaje[1]>0){
        if((mysqli_query($link, "UPDATE viajes SET asientos_disponibles=asientos_disponibles-1 where IDviaje=$idviaje"))&&
        (mysqli_query($link, "UPDATE postulados_usuarios_viajes SET estado=1 where IDviaje=$idviaje AND IDusuario=$iduser"))){
            $nombreUser1 = mysqli_query($link,"SELECT nombre,apellido FROM usuarios where ID=$iduser");
            $nombreUser1 = $nombreUser1->fetch_array(MYSQLI_NUM);
            $c = mysqli_query($link, "SELECT nombre FROM ciudades WHERE IDCiudad=$viaje[0]");
            $ciudad1 = $c ->fetch_array(MYSQLI_NUM);
            
            $mail=$_SESSION['email'];
            
            $cuerpo = "Hola $nombreUser1[0] $nombreUser1[1], " . "\r\n \r\n" . "Usted fue aceptado para el viaje con destino $ciudad1[0] para la fecha $viaje[2] en el horario $viaje[3] \r\n Consultas a $mail";

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
    
