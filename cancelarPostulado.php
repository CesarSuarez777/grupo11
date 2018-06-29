<?php
    session_start();
    include 'funciones.php';
    
    $link= conectarABase();
    
    $idviaje=$_GET['idV'];
    $iduser=$_GET['idU'];
   
    $id = $_SESSION['id'];
    
    mysqli_query($link,"UPDATE usuarios SET penalizacion=penalizacion+1 where ID=$id");
    
    mysqli_query($link, "UPDATE viajes SET asientos_disponibles=asientos_disponibles+1 where IDviaje=$idviaje");
    
    if(mysqli_query($link, "UPDATE postulados_usuarios_viajes SET estado=-1 where IDviaje=$idviaje AND IDusuario=$iduser")){
            header("Location: verSolicitudes.php?id=$idviaje&exito=true");
    }else{
            header("Location: verSolicitudes.php?id=$idviaje&exito=false");
    }
  

