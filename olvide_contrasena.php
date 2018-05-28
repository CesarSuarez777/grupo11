<!doctype html>
<?php 
    require('funciones.php');
    $errors = array();

    if(!empty($_POST)){
        $email=$_POST['email'];

        $link=conectarABase();

        if (usuarioExiste($email)){
            $token = mysqli_query($link, "SELECT token FROM usuarios where email='$email'");
            $row = mysqli_fetch_array($tokenes);
            $token = row[0];

            $url = 'http://localhost/grupo11/cambiar_contraseña.php?' . $token; 
            $asunto = 'Recuperar Password';
            $cuerpo ="Etimado usuario ingrese al siguiente url para cambiar la contraseña <a href='$url'>Ingrese aqui</a>";

        }else {
            errors[] = "No existe el correo electrónico"
        }
    }
?>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>inicio_sesion</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/estilosRegistro.css">
    </head>
    <body class="bg">
        <br>
            <h1><img src="Logo.jpg" alt="imagen no disponible" height="55"><font size="8" face="Univers-Light-Normal">   Aventon</font></h1>
                <br>
                <form action="olvide_contraseña.php" method="post" class="form-register">
                    <h2 class="form_titulo"><font size="6" face="Univers-Light-Normal">Recuperación de contraseña</font></h2>
                    <div class="contenedor-inputs">
                        <input type="email" name="correo" placeholder="Correo electrónico" required class="input-100">
                        <input type="submit" name="enviar" value="Enviar" class="boton_registro btn-block">
                        <div class="container">
                            <p class="form_link" align="center"><font size="3" face="Univers-Light-Normal"><a href="index.php"><<< Volver</a></font>
                            <br>
                    
                        </div>
                    </div>
            </form>
         <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
         <input type="submit" value="" />  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
         <script src="js/bootstrap.min.js"></script>
    </body>
</html>