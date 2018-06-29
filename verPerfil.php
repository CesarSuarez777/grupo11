
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
            
            $id = $_GET['id'];
            $resultado = mysqli_query($link, "SELECT * FROM usuarios where ID='$id'");
            $row = $resultado->fetch_array(MYSQLI_ASSOC);
            
            $puntos=0;
            $calificaciones = mysqli_query($link, "SELECT calificacion FROM calificaciones where IDdestino=$id");
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
                              <div class="container-fluid">    
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
                                                  <p><img height="20" src="Imagenes/calificacion.png"> Calificación conductor: <?php echo $puntos ?></p>
                                                </ul>
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
