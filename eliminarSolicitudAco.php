<?php
    session_start();
    include 'funciones.php';
    
    $link= conectarABase();
    
    $idviaje=$_GET['idV'];
    $iduser=$_GET['idU'];
   
    $id = $_SESSION['id'];
    
    mysqli_query($link,"UPDATE usuarios SET penalizacion_acom=penalizacion_acom+1 where ID=$id");
    
    if(mysqli_query($link, "UPDATE postulados_usuarios_viajes SET estado=-1 where IDviaje=$idviaje AND IDusuario=$iduser")){
            header("Location: MisViajes.php?exito=true");
    }else{
            header("Location: MisViajes.php?exito=false");
    }
  