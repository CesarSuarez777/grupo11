<?php
	function conectarABase() {
            $link = mysqli_connect("localhost","root","","aventon");
            return $link;
	}

	function calcularEdad($miCumpleanos){
		$cumpleanos = new DateTime($miCumpleanos);
                $hoy = new DateTime();
   	 	$annos = $hoy->diff($cumpleanos);
                return $annos->y;
	}
        
        function inicioSesion(){
            if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
                return true;
            } else{
                return false;
            }
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
                mysql_close($link);
 	}
        
        function acreditarPasajero($IDorigen,$IDdestino,$IDviaje){
            $link = conectarABase();
            $usuario = mysqli_query($link,"SELECT * FROM usuarios WHERE ID='$IDorigen'");
            $usuario = mysqli_query($link,"SELECT * FROM usuarios WHERE ID='$IDorigen'");
        }
	
?>


