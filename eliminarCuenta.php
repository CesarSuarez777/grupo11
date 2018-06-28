<?php
    session_start();
    $id=$_SESSION['id'];
    require('funciones.php');
    $link= conectarABase();
    $sql= "DELETE FROM vehiculos WHERE IDuser='$id'";
    $query="DELETE FROM usuarios WHERE ID='$id'";
    
    $exito = mysqli_query($link, $query);
    $exito2 = mysqli_query($link, $sql);
    if ($exito && $exito2) {

        header("Location: index.php?eliminado#nav-vehiculo=$exito");
        unset ($SESSION['email']);
        unset ($SESSION['id']);
        session_destroy();
        exit();
    }
    else {
        header("Location: MiCuenta.php?eliminado=$exito");
    }
?>