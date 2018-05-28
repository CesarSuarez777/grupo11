
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

            $link=conectarABase();

            $email=$_SESSION['email'];

            $resultado = mysqli_query($link, "SELECT * FROM usuarios where email='$email'");
            $row = $resultado->fetch_array(MYSQLI_ASSOC);

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
                            <a href="MiCuenta.php" class="btn btn-outline-danger btn-block"><img src="Usuario.png" height="15x15"><font size="3" face="Univers-Light-Normal">     Mi cuenta</font></a><br>
                            <a href="MisViajes.php" class="btn btn-outline-danger btn-block"><img src="MisViajes.png" height="17x17"><font size="3" face="Univers-Light-Normal">     Mis viajes</font></a>
                        </div>     
                    </div>
		          </ul>
            </nav>        
        </header>
		<div class="row" position="fixed">
			<div class="col-2">
				<div class="container" align="center">
					<a href="#nav-profile">Agregar vehiculo </a><br>
					<a href="logout.php">Cerrar Sesion </a>
				</div>
			</div>
			<div class="col-10">
				<nav>
				  <div class="nav nav-tabs" id="nav-tab" role="tablist">
				    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true"><font color="#f87678">Mis datos personales</font></a>
				    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false"><font color="#f87678">Mis vehiculos</font></a>
				    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false"><font color="#f87678">Mi tarjeta</font></a>
				  </div>
				</nav>
				<div class="tab-content" id="nav-tabContent">
				  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"><br>
                      <div class="container-fluid">
                      <div class="row">               
                          <div class="panel panel-info">
                            <div class="panel-heading">
                              <h3 class="panel-title"><?php echo $row['apellido'] . ", " . $row['nombre']; ?></h3>
                            </div>
                            <div class="panel-body">
                              <div class="row">
                                <div class="col-md-3 col-lg-3 " align="center"> <img src="imageView.php?image_id=<?php echo $row["foto"]; ?>" class="img-circle img-responsive"> </div>
                                <div class=" col-md-9 col-lg-9 "> 
                                  <table class="table table-user-information">
                                    <tbody>
                                      <tr>
                                        <td>Fecha de nacimiento</td>
                                        <td><?php echo $row['fecha'];?></td>
                                      </tr>
                                      <tr>
                                        <td>Email</td>
                                        <td><?php echo $row['email'];?></td>
                                      </tr>                       
                                    </tbody>
                                  </table>
                                </div>
                            </div>
                        </div>                            
                  </div>

				  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">...</div>
				  <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">...</div>
				</div>
			</div>
			<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        	<input type="submit" value="" />  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        	<script src="js/bootstrap.min.js"></script>
    	</body>
    </html>



