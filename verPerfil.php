
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/comentarios.css">
         
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
            $calificaciones = mysqli_query($link, "SELECT calificacion FROM calificaciones where IDdestino=$id AND aConductor");
            while($cal = $calificaciones->fetch_array(MYSQLI_NUM)){
                $puntos=$puntos+$cal[0];
            }
            $puntos = $puntos - $row['penalizacion'];
            
            $puntosA=0;
            $calificacionesA= mysqli_query($link, "SELECT calificacion FROM calificaciones where IDdestino=$id AND !aConductor");
            while($calA = $calificacionesA->fetch_array(MYSQLI_NUM)){
                $puntosA=$puntosA+$calA[0];
            }
            
            $puntosA = $puntosA - $row['penalizacion_acom'];
            
            $calificaciones = mysqli_query($link,"SELECT * FROM calificaciones where IDdestino=$id and calificacion!=0 and aConductor=1 ORDER BY fecha desc");
            $calificacionesA = mysqli_query($link,"SELECT * FROM calificaciones where IDdestino=$id and calificacion!=0 and aConductor=0 ORDER BY fecha desc");

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
                                                  <p><img height="20" src="Imagenes/calificacion.png"> Calificación acompañante: <?php echo $puntosA ?></p>
                                                </ul>
                                            </div>
                                        </div>
                                      </div>
                              </div>
                         <div class="container-fluid" >
                             <h1>Calificaciones</h1>
                             <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true"><font color="#f87678">Calficaciones como conductor</font></a>
                                  <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false"><font color="#f87678">Calificaciones como acompañante</font></a>
                                </div>
                              </nav>
                              <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <h3 align="right" style="color: #cccccc"><?php echo mysqli_num_rows($calificaciones);?> Comentarios</h3>
                             <?php while ($cal = $calificaciones ->fetch_array(MYSQLI_NUM)) {
                                $usuariocalif = mysqli_query($link, "SELECT nombre,apellido,ID FROM calificaciones,usuarios where IDcalif=$cal[5] AND IDorigen=ID");
                                $usu = $usuariocalif -> fetch_array(MYSQLI_NUM);
                             ?>
                             <div class="container-fluid">
                                 <div class="row">
                                     <div class="col-1">
                                         <img height="70x70" src="Imagenes/<?php if($cal[4]==1){echo "like.png";}else{ echo "unlinke.png";} ?>">
                                     </div>
                                     <div class="col-7">
                                         <div><span style="float:right"><span style="font-weight:bold"> <?php echo $cal[3]?></span></span><a style="font-weight: bold"  href="verPerfil.php?id=<?php echo $usu[2];?>"><?php echo $usu[0] . " " . $usu[1]; ?></a></div>
                                         <p style="margin-left: 10px"><?php echo $cal[2]; ?></p>
                                     </div>
                                     <div class="col-4"> 
                                     </div>
                                 </div>
                             </div><hr style="height:3px; color:#999999" />
                             <?PHP }?></div>
                                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <h3 align="right" style="color: #cccccc"><?php echo mysqli_num_rows($calificacionesA);?> Comentarios</h3>    
                                <?php while ($calA = $calificacionesA ->fetch_array(MYSQLI_NUM)) {
                                $usuariocalifA = mysqli_query($link, "SELECT nombre,apellido,ID FROM calificaciones,usuarios where IDcalif=$calA[5] AND IDorigen=ID");
                                $usuA = $usuariocalifA -> fetch_array(MYSQLI_NUM);
                             ?>
                             <div class="container-fluid">
                                 <div class="row">
                                     <div class="col-1">
                                         <img height="70x70" src="Imagenes/<?php if($calA[4]==1){echo "like.png";}else{ echo "unlinke.png";} ?>">
                                     </div>
                                     <div class="col-7">
                                         <div><span style="float:right"><span style="font-weight:bold"> <?php echo $calA[3]?></span></span><a style="font-weight: bold"  href="verPerfil.php?id=<?php echo $usuA[2];?>"><?php echo $usuA[0] . " " . $usuA[1]; ?></a></div>
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
 
			<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        	<input type="submit" value="" />  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        	<script src="js/bootstrap.min.js"></script>
    	</body>
    </html>
