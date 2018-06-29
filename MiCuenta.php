
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
         
  </head>
  <body>
            <?php
            require ('funciones.php');

  	    session_start();
            
            if (!inicioSesion()){
                header('Location: index.php');
            }

            $link=conectarABase();
            
            
            $email=$_SESSION['email'];
  
            $resultado = mysqli_query($link, "SELECT * FROM usuarios where email='$email'");
            $row = $resultado->fetch_array(MYSQLI_ASSOC);
            
            $IDusuario= $row['ID'];
            
            $tarjeta = mysqli_query($link, "SELECT * FROM tarjetas where IDtarjeta='$IDusuario'");
            
            $vehiculos = mysqli_query($link, "SELECT * FROM vehiculos where IDuser='$IDusuario'");
            
            $puntos=0;
            
            $calificaciones = mysqli_query($link, "SELECT calificacion FROM calificaciones where IDdestino=$IDusuario");
            while($cal = $calificaciones->fetch_array(MYSQLI_NUM)){
                $puntos=$puntos+$cal[0];
            }
            $puntos = $puntos - $row['penalizacion'];

           
  	?>
        <header>
            <nav>
		 <ul>
                    <div class="row" position="fixed">
                        <div class="col-2">
                                <a href="PaginaPrincipal.php">
                                <img href="PaginaPrincipal.php" src="Logo.jpg" alt="Imagen no disponible"  class="rounded mx-auto d-block" height="120x120">
                                </a>
                        </div>
                        <div class="col-8">
                            <div class="row" position="fixed">
                                <div class="col-10">
                                    <br>
                                    <div class="input-group input-group-prepend mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><font size="3" face="Univers-Light-Normal">Origen</font></span>
                                        </div>
                                      <input type="text" face="Univers-Light-Normal" class="form-control" placeholder="La Plata" aria-label="La Plata" aria-describedby="basic-addon1">
                                    </div>
                                    <div class="input-group input-group-prepend mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><font size="3" face="Univers-Light-Normal">Destino</font></span>
                                        </div>
                                    <input type="text" class="form-control" face="Univers-Light-Normal" placeholder="Berisso" aria-label="Berisso" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <br>
                                    <button class="btn btn-outline-danger btn-lg btn-block btn-lg"><font size="5" face="Univers-Light-Normal">Ir</font></button><br>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <br>
                            <a href="MiCuenta.php" class="btn btn-outline-danger btn-block"><img src="Imagenes/Usuario.png" height="15x15"><font size="3" face="Univers-Light-Normal">     <?php echo $_SESSION['nombre']; ?></font></a><br>
                            <a href="MisViajes.php" class="btn btn-outline-danger btn-block"><img src="Imagenes/MisViajes.png" height="17x17"><font size="3" face="Univers-Light-Normal">     Mis viajes</font></a>
                        </div>     
                    </div>
                 </ul>
            </nav>        
        </header>
		<div class="row" position="fixed">
			<div class="col-2">
			</div>
			<div class="col-10">
				<nav>
				  <div class="nav nav-tabs" id="nav-tab" role="tablist">
				    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true"><font color="#f87678">Mis datos personales</font></a>
				    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-vehiculo" role="tab" aria-controls="nav-profile" aria-selected="false"><font color="#f87678">Mis vehiculos</font></a>
				    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-tarjeta" role="tab" aria-controls="nav-contact" aria-selected="false"><font color="#f87678">Mi tarjeta</font></a>
				  </div>
				</nav>
				<div class="tab-content" id="nav-tabContent">
				<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                     <div class="container-fluid">
                                     <?php if (!empty($_GET['nuevaClave'])) {
                                         ?><br><h5 align="center" style="color: green">¡Contraseña modificada con éxito!</h5><?php
                                      } if (!empty($_GET['tarjeta'])) {
                                         ?><br><h5 align="center" style="color: green">¡Tarjeta agregada con éxito!</h5><?php
                                      } if (!empty($_GET['teliminada'])){
                                         ?><br><h5 align="center" style="color: green">¡Tarjeta eliminada con éxito!</h5><?php
                                      }
                                        
                                      ?>
                                      <div class="jumbotron">
                                        <div class="row">
                                            <div class="col-md-4 col-xs-12 col-sm-4 col-lg-3">
                                                <img src="Imagenes/profile.png" height="250">
                                            </div>
                                            <div class="col-md-8 col-xs-12 col-sm-8 col-lg-9">
                                                <div class="container" style="border-bottom:1px solid black">
                                                  <h2><?php echo $row['nombre'] . " " . $row['apellido'] ;?></h2>
                                                </div>
                                                  <hr>
                                                <ul class="container details">
                                                  <p><img height="18" src="Imagenes/email.png"><?php echo " " . $row['email']; ?></p>
                                                  <p><img height="18" src="Imagenes/Edad.png"><?php echo " " . calcularEdad($row['fecha']) . " años"; ?></p>
                                                  <p><img height="20" src="Imagenes/calificacion.png"> Calificación piloto: <?php echo $puntos ?></p>
                                                </ul>
                                                  <div class="container" align="right">
                                                      <a href="modificarPerfil.php">Modificar perfil</a><span> | </span>
                                                      <a href='modificarContrasena.php'>Modificar contraseña</a><br>
                                                      <a href="eliminarCuenta.php" onclick="return confirm('¿Estás seguro?');">Eliminar cuenta</a><span > | </span>
                                                      <a href="logout.php">Cerrar Sesion </a>
                                                  </div>
                                            </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="tab-pane fade" id="nav-vehiculo" role="tabpanel" aria-labelledby="nav-contact-tab">
                                            <br>
                                             <?php if (!empty($_GET['veliminado'])) {
                                                 ?><h5 align="center" style="color: green">¡Vehículo eliminado con éxito!</h5><?php
                                             } 
                                             if (!empty($_GET['vocupado'])) {
                                                 ?><h5 align="center" style="color: red">Eliminación no completada. El vehiculo tiene un viaje pendiente</h5><?php
                                             } 
                                             if($vehiculos->num_rows > 0 ){ ?>
                                             <table class="table table-sm table-borderless">
                                                 <thead class='thead-light'>
                                                 <tr style='border-bottom: 2px solid #f17376'>
                                                   <th scope="col"><font size='5'>Marca</font></th>
                                                   <th scope="col"><font size='5'>Modelo</font></th>
                                                   <th scope="col"><font size='5'>Patente</font></th>
                                                   <th scope="col"><font size='5'>Asientos</font></th>
                                                   <th scope='col'></th>
                                                 </tr>
                                               </thead>
                                               <tbody>
                                                 <?php while($fila = $vehiculos->fetch_array(MYSQL_NUM)) {
                                                     $id = $fila[4];
                                                 ?>
                                                 <tr style='margin-top: 30px'>
                                                   <td><font face='georgia'><?php echo $fila[0]; ?></font></td>
                                                   <td><font face='georgia'><?php echo $fila[1]; ?></font></td>
                                                   <td><font face='georgia'><?php echo $fila[2]; ?></font></td>
                                                   <td><font face='georgia'><?php echo $fila[3]; ?></font></td>
                                                   <td><a href='<?php echo "editarVehiculo.php?id=$id"; ?>'>Editar</a><span> | </span>
                                                   <a onclick="return confirm('¿Estás seguro?');" href='<?php echo "eliminarVehiculo.php?id=$id"; ?>'>Eliminar</a></td>   
                                                 </tr>
                                                 <?php

                                                 }?>
                                               </tbody>
                                             </table>
                                             <?php }else{
                                                 ?> <h2 align='center'>Usted no posee vehiculos registrados.</h2>
                                             <?php
                                             }
                                             ?>
                                          <br>
                                          <a style="margin-left: 470px" class="btn btn-outline-danger btn-lg" href="agregarVehiculo.php" role="button">Agregar nuevo vehículo</a>
                                  </div>   
				                          <div class="tab-pane fade" id="nav-tarjeta" role="tabpanel" aria-labelledby="nav-profile-tab"> 
                                      <br>
                                      <?php if($tarjeta ->num_rows > 0 ){ ?>
                                      <table class="table table-sm table-borderless">
                                          <thead class='thead-light'>
                                          <tr style='border-bottom: 2px solid #f17376'>
                                            <th scope="col"><font size='5'>Numero</font></th>
                                            <th scope="col"><font size='5'>Marca</font></th>
                                            <th scope="col"><font size='5'>Fecha de vencimiento</font></th>
                                            <th scope="col"><font size='5'>Titular</font></th>
                                            <th scope="col"><font size='5'>Codigo seguridad</font></th>
                                            <th scope='col'></th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <?php while($fila = $tarjeta->fetch_array(MYSQL_NUM)) {
                                              $idt = $fila[5];
                                          ?>
                                          <tr style='margin-top: 30px'>
                                            <td><font face='georgia'><?php echo $fila[0]; ?></font></td>
                                            <td><font face='georgia'><?php echo $fila[1]; ?></font></td>
                                            <td><font face='georgia'><?php echo $fila[2]; ?></font></td>
                                            <td><font face='georgia'><?php echo $fila[3]; ?></font></td>
                                            <td><font face='georgia'><?php echo $fila[4]; ?></font></td>
                                            <td><a href='<?php echo "editarTarjeta.php?id=$idt"; ?>'>Editar</a><span> | </span>
                                                <a onclick="return confirm('¿Estás seguro?');" href='<?php echo "eliminarTarjeta.php?id=$idt"; ?>'>Eliminar</a></td>   
                                          </tr>
                                          <?php
                                          
                                          }?>
                                        </tbody>
                                      </table>
                                      <?php }else{
                                          ?> <h2 align='center'>Usted no posee tarjeta registrada.</h2>
                                          <br>
                                          <a style="margin-left: 470px" class="btn btn-outline-danger btn-lg" href="agregarTarjeta.php" role="button">Agregar nueva tarjeta</a>
                                      <?php
                                      }
                                      ?>
                                    </div>
                                </div>
                                  </div>
                            </div>
			<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        	<input type="submit" value="" />  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        	<script src="js/bootstrap.min.js"></script>
    	</body>
    </html>



