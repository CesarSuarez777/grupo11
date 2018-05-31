<?php
    session_start();
    $email=$_SESSION['email'];
    require('funciones.php');
    $link= conectarABase();
    $query="DELETE FROM usuarios WHERE email='$email'";
    $exito = mysqli_query($link, $query);
    if ($exito) {

        header("Location: index.php?eliminado=$exito");
        unset ($SESSION['email']);
        session_destroy();
        exit();
    }
    else {
        header("Location: MiCuenta.php?eliminado=$exito");
    }
?>