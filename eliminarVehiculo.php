<?php
    require('funciones.php');
    $link = conectarABase();
    $id=$_GET['id'];
    $sql = "DELETE FROM vehiculos WHERE IDvehiculo='$id'";
    mysqli_query($link, $sql);
    mysqli_close($link);
    header('Location: MiCuenta.php?veliminado=true');

