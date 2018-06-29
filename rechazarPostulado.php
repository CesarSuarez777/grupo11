<?php
    session_start();
    include 'funciones.php';
    
    $link= conectarABase();
    
    $idviaje=$_GET['idV'];
    $iduser=$_GET['idU'];
    
  
    if((mysqli_query($link, "UPDATE postulados_usuarios_viajes SET estado=-1 where IDviaje=$idviaje AND IDusuario=$iduser"))){
            header("Location: verSolicitudes.php?id=$idviaje&exito=true");
        }else{
            header("Location: verSolicitudes.php?id=$idviaje&exito=false");
     }

    