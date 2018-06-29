<?php
    session_start();
    require('funciones.php');
    $link = conectarABase();
    
    $iduser=$_SESSION['id'];
    $id=$_GET['id'];
      
    $lista = mysqli_query($link,"SELECT * FROM postulados_usuarios_viajes where IDviaje=$id");
    
    $penalizado=false;
    $asunto = 'Viaje eliminado';
    
    while($fila = $lista->fetch_array(MYSQLI_NUM)){
        if($fila[2]==1){
            $penalizado=true;
            
            $nombreUser = mysqli_query($link,"SELECT nombre,apellido FROM usuarios where ID=$fila[0]");
            $nombreUser = $nombreUser ->fetch_array(MYSQLI_NUM);
            $viaje = mysqli_query($link, "SELECT fecha,hora,IDDestino FROM viajes where IDviaje=$fila[1]");
            $viaje = $viaje->fetch_array(MYSQLI_NUM);
            $ciudad = mysqli_query($link, "SELECT nombre FROM ciudades where IDciudad=$viaje[2]");
            $ciudad = $ciudad ->fetch_array(MYSQLI_NUM);
            
            $cuerpo = "Hola $nombreUser[0] $nombreUser[1], " . "\r\n \r\n" . "El viaje con destino $ciudad[0] para la fecha $viaje[0] en el horario $viaje[1] al que usted habia sido aceptado ha sido eliminado";

            $file = fopen('Archivos_texto/' . $fila[0] . $fila[1] . '.txt', "w");
            fwrite($file, $asunto . "\r\n \r\n" . $cuerpo);
        }
        
        if($fila[2]==0){
            $nombreUser1 = mysqli_query($link,"SELECT nombre,apellido FROM usuarios where ID=$fila[0]");
            $nombreUser1 = $nombreUser1->fetch_array(MYSQLI_NUM);
            $viaje1 = mysqli_query($link, "SELECT fecha,hora,IDDestino FROM viajes where IDviaje=$fila[1]");
            $viaje1 = $viaje1->fetch_array(MYSQLI_NUM);
            $ciudad1 = mysqli_query($link, "SELECT nombre FROM ciudades where IDCiudad=$viaje1[2]");
            $ciudad1 = $ciudad1 ->fetch_array(MYSQLI_NUM);
            
            $cuerpo = "Hola $nombreUser1[0] $nombreUser1[1], " . "\r\n \r\n" . "Usted fue rechazado para el viaje con destino $ciudad1[0] para la fecha $viaje1[0] en el horario $viaje1[1]";

            $file = fopen('Archivos_texto/' . $fila[0] . $fila[1] . '.txt', "w");
            fwrite($file, $asunto . "\r\n \r\n" . $cuerpo);
        }
    }
    
    mysqli_query($link, "DELETE FROM postulados_usuarios_viajes where IDviaje=$id");
    
    if ($penalizado){
        $penalizar = mysqli_query($link, "UPDATE usuarios SET penalizacion=penalizacion+1 where ID=$iduser");
    }

    $sql = "DELETE FROM viajes WHERE IDviaje='$id'";
    mysqli_query($link, $sql);
    mysqli_close($link);
    header('Location: MisViajes.php?veliminado=true');

