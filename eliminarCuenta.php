<?php
    session_start();
    $id=$_SESSION['id'];
    require('funciones.php');
    $link= conectarABase();
    
    mysqli_query($link,"UPDATE usuarios SET email='---',borrado=1 where ID=$id");
    mysqli_query($link,"DELETE FROM calificaciones where calificacion=0 AND (IDorigen=$id OR IDdestino=$id)");
    $viajesPendientes = mysqli_query($link,"SELECT IDviaje FROM viajes where realizado=false and IDconductor=$id");
    while ($vp = $viajesPendientes->fetch_array(MYSQLI_NUM)){
        $lista = mysqli_query($link,"SELECT * FROM postulados_usuarios_viajes where IDviaje=$vp[0]");
        $asunto = 'Viaje eliminado';
    
        while($fila = $lista->fetch_array(MYSQLI_NUM)){
                
            $nombreUser = mysqli_query($link,"SELECT nombre,apellido FROM usuarios where ID=$fila[0]");
            $nombreUser = $nombreUser ->fetch_array(MYSQLI_NUM);
            $viaje = mysqli_query($link, "SELECT fecha,hora,IDDestino FROM viajes where IDviaje=$fila[1]");
            $viaje = $viaje->fetch_array(MYSQLI_NUM);
            $ciudad = mysqli_query($link, "SELECT nombre FROM ciudades where IDciudad=$viaje[2]");
            $ciudad = $ciudad ->fetch_array(MYSQLI_NUM);
            
            $cuerpo = "Hola $nombreUser[0] $nombreUser[1], " . "\r\n \r\n" . "El viaje con destino $ciudad[0] para la fecha $viaje[0] en el horario $viaje[1] ha sido eliminado";

            $file = fopen('Archivos_texto/' . $fila[0] . $fila[1] . '.txt', "w");
            fwrite($file, $asunto . "\r\n \r\n" . $cuerpo);                    
                 
        }  
         mysqli_query($link, "DELETE FROM postulados_usuarios_viajes where IDviaje=$vp[0]");
         $sql = "DELETE FROM viajes WHERE IDviaje='$vp[0]'";
         mysqli_query($link, $sql);
    }

    $viajesPostulado = mysqli_query($link,"SELECT IDusuario_viaje,viajes.IDviaje FROM postulados_usuarios_viajes,viajes where postulados_usuarios_viajes.IDviaje=viajes.IDviaje AND IDusuario=$id AND realizado=false");
    while($vipo = $viajesPostulado = mysqli_query -> fetch_array(MYSQLI_NUM)){
        $postulado = mysqli_query($link,"SELECT estado FROM postulados_usuarios_viajes where IDusuario_viaje=$vipo[0]");
        $post = $postulado ->fetch_array(MYSQLI_NUM);
        if ($post==1){
            mysqli_query($link, "UPDATE viajes SET asientos_disponibles=asientos_disponibles+1 where IDviaje=$vipo[1]");
        }
        mysqli_query($link, "DELETE FROM postulados_usuarios_viajes where IDusuario=$id AND IDviaje=$vipo[1]");
    }
 

    
