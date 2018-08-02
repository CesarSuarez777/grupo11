
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
            
            $calificaciones = mysqli_query($link, "SELECT calificacion FROM calificaciones where IDdestino=$IDusuario AND aConductor");
            while($cal = $calificaciones->fetch_array(MYSQLI_NUM)){
                $puntos=$puntos+$cal[0];
            }
            $puntos = $puntos - $row['penalizacion'];
            
            $puntosA=0;
            $calificacionesA= mysqli_query($link, "SELECT calificacion FROM calificaciones where IDdestino=$IDusuario AND !aConductor");
            while($calA = $calificacionesA->fetch_array(MYSQLI_NUM)){
                $puntosA=$puntosA+$calA[0];
            }
            
            $puntosA = $puntosA - $row['penalizacion_acom'];
            
            $calificaciones = mysqli_query($link,"SELECT * FROM calificaciones where IDdestino=$IDusuario and calificacion!=0 and aConductor=1 ORDER BY fecha desc");
            $calificacionesA = mysqli_query($link,"SELECT * FROM calificaciones where IDdestino=$IDusuario and calificacion!=0 and aConductor=0 ORDER BY fecha desc");

           
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
                                    <form action="PaginaPrincipal.php" method="POST" accept-charset="utf-8">
                                      <div class="input-group">
                                        <div style="width:60%" class="input-group input-group-prepend mb-3">
                                            <div class="input-group-prepend">
                                                <span  class="input-group-text" id="basic-addon1"><font size="3" face="Univers-Light-Normal">Origen</font></span>
                                            </div>
                                            <select style="height: 40px" class="custom-select" placeholder='vehiculo' name='IDOrigen' id="inputGroupSelect01">
                                                    <option value="" selected></option>
                                                    <?php $citys=mysqli_query($link,"SELECT * FROM ciudades ORDER BY nombre");while($fila3 = $citys->fetch_array(MYSQL_NUM)){?>
                                                    <option value="<?php echo $fila3[1]?>"><?php echo $fila3[0] ?></option>
                                                    <?php }?>
                                            </select>
                                        </div>
                                        <div style="width:38%;margin-left:10px" class="input-group input-group-prepend mb-3">
                                            <div class="input-group-prepend">
                                                <span  class="input-group-text" id="basic-addon1"><font size="3" face="Univers-Light-Normal">Fecha</font></span>
                                            </div>
                                          <input  type="date" face="Univers-Light-Normal" name="fecha" class="form-control" aria-label="La Plata" aria-describedby="basic-addon1">
                                        </div>
                                      </div>
                                      <div style="width:60%" class="input-group input-group-prepend mb-3">
                                          <div class="input-group-prepend">
                                              <span class="input-group-text" id="basic-addon1"><font size="3" face="Univers-Light-Normal">Destino</font></span>
                                          </div>
                                            <select style="height: 40px" class="custom-select" placeholder='vehiculo' name='IDDestino' id="inputGroupSelect02">
                                                    <option value="" selected></option>
                                                    <?php $citys=mysqli_query($link,"SELECT * FROM ciudades ORDER BY nombre");while($fila3 = $citys->fetch_array(MYSQL_NUM)){?>
                                                    <option value="<?php echo $fila3[1]?>"><?php echo $fila3[0] ?></option>
                                                    <?php }?>
                                            </select>                                    
                                          </div>
                                </div>
                                <div class="col-2">
                                    <br>
                                    <button type="submit" name="apreto_ir" href="" class="btn btn-outline-danger btn-lg btn-block btn-lg"><font size="5" face="Univers-Light-Normal">Ir</font></button><br>
                                </div>
                              </form>
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
            <a class="nav-item nav-link" id="nav-trans-tab" data-toggle="tab" href="#nav-trans" role="tab" aria-controls="nav-trans" aria-selected="false"><font color="#f87678">Mis transacciones</font></a>

          </div>
				</nav>
				<div class="tab-content" id="nav-tabContent">
				<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <div class="container-fluid">
               <?php if (!empty($_GET['nuevaClave'])) {
                   ?><br><h5 align="center" style="color: green">¡Contraseña modificada con éxito!</h5><?php
                } if (!empty($_GET['viajesp'])) {
                    ?><br><h5 align="center" style="color: red">No puede editar una tarjeta con viajes pendientes.</h5><?php
                }if (!empty($_GET['vusado'])) {
                    ?><br><h5 align="center" style="color: red">No puede editar un vehiculo con viajes pendientes.</h5><?php
                }if (!empty($_GET['vusadoe'])) {
                    ?><br><h5 align="center" style="color: red">No puede borrar un vehiculo con viajes pendientes.</h5><?php
                }if (!empty($_GET['tarjeta'])) {
                   ?><br><h5 align="center" style="color: green">¡Tarjeta agregada con éxito!</h5><?php
                } if (!empty($_GET['teliminada'])){
                   ?><br><h5 align="center" style="color: green">¡Tarjeta eliminada con éxito!</h5><?php
                }if (!empty($_GET['viajespe'])){
                   ?><br><h5 align="center" style="color: red">No puede eliminar una tarjeta con viajes pendientes.</h5><?php
                }
                if (!empty($_GET['vehiculo'])){
                    ?><br><h5 align="center" style="color: green">¡Vehiculo agregado con exito!</h5><?php
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
                            <p><img height="20" src="Imagenes/calificacion.png"> Calificación acompañante: <?php echo $puntosA ?></p>
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
                  <div class="container-fluid" >
                             <h1>Calificaciones</h1>
                             <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                 <a class="nav-item nav-link active" id="nav-home2-tab" data-toggle="tab" href="#nav-home2" role="tab" aria-controls="nav-home2" aria-selected="true"><font color="#f87678">Calficaciones como conductor</font></a>
                                  <a class="nav-item nav-link" id="nav-profile2-tab" data-toggle="tab" href="#nav-profile2" role="tab" aria-controls="nav-profile2" aria-selected="false"><font color="#f87678">Calificaciones como acompañante</font></a>
                                </div>
                              </nav>
                              <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-home2" role="tabpanel" aria-labelledby="nav-home-tab">
                                <h3 align="right" style="color: #cccccc"><?php echo mysqli_num_rows($calificaciones);?> Comentarios</h3>
                             <?php while ($cal = $calificaciones ->fetch_array(MYSQLI_NUM)) {
                                $usuariocalif = mysqli_query($link, "SELECT nombre,apellido,ID,borrado FROM calificaciones,usuarios where IDcalif=$cal[5] AND IDorigen=ID");
                                $usu = $usuariocalif -> fetch_array(MYSQLI_NUM);
                             ?>
                             <div class="container-fluid">
                                 <div class="row">
                                     <div class="col-1">
                                         <img height="70x70" src="Imagenes/<?php if($cal[4]==1){echo "like.png";}else{ echo "unlinke.png";} ?>">
                                     </div>
                                     <div class="col-7">
                                         <div><span style="float:right"><span style="font-weight:bold"> <?php $hora = new DateTime ("$cal[8]"); echo $hora ->format('d-m-Y H:i');?></span></span>
                                            <?php if(!$usu[3]){ ?>
                                                <a style="font-weight: bold"  href="verPerfil.php?id=<?php echo $usu[2];?>"><?php echo $usu[0] . " " . $usu[1]; ?></a>
                                              <?php } else{ ?> <strong> <?php echo $usu[0] . " " . $usu[1]; ?> </strong> <?php }?>
                                        </div>
                                         <p style="margin-left: 10px"><?php echo $cal[2]; ?></p>
                                     </div>
                                     <div class="col-4"> 
                                     </div>
                                 </div>
                             </div><hr style="height:3px; color:#999999" />
                             <?PHP }?></div>
                                <div class="tab-pane fade" id="nav-profile2" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <h3 align="right" style="color: #cccccc"><?php echo mysqli_num_rows($calificacionesA);?> Comentarios</h3>    
                                <?php while ($calA = $calificacionesA ->fetch_array(MYSQLI_NUM)) {
                                    $usuariocalifA = mysqli_query($link, "SELECT nombre,apellido,ID,borrado FROM calificaciones,usuarios where IDcalif=$calA[5] AND IDorigen=ID");
                                    $usuA = $usuariocalifA -> fetch_array(MYSQLI_NUM);
                             ?>
                             <div class="container-fluid">
                                 <div class="row">
                                     <div class="col-1">
                                         <img height="70x70" src="Imagenes/<?php if($calA[4]==1){echo "like.png";}else{ echo "unlinke.png";} ?>">
                                     </div>
                                     <div class="col-7">
                                         <div><span style="float:right"><span style="font-weight:bold"> <?php $hora = new DateTime ("$calA[8]"); echo $hora ->format('d-m-Y H:i'); ?></span></span>
                                            <?php if(!$usuA[3]){ ?>
                                                <a style="font-weight: bold"  href="verPerfil.php?id=<?php echo $usuA[2];?>"><?php echo $usuA[0] . " " . $usuA[1]; ?></a>
                                            <?php } else{ ?> <strong> <?php echo $usuA[0] . " " . $usuA[1]; ?> </strong> <?php }?>
                                        </div>
                                         <p style="margin-left: 10px"><?php echo $calA[2]; ?></p>
                                     </div>
                                     <div class="col-4"> 
                                     </div>
                                 </div>
                             </div><hr style="height:3px; color:#999999" />
                             <?PHP }?></div>
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
                                    <div class="tab-pane fade" id="nav-trans" role="tabpanel" aria-labelledby="nav-trans-tab"> 
                                    <?php
                                        $pagos = mysqli_query($link, "SELECT * FROM pagos where (IDusuario_destino=$IDusuario OR IDusuario_origen=$IDusuario) AND deuda=false ORDER BY fecha desc");
                                        ?>
                                          <br>
                                          <h5 style="margin-left:500px"><img src="Imagenes/Verde.jpg" height="17x17"><font size="3" face="Georgia">     Cobro   </font><img src="Imagenes/Rojo.jpg" height="17x17"><font size="3" face="Georgia">     Pago   </font></h5>                                    
                                          <table class="table table-sm table-borderless">
                                          <thead class='thead-light'>
                                          <tr style='border-bottom: 2px solid #f17376'>
                                            <th scope="col"><font size='5'>Monto</font></th>
                                            <th scope="col"><font size='5'>Fecha</font></th>
                                            <th scope="col"><font size='5'>Numero de transacción</font></th>
                                          </tr>
                                          </thead>
                                          <tbody><?php
                                          while($p = $pagos ->fetch_array(MYSQLI_NUM)){                                              
                                          ?>
                                          <tr style='margin-top: 30px;background-color:<?php if($p[1]==$IDusuario){echo "8fe59d"; }else{echo "ffb3b8";}?>'>
                                            <td><font face='georgia'><?php if($p[1]==$IDusuario){echo "+";}else{echo "-";} echo "$" . $p[3]; ?></font></td>
                                            <td><font face='georgia'><?php echo $p[4]; ?></font></td>
                                            <td><font face='georgia'><?php echo $p[0]; ?></font></td>
                                          </tr>
                                          <?php
                                          
                                          }?>
                                        </tbody>
                                        </table>
                                    </div>
                                </div>
                              </div>
                            </div>
                           
			<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        	<input type="submit" value="" />  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        	<script src="js/bootstrap.min.js"></script>
    	</body>
    </html>



