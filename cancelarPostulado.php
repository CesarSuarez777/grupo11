<?php
    session_start();
    include 'funciones.php';
    
    $link= conectarABase();
    
    $idviaje=$_GET['idV'];
    $iduser=$_GET['idU'];
   
    $id = $_SESSION['id'];
    
    $postulado = mysqli_query($link,"SELECT estado FROM postulados_usuarios_viajes where IDviaje=$idviaje AND $IDusuario=$iduser");
    $post = $postulado ->fetch_array(MYSQLI_NUM);
    if ($post==1){
        mysqli_query($link,"UPDATE usuarios SET penalizacion=penalizacion+1 where ID=$id");
        mysqli_query($link, "UPDATE viajes SET asientos_disponibles=asientos_disponibles+1 where IDviaje=$idviaje");
    }
    
    if(mysqli_query($link, "UPDATE postulados_usuarios_viajes SET estado=-1 where IDviaje=$idviaje AND IDusuario=$iduser")){
            header("Location: verSolicitudes.php?id=$idviaje&exito=true");
    }else{
            header("Location: verSolicitudes.php?id=$idviaje&exito=false");
    }
  

