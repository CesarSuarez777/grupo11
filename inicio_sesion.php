<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Iniciar sesión</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/estilosRegistro.css">
    </head>
    <body class="bg">
        <br>
            <?php
                session_start();
                if (!empty($_GET['error'])){
                    $error = $_GET['error'];
                }
                
                require 'funciones.php';
                
                if (inicioSesion()){
                    header("Location: PaginaPrincipal.php");
                    exit;
                }
            ?>
                        
            <h1><img src="Logo.jpg" alt="imagen no disponible" height="55"><font size="8" face="Univers-Light-Normal">   Aventon</font></h1>
                <br>
                <div class="container" align="center">
                    <font size="3" color="green"> 
                        <?php if(!empty($_GET['cambio'])){echo "¡Cambio de contraseña realizado con exito!";} ?> 
                    </font>
                </div>
                <div class="container" align="center"><font size="4" color="green" face="Univers-Light-Normal"> 
                    <?php if(!empty($_GET['exito'])){ echo "¡Usted se ha registrado exitosamente!"; } ?> 
                    </font>
                    <font size='4' color='red' face='Univers-Light-Normal'><?php if (!empty($_GET['error'])) {echo "Usuario o contraseña incorrectos";} ?>
                </font></div>
                <form action="validar.php" method="post" class="form-register">
                    <h2 class="form_titulo"><font size="6" face="Univers-Light-Normal">Iniciar sesión</font></h2>
                    <div class="contenedor-inputs">
                        <input type="email" name="correo" placeholder="Correo electrónico" required class="input-100">
                        <input type="password" name="contraseña" placeholder="Contraseña" required class="input-100">
                        <input type="submit" name="inicioSesion" value="Iniciar sesion" class="boton_registro btn-block">
                        <div class="container">
                            <p class="form_link" align="center"><font size="3" face="Univers-Light-Normal">¿No posee una cuenta registrada? <a href="index.php">Ingresa aqui</a></font>
                            <br>
                            <font size="3" face="Univers-Light-Normal">¿Ha olvidado su contraseña? <a href="olvide_contrasena.php">Ingresa aqui</a></font>
                            </p>
                        </div>
                    </div>
            </form>
         <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
         <input type="submit" value="" />  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
         <script src="js/bootstrap.min.js"></script>
    </body>
</html>