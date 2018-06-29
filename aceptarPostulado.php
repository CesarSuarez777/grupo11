<?php
    session_start();
    include 'funciones.php';
    
    $link= conectarABase();
    
    $idviaje=$_GET['idV'];
    $iduser=$_GET['idU'];
    
    $viaje = mysqli_query($link,"SELECT asientos_disponibles FROM viajes where idviaje=$idviaje");
    $viaje = $viaje->fetch_array(MYSQLI_NUM);
  
    if($viaje[0]>0){
        if((mysqli_query($link, "UPDATE viajes SET asientos_disponibles=asientos_disponibles-1 where IDviaje=$idviaje"))&&
        (mysqli_query($link, "UPDATE postulados_usuarios_viajes SET estado=1 where IDviaje=$idviaje AND IDusuario=$iduser"))){
            header("Location: verSolicitudes.php?id=$idviaje&exito=true");
        }else{
            header("Location: verSolicitudes.php?id=$idviaje&exito=false");
        }
    }
    else{
        header("Location: verSolicitudes.php?id=$idviaje&noAsientos=true");
    }
    
