<?php
    session_start();
    include 'funciones.php';
    
    $link= conectarABase();
    
    $idviaje=$_GET['idV'];
    $iduser=$_GET['idU'];
   
    $id = $_SESSION['id'];
    
    $postulado = mysqli_query($link,"SELECT estado FROM postulados_usuarios_viajes where IDviaje=$idviaje AND IDusuario=$iduser");
    $post = $postulado ->fetch_array(MYSQLI_NUM);
    if ($post==1){
        mysqli_query($link,"UPDATE usuarios SET penalizacion_acom=penalizacion_acom+1 where ID=$id");
        mysqli_query($link, "UPDATE viajes SET asientos_disponibles=asientos_disponibles+1 where IDviaje=$idviaje");
    }
    
    if(mysqli_query($link, "DELETE FROM postulados_usuarios_viajes where IDusuario=$iduser AND IDviaje=$idviaje")){
            header("Location: MisViajes.php?exito=true");
    }else{
            header("Location: MisViajes.php?exito=false");
    }
  