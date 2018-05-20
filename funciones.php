<?php
	function conectarABase() {
    	$link = mysqli_connect("localhost","root","","aventon");
    	return $link;
	}

	function calcularEdad($miCumpleanos){
		$cumpleanos = new DateTime($miCumpleanos);
    	$hoy = new DateTime();
   	 	$annos = $hoy->diff($cumpleanos);
    	echo $annos->y;

	}
?>


