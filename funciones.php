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

	function usuarioExiste($email){
		$link = conectarABase();
		$buscarUsuario = mysqli_query($link,"SELECT COUNT(email) FROM usuarios WHERE email='$email'");
        $row = mysqli_fetch_array($buscarUsuario);
        if ($row[0]>0){
        	return true;
      	} else {
      		return false;
      	}
 	}
	
?>


