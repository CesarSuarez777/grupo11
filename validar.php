<?php
	session_start();
?>

<?php
        require 'funciones.php';
	$tbl_name = "usuarios";

	$conexion = conectarABase();
   
	$username = $_POST['correo'];
	$pass = $_POST['contraseña'];

	$sql = "SELECT * FROM $tbl_name WHERE email='$username' and clave='$pass' and borrado=0";

	$result = mysqli_query($conexion, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

	if ($result->num_rows > 0 ){
		$_SESSION['loggedin'] = true;
		$_SESSION['email'] = $username;
                $_SESSION['nombre'] = $row['nombre'];
                $_SESSION['id'] = $row['ID'];


		header("Location: PaginaPrincipal.php?inicio=$username");
	} else {
		$error=true;

		header("Location: inicio_sesion.php?error=$error"); 
	}
?>
