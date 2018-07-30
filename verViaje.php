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
            
            $nombreUser = mysqli_query($link,"SELECT nombre,apellido,ID,penalizacion,borrado FROM usuarios where ID=$row[4]");
            $nombreUser = $nombreUser ->fetch_array(MYSQLI_NUM);
            
            $vehiculos = mysqli_query($link, "SELECT marca,modelo FROM vehiculos where IDvehiculo='$row[3]'");
            $vehiculos = $vehiculos -> fetch_array(MYSQLI_NUM);
            
            $puntos=0;
            
            $calificaciones = mysqli_query($link, "SELECT calificacion FROM calificaciones where IDdestino=$nombreUser[2] AND aConductor");
            while($cal = $calificaciones->fetch_array(MYSQLI_NUM)){
                $puntos=$puntos+$cal[0];
            }
            
            if(isset($_POST['preguntar'])){
                $comentario=$_POST['comentario'];
                if(!empty($comentario)){
                    $ahora = new DateTime();
                    $hoy = $ahora->format('Y-m-d H:i:s');
                    mysqli_query($link, "INSERT INTO comentarios (IDuser, IDviaje, Contenido,fecha) VALUES ($iduser,$idviaje,'$comentario','$hoy')");
                    header("Location: verViaje.php?id=$idviaje&pregunto=true");
                }
            }
            
            $puntos = $puntos - $nombreUser[3];
            
            $postulados = mysqli_query($link, "SELECT IDusuario from postulados_usuarios_viajes where IDviaje=$idviaje AND IDusuario=$iduser");
            
            $numfilas = mysqli_num_rows($postulados);

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
                            if (!empty($_GET['respondio'])){?>
                             <h4 style="color: green;text-align: center" >RESPUESTA GUARDADA. </h4><br>
                          <?php }
                            if ((!empty($_GET['pregunto']))&&(!isset($_POST['preguntar']))){?>
                             <h4 style="color: green;text-align: center" >PREGUNTA ENVIADA. </h4><br>
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
                              <div class='container-fluid' style='background-color: #ebe4e4;'>
                                    <div class="panel-body text-center" >
                                        <p style="font-size: 40" class="lead">
                                            <strong>$<?php echo round($row[8],2);?></strong></p>
                                    </div>
                                      <ul class="list-group list-group-flush text-center" >
                                          <li class="list-group-item" style="font-size: 25"><i class="icon-ok text-danger"></i><img height="30x30" src='Imagenes/CONDUCTOR.png'>
                                            <?php if(!$nombreUser[4]){ ?>
                                                <a style="font-weight: bold"  href="verPerfil.php?id=<?php echo $row[4];?>"><?php echo $nombreUser[0] . " " . $nombreUser[1]; ?></a>
                                              <?php } else{ ?> <strong> <?php echo $nombreUser[0] . " " . $nombreUser[1]; ?> </strong> <?php }?>
                                            <img style="margin-left:15px" height="25x25" src="Imagenes/<?php if($puntos>=0){echo "like.png";}else{echo "unlinke.jpg";}?>"><font style="color: <?php if ($puntos>=0){echo "green";}else{echo "red";}?>"> <?php echo '   ' . $puntos;?></font></li>
                                        <li class="list-group-item" style="font-size: 25"><i class="icon-ok text-danger"></i><img height="30x30" src='Imagenes/calendario.png'><?php echo '     ' . $row[1]. ' a las ' . substr($row[2], 0, 5);?></li> 
                                        <li class="list-group-item" style="font-size: 25"><i class="icon-ok text-danger"></i><img height="30x30" src="Imagenes/reloj.png"><?php $fecha1 = new DateTime("$row[1] . $row[2]");$fecha2 = new DateTime($row[5]);$diferencia = $fecha2->diff($fecha1);$agregar=0;if($diferencia->d>0){$agregar=$diferencia->d*24;}$horas=$diferencia->h+$agregar;echo "   $horas horas";if(($diferencia->i)!=0){echo" y $diferencia->i minutos";}?></li>
                                        <li class="list-group-item" style="font-size: 25"><i class="icon-ok text-danger"></i><img height="30x30" src='Imagenes/AUTO.png'><?php echo '     ' . $vehiculos[0] . ' '.$vehiculos[1] ;?></li>
                                        <li class="list-group-item" style="font-size: 25"><i class="icon-ok text-danger"></i><img height="30x30" src='Imagenes/asiento.png'><?php echo '     ' . $row[9]. ' asientos disponibles';?></li>
                                      </ul>
                                    <div class="panel-footer">
                                        <?php if ($row[4]!=$iduser && $numfilas == 0){ ?>
                                        <a class="btn btn-lg btn-block btn-danger" href="postularse.php?id=<?php echo $idviaje;?>">SOLICITAR INSCRIPCIÓN</a>                                                           
                                        <?php }?>  
                                        <br>
                                    </div>
                                  <?php if($row[4]!=$iduser){ ?>
                                  <form method="POST" action="">
                                    <div class="form-group">
                                        <h3>Haz una pregunta:</h3>
                                        <?php if(isset($_POST['preguntar'])){
                                            if(empty($comentario)){
                                                ?> <br><font size="2" color="red" face="Univers-Light-Normal">No puede hacer preguntas vacías.</font><?php 
                                            }
                                        }
                                        ?>
                                        <textarea class="form-control" rows="4" id="comentario" name="comentario"></textarea>
                                    </div>             
                                      <button class="btn btn-success btn-block" type="submit" name="preguntar" onclick="return confirm('¿Estás seguro de enviar la pregunta?');">Enviar pregunta</button>    
                                 </form>
                                 <br>
                                 <?php }?>
                                <h3>Preguntas:</h3>
                                <?php
                                    $comentarios = mysqli_query($link,"SELECT * FROM comentarios where IDviaje=$idviaje");
                                    $owner = mysqli_query($link, "SELECT nombre,apellido,ID FROM viajes,usuarios where IDConductor=ID and IDviaje=$idviaje");
                                    $own = $owner->fetch_array(MYSQLI_NUM);
                                    while($comen = $comentarios ->fetch_array(MYSQL_NUM)){
                                        $usuario = mysqli_query($link,"SELECT nombre,apellido,ID,borrado FROM usuarios where ID=$comen[1]");
                                        $usu = $usuario ->fetch_array(MYSQLI_NUM);
                                        ?>
                                        <div class="container-fluid" style="background-color:white">
                                            <div><span style="float:right"><span style="font-weight:bold"> <?php echo $comen[5]?></span></span>
                                              <?php if(!$usu[3]){ ?>
                                                <a style="font-weight: bold"  href="verPerfil.php?id=<?php echo $usu[2];?>"><?php echo $usu[0] . " " . $usu[1]; ?></a>
                                              <?php } else{ ?> <strong> <?php echo $usu[0] . " " . $usu[1]; ?> </strong> <?php }?>
                                            </div>
                                            <p style="margin-left: 10px"><?php echo $comen[3]; ?></p>
                                            <br>
                                        </div>
                                        <?php if (!empty($comen[4])){?>
                                            <div style="margin-left:40px">
                                                <h6>Respuesta</h6>
                                            <div class="container-fluid" style="background-color: white">
                                                <div><a style="font-weight: bold"  href="verPerfil.php?id=<?php echo $own[2];?>"><?php echo $own[0] . " " . $own[1]; ?></a></div>
                                                <p style="margin-left: 10px"><?php echo $comen[4]; ?> </p>
                                                <br>
                                            </div>
                                            </div>
                                        <?php }else{
                                            if($row[4]==$iduser){
                                                ?><br><div class="container"><a class="btn btn-success btn-block" href="responder_comentario.php?id=<?php echo $comen[0];?>" >Responder</a></div><?php
                                            }
                                        }
?>
                                         <hr style="height:3px; color:#999999" />
                                        <?PHP
                                    }
                                ?>
                                <br>
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
