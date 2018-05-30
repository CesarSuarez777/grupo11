
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
                <?php
                     require 'funciones.php';
          
          
                     if(isset($_POST['enviar'])){
                        $email = $_POST['correo'];

                        if(!usuarioExiste($email))
                        {
                        ?> 
                        <div class="container" align="center">
                            <font size="3" color="red">Debe ingresar un correo electrónico registrado</font>
                        </div>
                        <br>
                        <?php
                        } else {
                                ?>
                                <div class="container" align="center">
                                <font size="3" color="green" align="center">¡Hemos enviado un correo con los datos necesarios <br> para el cambio de contraseña a <?php echo $email ?>!</font>
                                </div><br>
                                <?php 

                                $link = conectarABase();

                                $resultado = mysqli_query($link, "SELECT * FROM usuarios WHERE email='$email'");
                                $row = $resultado->fetch_array(MYSQLI_ASSOC);

                                $token = $row['token'];
                                $id = $row['ID'];
                                $url = 'http://localhost/grupo11/cambia_pass.php?user_id='. $id .'&token='. $token;

                                $nombre = $row['nombre'];

                                $asunto = 'Recuperar Password - Sistema de Usuarios';
                                $cuerpo = "Hola, " . $nombre . "\r\n \r\n" . "Se ha solicitado un reinicio de contraseña. \r\n \r\nPara restaurar la contraseña, visita la siguiente dirección: $url";

                                $file = fopen('Archivos_texto/' . $id . '.txt', "w");
                                fwrite($file, $asunto . "\r\n \r\n" . $cuerpo);
                        }
                     }
                ?>
                
                <form action="" method="post" class="form-register">
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