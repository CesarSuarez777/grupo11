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
  	    session_start();
            
            require 'funciones.php';
            
            if (!inicioSesion()){
                header('Location: index.php');
            }

            $link=conectarABase();

            $email=$_SESSION['email'];
            $iduser = $_SESSION['id'];
            
            $idviaje = $_GET['id'];
            $resultado = mysqli_query($link, "SELECT * FROM viajes where IDviaje='$idviaje'");
            $row = $resultado->fetch_array(MYSQLI_NUM);
            $origen = mysqli_query($link, "SELECT nombre FROM ciudades where IDCiudad=$row[6]");
            $origen = $origen ->fetch_array(MYSQLI_NUM);
            $destino = mysqli_query($link, "SELECT nombre FROM ciudades where IDCiudad=$row[7]");
            $destino = $destino ->fetch_array(MYSQLI_NUM);
            
            $nombreUser = mysqli_query($link,"SELECT nombre,apellido FROM usuarios where ID=$row[4]");
            $nombreUser = $nombreUser ->fetch_array(MYSQLI_NUM);
            
            $vehiculos = mysqli_query($link, "SELECT marca,modelo FROM vehiculos where IDvehiculo='$row[3]'");
            $vehiculos = $vehiculos -> fetch_array(MYSQLI_NUM);
            
            

  	?>
        <header>
            <nav>
		 <ul>
                    <div class="row" position="fixed">
                        <div class="col-2">
                            <p>
                                <a href="PaginaPrincipal.php">
                                <img href="PaginaPrincipal.php" src="Logo.jpg" alt="Imagen no disponible"  class="rounded mx-auto d-block" height="120x120">
                                </a>
                            </p>
                            
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
                            <a href="MiCuenta.php" class="btn btn-outline-danger btn-block"><img src="Imagenes/Usuario.png" height="15x15"><font size="3" face="Univers-Light-Normal">     Mi cuenta</font></a><br>
                            <a href="MisViajes.php" class="btn btn-outline-danger btn-block"><img src="Imagenes/MisViajes.png" height="17x17"><font size="3" face="Univers-Light-Normal">     Mis viajes</font></a>
                        </div>     
                    </div>
                 </ul>
            </nav>        
        </header>
      <br>
      <bR>
		<div class="row" position="fixed">
			<div class="col-2">
			</div>
			<div class="col-10">
                         <div class='container'>
                          <?php if (!empty($_GET['viajepropio'])){?>
                             <h4 style="color: red;text-align: center" >NO PUEDES POSTULARTE A UN VIAJE PROPIO. </h4><br>
                          <?php } if (!empty($_GET['tarjetavencida'])){?>
                             <h4 style="color: red;text-align: center" >SU TARJETA SE ENCUENTRA VENCIDA. </h4><br>
                          <?php }
                             if (!empty($_GET['notarjeta'])){?>
                             <h4 style="color: red;text-align: center" >USTED NO POSEE UNA TARJETA REGISTRADA. </h4><br>
                          <?php }
                             if (!empty($_GET['asientosNO'])){?>
                             <h4 style="color: red;text-align: center" >SE ACABARON LOS ASIENTOS PARA ESTE VIAJE. </h4><br>
                          <?php }
                             if (!empty($_GET['yapostulado'])){?>
                             <h4 style="color: red;text-align: center" >USTED YA SE HA POSTULADO AL VIAJE SELECCIONADO. </h4><br>
                          <?php }
                             if (!empty($_GET['exito'])){?>
                             <h4 style="color: green;text-align: center" >¡USTED SE HA POSTULADO CON EXITO! </h4><br>
                          <?php }
                             if (!empty($_GET['yaPoseeViaje'])){?>
                             <h4 style="color: red;text-align: center" >USTED TIENE UN VIAJE PROGRAMADO PARA ESA FECHA. </h4><br>
                          <?php }
                             if (!empty($_GET['yaPoseeViajeA'])){?>
                             <h4 style="color: red;text-align: center" >USTED SE ENCUENTRA POSTULADO A UN VIAJE CON LA MISMA FECHA. </h4><br>
                          <?php }
                             if (!empty($_GET['califpendientes'])){?>
                             <h4 style="color: red;text-align: center" >USTED POSEE CALIFICACIONES PENDIENTES DE MAS DE 30 DIAS. </h4><br>
                          <?php }?>
                          <div class="panel panel-danger">
                            <div class="panel-heading">
                                <div class="container-fluid" style="border-style:solid;border-color: red;background-color:#ff9999 ">
                                    <h3 class="text-center">
                                        <?php echo $origen[0] . " -> " . $destino[0]; ?></h3>
                                </div>
                            </div>
                              <div class='container-fluid' style='background-color: #ebe4e4'>
                                    <div class="panel-body text-center" >
                                        <p style="font-size: 40" class="lead">
                                            <strong>$<?php echo $row[8];?></strong></p>
                                    </div>
                                      <ul class="list-group list-group-flush text-center" >
                                        <li class="list-group-item" style="font-size: 25"><i class="icon-ok text-danger"></i><img height="30x30" src='Imagenes/CONDUCTOR.png'><a href="verPerfil.php?id=<?php echo $row[4];?>"><?php echo '    ' . $nombreUser[0] . ' ' . $nombreUser[1]; ?></a></li>
                                        <li class="list-group-item" style="font-size: 25"><i class="icon-ok text-danger"></i><img height="30x30" src='Imagenes/calendario.png'><?php echo '     ' . $row[1]. ' a las ' . substr($row[2], 0, 5);?></li>
                                        <li class="list-group-item" style="font-size: 25"><i class="icon-ok text-danger"></i><img height="30x30" src="Imagenes/reloj.png"><?php $fecha1 = new DateTime("$row[1] . $row[2]");$fecha2 = new DateTime($row[5]);$diferencia = $fecha2->diff($fecha1);$agregar=0;if($diferencia->d>0){$agregar=$diferencia->d*24;}$horas=$diferencia->h+$agregar;echo "   $horas horas";if(($diferencia->i)!=0){echo" y $diferencia->i minutos";}?></li>
                                        <li class="list-group-item" style="font-size: 25"><i class="icon-ok text-danger"></i><img height="30x30" src='Imagenes/AUTO.png'><?php echo '     ' . $vehiculos[0] . ' '.$vehiculos[1] ;?></li>
                                        <li class="list-group-item" style="font-size: 25"><i class="icon-ok text-danger"></i><img height="30x30" src='Imagenes/asiento.png'><?php echo '     ' . $row[9]. ' asientos disponibles';?></li>
                                      </ul>
                                    <div class="panel-footer">
                                        <a class="btn btn-lg btn-block btn-danger" href="postularse.php?id=<?php echo $idviaje;?>">SOLICITAR INSCRIPCIÓN</a>
                                </div>
                              </div>
                            </div>
			</div>
                     </div>
                </div>
			<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        	<input type="submit" value="" />  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        	<script src="js/bootstrap.min.js"></script>
    	</body>
    </html>
