<?php
    require('funciones.php');
    $link = conectarABase();
    $id=$_GET['id'];
    
    session_start();
    $iduser = $_SESSION['id'];
    
    $hoy = new DateTime('today');
    $viajesPendientes = mysqli_query($link,"SELECT fecha,hora FROM viajes where IDConductor=$iduser");
    while($fila= $viajesPendientes->fetch_array(MYSQLI_NUM)){
          $fechaViaje = new DateTime($fila[0] . $fila[1]);
          if($hoy<$fechaViaje){
              header('Location: MiCuenta.php?viajespe=true');
              exit();
          }
    }

    $viajesPendientesA = mysqli_query($link,"SELECT fecha,hora FROM postulados_usuarios_viajes,viajes where postulados_usuarios_viajes.IDviaje=viajes.IDviaje AND IDusuario=$iduser AND estado<>-1");
        while($fila= $viajesPendientesA->fetch_array(MYSQLI_NUM)){
          $fechaViaje = new DateTime($fila[0] . $fila[1]);
          if($hoy<$fechaViaje){
              header('Location: MiCuenta.php?viajespe=true');
              exit();
          }
    }
            
    $sql = "DELETE FROM tarjetas WHERE IDtarjeta='$id'";
    mysqli_query($link, $sql);
    mysqli_close($link);
    header('Location: MiCuenta.php?teliminada=true');


