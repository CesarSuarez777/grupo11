<?php
	include 'funciones.php';

	$link = conectarABase();

	$viaje = mysqli_query($link,"SELECT IDviaje,fecha,hora,IDconductor,precio FROM viajes where realizado=false");

	$hoy = new DateTime('today');

	while($v = $viaje->fetch_array(MYSQLI_NUM)){
		$date = new DateTime("$v[1] . $v[2]");
		if($hoy>$date){
			$date = $date->format('Y-m-d H:i:s');
			$idviaje=$v[0];
			$postulados = mysqli_query($link,"SELECT IDusuario FROM postulados_usuarios_viajes where IDviaje=$idviaje AND estado=1");
			while($p = $postulados -> fetch_array(MYSQLI_NUM)){
				if(mysqli_query($link,"INSERT INTO calificaciones(IDorigen,IDdestino,fecha,IDviaje) VALUES($p[0],$v[3],'$date',$idviaje)")){
				}else{
				}
				if(mysqli_query($link,"INSERT INTO calificaciones(IDorigen,IDdestino,fecha,aConductor,IDviaje) VALUES($v[3],$p[0],'$date',0,$idviaje)")){;
				}else{
				}
				$tarjeta = mysqli_query($link,"SELECT fecha_vencimiento from tarjetas where IDtarjeta=$p[0]");
				$tarjetas = $tarjeta ->fetch_array(MYSQLI_NUM);
				$vencimiento = new DateTime($tarjetas[0]);
				if($vencimiento>$hoy){
					mysqli_query($link,"INSERT INTO pagos(IDusuario_origen,IDusuario_destino,monto,fecha) VALUES ($p[0],$v[3],$v[4],'$date')");	
				}else{
					mysqli_query($link,"INSERT INTO pagos(IDusuario_origen,IDusuario_destino,monto,fecha,deuda) VALUES ($p[0],$v[3],$v[4],'$date',1)");
					mysqli_query($link,"UPDATE usuarios SET deuda=deuda+$v[4] where ID=$p[0]");	
				}
			}
			mysqli_query($link,"UPDATE viajes SET realizado=true where IDviaje=$idviaje");
		}
	}
	
