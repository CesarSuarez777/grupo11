
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
  
            $idviaje=$_GET['id'];
            
            $solicitudes = mysqli_query($link, "SELECT * FROM postulados_usuarios_viajes,usuarios where IDviaje=$idviaje and ID=IDusuario ORDER BY estado desc");
            
            
            
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
                            <br>    
                            <div  class="container">
                                <?php 
                                    if(!empty($_GET['noAsientos'])){?>
                                <h4 style="color: red;text-align: center" >NO SE PUEDE ACEPTAR MAS SOLICITUDES. VIAJE LLENO. </h4><br>
                                <?php
                                    }?> 
				<table class="table table-sm table-borderless">
                                                 <thead class='thead-light'>
                                                 <tr style='border-bottom: 2px solid #f17376'>
                                                   <th scope="color"><font size='5'>Nombre</font></th>
                                                   <th scope="col"><font size='5'>Edad</font></th>
                                                   <th scope="col"><font size='5'>Calificación</font></th>
                                                   <th scope="col"></th>
                                                 </tr>
                                               </thead>
                                               <tbody>
                                                 <?php while($fila = $solicitudes->fetch_array(MYSQLI_NUM)) {
                                                    $nombreUser = mysqli_query($link,"SELECT ID,penalizacion_acom FROM usuarios where ID=$fila[0]");
                                                    $nombreUser = $nombreUser ->fetch_array(MYSQLI_NUM);
                                                    
                                                    $puntos=0;
                                                    $calificaciones = mysqli_query($link, "SELECT calificacion FROM calificaciones where IDdestino=$nombreUser[0] AND !aConductor");
                                                    while($cal = $calificaciones->fetch_array(MYSQLI_NUM)){
                                                        $puntos=$puntos+$cal[0];
                                                    }
                                                    $puntos = $puntos - $nombreUser[1];
                                                 ?>
                                                 <tr style='margin-top: 30px;background-color: <?php if($fila[2]==1){echo "8fe59d";}else{if ($fila[2]==0){echo "ecf7bd";}else{echo "ffb3b8";}}?>'>
                                                   <td><font face='georgia'><?php echo $fila[4] . ' ' .  $fila[5]; ?></font></td>
                                                   <td><font face='georgia'><?php echo calcularEdad($fila[8]) . 'años'; ?></font></td>
                                                   <td ><font face='georgia' style="color: <?php if ($puntos>=0){echo "green";}else{echo "red";}?>"><?php echo $puntos?> puntos</font></td>
                                                   <td style="text-align:right"><?php if(($fila[2]==0)){?>
                                                       <a href="aceptarPostulado.php?idV=<?php echo $fila[1];?>&idU=<?php echo $fila[0];?>" class='btn  btn-success' style="font-size:14">Aceptar solicitud</a><span>  </span><a href="rechazarPostulado.php?idV=<?php echo $fila[1];?>&idU=<?php echo $fila[0];?>" class='btn btn-danger' style="font-size:14">Rechazar solicitud</a>
                                                   <?php  
                                                   }else {if($fila[2]==1){?>
                                                       <a  href="cancelarPostulado.php?idV=<?php echo $fila[1];?>&idU=<?php echo $fila[0];?>"class='btn btn-danger' style="font-size:14;width: 270px; height:35px">Cancelar solicitud</a>
                                                   <?php }} ?>
                                                 </tr>
                                                 <?php

                                                 }?>
                                               </tbody>
                                </table>
                            </div>
                </div>
  </body>
                <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        	<input type="submit" value="" />  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        	<script src="js/bootstrap.min.js"></script>

    </html>