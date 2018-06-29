
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
                            <br>
                            <h5 style="margin-left:300px"><img src="Imagenes/Amarillo.jpg" height="17x17"><font size="3" face="Georgia">     Solicitud pendiente   </font><img src="Imagenes/Verde.jpg" height="17x17"><font size="3" face="Georgia">     Solicitud aceptada   </font><img src="Imagenes/Rojo.jpg" height="17x17"><font size="3" face="Georgia">     Solicitud rechazada   </font></h5>                                    
                                      
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
                                                   <td><font face='georgia'><?php echo '$' . $fila[12]; ?></font></td>
                                                   <td><?php if((($fila[2]==1)&&($hoy>$createDate3))or $fila[2]==-1){}else{?><a onclick="return confirm('¿Estás seguro?');" href='<?php echo "eliminarViaje.php?id=$id"; ?>'>Eliminar solicitud</a> <?php }?></td>   
                                                 </tr>
                                                 <?php

                                                 }?>
                                               </tbody>
                                </table>
                </div>
  </body>
                <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        	<input type="submit" value="" />  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        	<script src="js/bootstrap.min.js"></script>

    </html>