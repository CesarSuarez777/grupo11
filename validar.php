<?php
	session_start();
?>

<?php

	$tbl_name = "usuarios";

	$conexion = mysqli_connect("localhost","root","","aventon");
   
	$username = $_POST['correo'];
	$pass = $_POST['contraseña'];

	$sql = "SELECT * FROM $tbl_name WHERE email='$username' and clave='$pass'";

	$result = mysqli_query($conexion, $sql);


	if ($result->num_rows > 0 ){
		$_SESSION['loggedin'] = true;
		$_SESSION['email'] = $username;
		$_SESSION['start'] = time();
		$_SESSION['expire'] = $_SESSION['start'] + (5*60);


		header("Location: PaginaPrincipal.php?inicio=$username");
	} else {
		$error=true;

		header("Location: inicio_sesion.php?error=$error"); 
	}
?>
