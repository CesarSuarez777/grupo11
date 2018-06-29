<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/Estilos.css">
      
  </head>
  <body>
          <?php
          include 'funciones.php';
          session_start();
            
          $link = conectarABase();
          
          $incioSesion = inicioSesion();
          if (!$incioSesion){
            
          header("Location: index.php?inicio=$incioSesion");
            
          exit;
          }
          $hoy = new DateTime('today');
          
          $viajes = mysqli_query($link, "SELECT * FROM viajes"); 
          
        ?>
      
      
          <header style="position: fixed">
            <nav>
                    <div class="row">
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
            </nav>
        </header>
      <br><br><br><br><br><br>
          <div class="row">
              <div class="col-2 bg-white">
                  <div class="container-fluid">
                      <a href='crear_viaje.php' class="btn btn-block btn-outline-danger btn-lg"><font size='5'>Crear viaje</font></a> 
                  </div>
              </div>
              <div class="col-10 ">
                        <div style="margin-right: 30px">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Detalle de viaje</th>
                                        <th class='text-center'>Fecha</th>
                                        <th class="text-center">Precio</th>
                                        <th> </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while($row = $viajes->fetch_array(MYSQLI_NUM)){
                                    $fechaViaje = new DateTime($row[1] . $row[2]);
                                    if (($fechaViaje > $hoy)&&($row[9]>0)){
                                    $origen= mysqli_query($link, "SELECT * FROM ciudades where IDCiudad=$row[6]");
                                    $origen = $origen ->fetch_array(MYSQLI_NUM);
                                    $destino= mysqli_query($link, "SELECT * FROM ciudades where IDCiudad=$row[7]");
                                    $destino = $destino ->fetch_array(MYSQLI_NUM);
                                    $conductor = mysqli_query($link, "SELECT * FROM usuarios where ID=$row[4]");
                                    $conductor = $conductor ->fetch_array(MYSQLI_NUM);
                                    $calificaciones = mysqli_query($link, "SELECT calificacion FROM calificaciones where IDdestino=$conductor[7] AND aConductor");
                                    $puntos=0;
                                    while($cal = $calificaciones->fetch_array(MYSQLI_NUM)){
                                        $puntos=$puntos+$cal[0];
                                    }
                                    $puntos = $puntos - $conductor[9];
                                    ?>
                                    <tr>
                                        <td>
                                        <div class="media">                                           
                                            <div class="media-body">
                                                <img src="Imagenes/VIAJE.png" height="20"><font size='5' color='black'> <?php echo"$origen[0] - $destino[0]" ?></font>&nbsp;<img src="Imagenes/reloj.png" height="15"><strong style="font-size: 13px"> <?php $fecha1 = new DateTime("$row[1] . $row[2]");$fecha2 = new DateTime($row[5]);$diferencia = $fecha2->diff($fecha1);$agregar=0;if($diferencia->d>0){$agregar=$diferencia->d*24;}$horas=$diferencia->h+$agregar;echo "$horas horas";if(($diferencia->i)!=0){echo" y $diferencia->i minutos";}?></strong><br>
                                                <img src="Imagenes/CONDUCTOR.png" height="28"><font size='4'><a href="verPerfil.php?id=<?php echo $conductor[7]?>"> <?php echo "$conductor[0] $conductor[1]"?></a></font><font size='2' color='<?php if ($puntos>=0){echo "green";}else{echo "red";}?>'><strong color='<?php if($puntos>=0){echo "green";}else{echo "red";} ?>'>&nbsp;&nbsp;<?php echo $puntos?></strong> puntos</font><br>  
                                            </div>
                                        </div></td>
                                        <td style="text-align: center">                                    
                                        <?php $fechaS = new DateTime($row[1]); echo $fechaS->format('d-m-Y');?>
                                        </td>
                                        <td style="text-align: center"><strong><?php echo '$' . round($row[8],2);?></strong></td>
                                        <td>
                                            <a class="btn btn-outline-danger" href="verViaje.php?id=<?php echo $row[0];?>">
                                             VER VIAJE
                                        </a></td>
                                    </tr>
                                    <?php }}?>
                                </tbody>
                            </table>
                    </div>
              </div>
          </div>

   
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
    
    <?php
    
    ?>
  </body>
  
</html>
