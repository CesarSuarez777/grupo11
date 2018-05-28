<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Registro</title>
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/estilosRegistro.css">
    </head>
    <body>
        <?php
                    if (isset($_POST['registro'])) {
                        require("registrar.php");
                        if (!$error4){
                            header("Location: inicio_sesion.php?error=$error4");
                        }
                    }
                ?>
            <font size="4"  color="red" face="Univers-Light-Normal"><?php if(isset($_POST['registro'])){if ($error4) {echo "Error al registrar, intente nuevamente";}} ?></font>   
            <div class="row">
            <div class="col-6">
                <h1></h1>
                <center><img  src="Video.jpg" class="imagen_centrada" height="300" alt="Imagen no disponible"></center>
            </div>
            <div class="col-6">
                <br>
                <h1><img src="Logo.jpg" alt="imagen no disponible" height="55"><font size="8" face="Univers-Light-Normal">   Aventon</font></h1>
                <br>
                <form id="signupform" action="" method="POST" class="form-register">
                    <h2 class="form_titulo"><font size="6" face="Univers-Light-Normal">Crear una cuenta</font></h2>
                    <div class="contenedor-inputs">
                        <input type="text" name="nombre" value="<?php if (isset($_POST['registro'])) {echo $nombre;} ?>" placeholder="Nombre" class="input-50" required  >
                        <input type="text" name="apellidos" value="<?php if (isset($_POST['registro'])) {echo $apellido;} ?>" placeholder="Apellidos" class="input-50" required>
                        <font size="2"  color="red" face="Univers-Light-Normal"><?php if(isset($_POST['registro'])){if ($error2) {echo "El correo ya se encuentra registrado";}} ?></font>
                        <input type="email" name="correo" value="<?php if (isset($_POST['registro'])) {if (!$error2) {echo $email;}} ?>" placeholder="Correo electrónico" required class="input-100">
                        <font size="2"  class="input-100" color="red"face="Univers-Light-Normal"><?php if(isset($_POST['registro'])){if ($error1) {echo "Las contraseñas no coinciden";}} ?></font>
                        <input type="password" name="clave" placeholder="Contraseña" required class="input-50">
                        <input type="password" name="clave_confirmacion" placeholder="Confirmar contraseña" required class="input-50">
                        <font size="2" color="red" face="Univers-Light-Normal"><?php if(isset($_POST['registro'])){ if ($error3) {echo "No posee la edad suficiente para utilizar aventon";}} ?></font>
                        <input type="date" class="input-100" name="nacimiento" value="<?php if (isset($_POST['registro'])) {if (!$error3) {echo $fecha_nacimiento;}} ?>" placeholder="Fecha de nacimiento" required>
                        <div class="container" align="center">
                            <div class="row">
                                <div class="col-3">
                                    <span>Foto de perfil</span>
                                </div>
                                <div class="col-9">
                                     <input type="file" class="input-100" name="foto" placeholder="Foto de perfil">
                                </div>
                            </div>
                        </div>
                        <input type="submit" name="registro" value="Registrar" font-color="#f17376" class="boton_registro btn-block">
                        <div class="container" align="center">
                            <p 
                            class="form_link"><font face="Univers-Light-Normal">¿Ya posee una cuenta registrada? <a href="inicio_sesion.php">Ingresa aqui</a></font></p>
                        </div>
                    </div>
                </form>
                
           </div>
        </div>
         <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
         <input type="submit" value="" />  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
         <script src="js/bootstrap.min.js"></script>
    </body>
</html>  
