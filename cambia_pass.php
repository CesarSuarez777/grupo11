<?php
	session_start();
        
        require 'funciones.php';
	
	if(empty($_GET['user_id'])){
		header('Location: index.php');
	}
	
	if(empty($_GET['token'])){
		header('Location: index.php');
	}
	
        $link = conectarABase();
        
	$id = $_GET['user_id'];
	$token = $_GET['token'];
	
        $resultado = mysqli_query($link, "SELECT * FROM usuarios where id='$id' ");
        $row = $resultado -> fetch_array(MYSQLI_ASSOC);
        
        $token2 = $row ['token'];
        
	if( $token != $token2)
	{
		echo 'No se pudo verificar los Datos';
		exit;
	} 
        
        ?>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Cambio Contraseña</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/estilosRegistro.css">
    </head>
    <body class="bg">
        <br>
            <h1><img src="Logo.jpg" alt="imagen no disponible" height="55"><font size="8" face="Univers-Light-Normal">   Aventon</font></h1>
                <br>
                <?php
                    if (isset($_POST['enviar'])){
                        $user_id = $_POST['id'];
                        $password = $_POST['nueva_contraseña'];
                        $password2 = $_POST['nueva_contraseña2'];;

                        if($password === $password2)
                        {
                            $link = conectarABase();
                            mysqli_query($link, "UPDATE usuarios SET clave='$password' where ID='$user_id'");
                            header('Location: inicio_sesion.php?cambio=true');
                            exit;
                        }
                        else {
                            ?>
                            <div class="container" align="center">
                                <font size="3" color="red">Las contraseñas no coinciden.</font>       
                            </div>
                            <br>
                        <?php
                        }
                    }
                ?>
                <form action="" method="post" name="olvide_clave" class="form-register">
                    <h2 class="form_titulo"><font size="6" face="Univers-Light-Normal">Recuperación de contraseña</font></h2>
                    <div class="contenedor-inputs">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="password" name="nueva_contraseña" placeholder="Nueva contraseña" required class="input-100">
                        <input type="password" name="nueva_contraseña2" placeholder="Confirmación nueva contraseña" required class="input-100">
                        <input type="submit" name="enviar" value="Enviar" class="boton_registro btn-block">
                    </div>
            </form>
         <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" crossorigin="anonymous"></script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"  crossorigin="anonymous"></script>
         <script src="js/bootstrap.min.js"></script>
         
    </body>
</html>