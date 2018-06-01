<?php
    require('funciones.php');
    $link = conectarABase();
    $id=$_GET['id'];
    $sql = "DELETE FROM tarjetas WHERE IDtarjeta='$id'";
    mysqli_query($link, $sql);
    mysqli_close($link);
    header('Location: MiCuenta.php?teliminada=true');


