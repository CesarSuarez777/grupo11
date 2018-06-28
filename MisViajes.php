
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
  
            $resultado = mysqli_query($link, "SELECT * FROM viajes where IDconductor=$id");
            
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
				    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true"><font color="#f87678">Mis viajes como conductor</font></a>
				    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-vehiculo" role="tab" aria-controls="nav-profile" aria-selected="false"><font color="#f87678">Mis viajes como acompañante</font></a>
				  </div>
				</nav>
				<div class="tab-content" id="nav-tabContent">
				  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
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
                                                 <?php while($row = $resultado->fetch_array(MYSQLI_NUM)) {
                                                 ?>
                                                   <tr style='margin-top: 30px'>
                                                   <td><font face='georgia'><?php echo $row[6]; ?></font></td>
                                                   <td><font face='georgia'><?php echo $row[7]; ?></font></td>
                                                   <td><font face='georgia'><?php $createDate = new DateTime("$row[1] . $row[2]"); echo $createDate ->format('Y-m-d h:i');?></font></td>
                                                   <td><font face='georgia'><?php $createDate2 = new DateTime($row[5]);echo $createDate2->format('Y-m-d h:i'); ?></font></td>
                                                   <td><font face='georgia'><?php echo $row[8]; ?></font></td>
                                                   <td><a href='<?php echo "editarViaje.php?id=$id"; ?>'>Editar</a><span> | </span>
                                                       <a onclick="return confirm('¿Estás seguro?');" href='<?php echo "eliminarViaje.php?id=$id"; ?>'>Eliminar</a></td>   
                                                 </tr>
                                                 <?php

                                                 }?>
                                               </tbody>
                                             </table>
                                  </div>
                                  <div class="tab-pane fade" id="nav-vehiculo" role="tabpanel" aria-labelledby="nav-contact-tab">
                                      <p>jajaja</p>
                                  </div>   
                                </div>
                       </div>
                </div>
                <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        	<input type="submit" value="" />  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        	<script src="js/bootstrap.min.js"></script>
    	</body>
    </html>