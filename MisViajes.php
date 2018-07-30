
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
            
            
            $id=$_SESSION['id'];
  
            $resultado = mysqli_query($link, "SELECT * FROM viajes where IDconductor=$id ORDER BY fecha desc");

            $solicitudes = mysqli_query($link, "SELECT * FROM postulados_usuarios_viajes,viajes where IDusuario=$id AND postulados_usuarios_viajes.IDviaje=viajes.IDviaje");
            
            $hoy = new DateTime('today');
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
				    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true"><font color="#f87678">Mis viajes como conductor</font></a>
				    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-vehiculo" role="tab" aria-controls="nav-profile" aria-selected="false"><font color="#f87678">Mis viajes como acompañante</font></a> 
                                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false"><font color="#f87678">Mis calificaciones pendientes</font></a>

				  </div>
				</nav>
				<div class="tab-content" id="nav-tabContent">
				 <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                            <br>
                                            <?php if (!empty($_GET['veliminado'])) {
                                            ?><h5 align="center" style="color: green">¡Viaje eliminado con éxito!</h5><?php
                                            } if (!empty($_GET['exito'])) {
                                            ?><h5 align="center" style="color: green">Se ha eliminado su solicitud.</h5><?php
                                            }if (!empty($_GET['inhabilitado'])) {
                                            ?><br><h5 align="center" style="color: red">No puede editar un viaje con solicitudes pendientes o aceptadas.</h5>
                                            <?php }if (!empty($_GET['calificado'])) {
                                            ?><br><h5 align="center" style="color: green">¡Usuario calificado con éxito!</h5>
                                            <?php
                                            }?>
                                            <h5 style="margin-left:380px"><img src="Imagenes/Amarillo.jpg" height="17x17"><font size="3" face="Georgia">     Viaje pendiente   </font><img src="Imagenes/Celeste.jpg" height="17x17"><font size="3" face="Georgia">     Viaje realizado</font></h5>                                   
                                            <table class="table table-sm table-borderless">
                                                 <thead class='thead-light'>
                                                 <tr style='border-bottom: 2px solid #f17376'>
                                                   <th scope="color"><font size='5'>Origen</font></th>
                                                   <th scope="col"><font size='5'>Destino</font></th>
                                                   <th scope="col"><font size='5'>Fecha</font></th>
                                                   <th scope="col"><font size='5'>Fecha llegada</font></th>
                                                   <th scope="col"><font size='5'>Precio</font></th>
                                                   <th scope="col"><font size='5'>Vehiculo</font></th>
                                                   <th scope='col'></th>
                                                 </tr>
                                               </thead>
                                               <tbody>
                                                 <?php while($row = $resultado->fetch_array(MYSQLI_NUM)) {
                                                     $origen1 = mysqli_query($link, "SELECT * FROM ciudades where IDCiudad=$row[6]");
                                                     $destino1 = mysqli_query($link, "SELECT * FROM ciudades where IDCiudad=$row[7]");
                                                     $origen1 = $origen1->fetch_array(MYSQLI_NUM);
                                                     $destino1 = $destino1->fetch_array(MYSQLI_NUM);
                                                     $vehiculoSelec= mysqli_query($link, "SELECT Patente,asientos FROM vehiculos where IDvehiculo=$row[3]"); 
                                                     $vehiculoSelec = $vehiculoSelec ->fetch_array(MYSQLI_NUM);
                                                     $valor = $row[8]*$vehiculoSelec[1];
                                                     $valor = round($valor,2);
                                                     
                                                     ?>
                                                   <tr style='margin-top: 30px;background-color:<?php $createDate = new DateTime("$row[1] . $row[2]");if($hoy>$createDate){echo "b3f9ff";}else{echo "ecf7bd";}?> '>
                                                   <td><font face='georgia'><?php echo $origen1[0]; ?></font></td>
                                                   <td><font face='georgia'><?php echo $destino1[0]; ?></font></td>
                                                   <td><font face='georgia'><?php echo $createDate ->format('d-m-Y H:i');?></font></td>
                                                   <td><font face='georgia'><?php $createDate2 = new DateTime($row[5]);echo $createDate2->format('d-m-Y H:i'); ?></font></td>
                                                   <td><font face='georgia'><?php echo '$' . $valor; ?></font></td>
                                                   <td><font face='georgia'><?php echo $vehiculoSelec[0]; ?></font></td>
                                                   <td><?php if($hoy<$createDate){?><a href='<?php echo "verSolicitudes.php?id=$row[0]"; ?>'>Ver solicitudes</a><span> | </span>
                                                       <a href='<?php echo "editarViaje.php?id=$row[0]"; ?>'>Editar</a><span> | </span>
                                                       <a onclick="return confirm('Si posee acompañantes confirmados, entonces se le decrementara un punto de calificación ¿Estás seguro?');" href='<?php echo "eliminarViaje.php?id=$row[0]"; ?>'>Eliminar</a></td> <?php }?>
                                                    <?php

                                                    }?>
                                                    </tr>
                                                   
                                               </tbody>
                                             </table>
                                     
                                  </div>
                                  <div class="tab-pane fade" id="nav-vehiculo" role="tabpanel" aria-labelledby="nav-contact-tab">
                                      <br>
                                      <h5 style="margin-left:300px"><img src="Imagenes/Amarillo.jpg" height="17x17"><font size="3" face="Georgia">     Solicitud pendiente   </font><img src="Imagenes/Verde.jpg" height="17x17"><font size="3" face="Georgia">     Solicitud aceptada   </font><img src="Imagenes/Rojo.jpg" height="17x17"><font size="3" face="Georgia">     Solicitud rechazada   </font><img src="Imagenes/Celeste.jpg" height="17x17"><font size="3" face="Georgia">     Viaje realizado</font></h5>                                    
                                      <table class="table table-sm table-borderless">
                                                 <thead class='thead-light'>
                                                 <tr style='border-bottom: 2px solid #f17376'>
                                                   <th scope="color"><font size='5'>Origen</font></th>
                                                   <th scope="col"><font size='5'>Destino</font></th>
                                                   <th scope="col"><font size='5'>Fecha</font></th>
                                                   <th scope="col"><font size='5'>Fecha llegada</font></th>
                                                   <th scope="col"><font size='5'>Precio</font></th>
                                                   <th scope='col'></th>
                                                 </tr>
                                               </thead>
                                               <tbody>
                                                 <?php while($fila = $solicitudes->fetch_array(MYSQLI_NUM)) {
                                                     $origen = mysqli_query($link, "SELECT * FROM ciudades where IDCiudad=$fila[10]");
                                                     $destino = mysqli_query($link, "SELECT * FROM ciudades where IDCiudad=$fila[11]");
                                                     $origen = $origen->fetch_array(MYSQLI_NUM);
                                                     $destino = $destino->fetch_array(MYSQLI_NUM);
                                                 ?>
                                                 <tr style='margin-top: 30px;background-color: <?php $createDate3 = new DateTime("$fila[5] . $fila[6]");if(($fila[2]==1)&&($hoy>$createDate3)){echo "b3f9ff";}else{if ($fila[2]==0){echo "ecf7bd";}else{if ($fila[2]==-1){echo "ffb3b8";}else{echo "8fe59d";}}}?>'>
                                                   <td><font face='georgia'><?php echo $origen[0]; ?></font></td>
                                                   <td><font face='georgia'><?php echo $destino[0]; ?></font></td>
                                                   <td><font face='georgia'><?php echo $createDate3 ->format('d-m-Y H:i');?></font></td>
                                                   <td><font face='georgia'><?php $createDate4 = new DateTime($fila[9]);echo $createDate4->format('d-m-Y H:i'); ?></font></td>
                                                   <td><font face='georgia'><?php echo '$' . round($fila[12],2); ?></font></td>
                                                   <td><a href="verViaje.php?id=<?php echo $fila[1];?>">Detalle</a>
                                                       <?php if((($fila[2]==1)&&($hoy>$createDate3))or $fila[2]==-1){}else{?><span> | </span><a onclick="return confirm('ADVERTENCIA: si usted ya se encuentra aceptado en el viaje se descontará 1 punto a su calificación');" href='eliminarSolicitudAco.php?idV=<?php echo $fila[1];?>&idU=<?php echo $fila[0];?>'>Eliminar solicitud</a> <?php }?>   
                                                   </td>   
                                                 </tr>
                                                 <?php

                                                 }?>
                                               </tbody>
                                        </table>
                                  </div>
                                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                        <?php $calificacionesPendientes = mysqli_query($link, "SELECT * from calificaciones where IDorigen=$id and calificacion=0");
                                              if (mysqli_num_rows($calificacionesPendientes)>0){?>
                                        <table class="table table-sm table-borderless">
                                               <thead class='thead-light'>
                                                 <tr style='border-bottom: 2px solid #f17376'>
                                                   <th scope="color"><font size='5'>Califico a</font></th>
                                                   <th scope="col"><font size='5'>En su rol de</font></th>
                                                   <th scope="col"><font size='5'>Por el viaje a</font></th>
                                                   <th scope="col"><font size='5'>En la fecha</font></th>
                                                   <th scope='col'></th>
                                                 </tr>
                                               </thead>
                                               <tbody>
                                                 <?php 
                                                 while($calif = $calificacionesPendientes->fetch_array(MYSQLI_NUM)) {
                                                     $usuariocalif = mysqli_query($link, "SELECT nombre,apellido FROM usuarios where ID=$calif[1]");
                                                     $usu = $usuariocalif -> fetch_array(MYSQLI_NUM);
                                                     
                                                     $viaje = mysqli_query($link,"SELECT IDDestino,fecha,hora from viajes where IDviaje=$calif[7]");
                                                     $viaj = $viaje -> fetch_array(MYSQLI_NUM);     
                                                     $destino = mysqli_query($link, "SELECT * FROM ciudades where IDCiudad=$viaj[0]");
                                                     $destino = $destino->fetch_array(MYSQLI_NUM);                                                    
                                                 ?>
                                                 <tr style='margin-top: 30px'>
                                                   <td><a href="verPerfil.php?id=<?php echo $calif[1];?>"><font face='georgia'><?php echo $usu[0] . " " . $usu[1] ?></font></a></td>
                                                   <td><font face='georgia'><?php if($calif[6]==0){ echo "Acompañante"; } else {echo "Conductor";}  ?></font></td>
                                                   <td><font face='georgia'><?php echo $destino[0];?></font></td>
                                                   <td><font face='georgia'><?php echo $viaj[1] . " " . $viaj[2];?></font></td>
                                                   <td><a href="calificar_viaje.php?id=<?php echo $calif[5];?>" class="btn btn-outline-danger btn-block" style="margin-right: 20"><font face='georgia'>Calificar</font></a></td>
                                                 </tr>
                                                 <?php

                                                 }}else{
                                                     ?><br><h4 style="color: green;text-align: center" >USTED NO POSEE CALIFICACIONES PENDIENTES. </h4><?php
                                                 }
?>
                                               </tbody>
                                        </table>
                                    </div>
                                </div>
                       </div>
                </div>
  </body>
                <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        	<input type="submit" value="" />  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        	<script src="js/bootstrap.min.js"></script>

    </html>