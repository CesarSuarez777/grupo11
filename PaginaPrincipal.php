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

          $incioSesion = inicioSesion();
          if (!$incioSesion){
            
            header("Location: index.php?inicio=$incioSesion");
            
            exit;
          }
          
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
                            <a href="MiCuenta.php" class="btn btn-outline-danger btn-block"><img src="Imagenes/Usuario.png" height="15x15"><font size="3" face="Univers-Light-Normal">     Mi cuenta</font></a><br>
                            <a href="MisViajes.php" class="btn btn-outline-danger btn-block"><img src="Imagenes/MisViajes.png" height="17x17"><font size="3" face="Univers-Light-Normal">     Mis viajes</font></a>
                        </div>     
                    </div>
            </nav>
        </header>
      <br><br><br><br><br><br>
          <div class="row">
              <div class="col-2 bg-white">
                  <br>
                  <div class="container-fluid" align="center"> 
                      <div class="btn-lg">
                        <button type="button" class="btn btn-lg btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <font size="3" face="Univers-Light-Normal">
                                Ordenar por:
                            </font>
                        </button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="#"> 
                            <font size="3" face="Univers-Light-Normal">
                                Calificación del conductor
                            </font></a>
                          <a class="dropdown-item" href="#">
                           <font size="3" face="Univers-Light-Normal">
                               Precio
                           </font>
                          </a>
                          <a class="dropdown-item" href="#">
                            <font size="3" face="Univers-Light-Normal">
                                Duración
                            </font>
                          </a>
                        </div>
                      </div>
                  </div>
              </div>
              <div class="col-10 ">
               <div class="container-fluid">
                    <div class="row">
                        <div style="margin-right: 30px">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Detalle de viaje</th>
                                        <th class='text-center'>Fecha</th>
                                        <th class="text-center">Tipo</th>
                                        <th class="text-center">Precio</th>
                                        <th> </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="col-sm-7 col-md-6">
                                        <div class="media">                                           
                                            <div class="media-body">
                                                <img src="Imagenes/VIAJE.png" height="20"><font size='6' color='black'> Necochea - La Plata</font>&nbsp;<img src="Imagenes/reloj.png" height="15"><strong style="font-size: 13px"> 4.5hs</strong><br>
                                                <img src="Imagenes/CONDUCTOR.png" height="28"><font size='4'><a href="verPefil.php?id="> Maria Lujan Andersen</a></font><font size='2' color='Green'><strong color='green'>&nbsp;&nbsp;200</strong> puntos</font><br>  
                                            </div>
                                        </div></td>
                                        <td class="col-sm-1 col-md-1" style="text-align: center">                                    
                                        05/07/2018
                                        </td>
                                        <td class="col-sm-1 col-md-1 text-center"><strong>Casual</strong></td>
                                        <td class="col-sm-1 col-md-1 text-center"><strong>$250</strong></td>
                                        <td class="col-sm-1 col-md-1">
                                        <button type="button" class="btn btn-outline-danger">
                                            <span class="glyphicon glyphicon-remove"></span> VER VIAJE
                                        </button></td>
                                    </tr>
                                    <tr>
                                        <td class="col-sm-7 col-md-6">
                                        <div class="media">                                           
                                            <div class="media-body">
                                                <img src="Imagenes/VIAJE.png" height="20"><font size='6' color='black'> La Plata - Ensenada</font>&nbsp;<img src="Imagenes/reloj.png" height="15"><strong style="font-size: 13px"> 20min</strong><br>
                                                <img src="Imagenes/CONDUCTOR.png" height="28"><font size='4'><a href="verPefil.php?id="> Patricio Estevez</a></font><font size='2' color='green'><strong>&nbsp;&nbsp;15</strong> puntos</font><br>
                                                </div>
                                        </div></td>
                                        <td class="col-sm-1 col-md-1" style="text-align: center">                                    
                                        04/06/2018
                                        </td>
                                        <td class="col-sm-1 col-md-1 text-center"><strong>Semanal</strong></td>
                                        <td class="col-sm-1 col-md-1 text-center"><strong>$25</strong></td>
                                        <td class="col-sm-1 col-md-1">
                                        <button type="button" class="btn btn-outline-danger">
                                            <span class="glyphicon glyphicon-remove"></span> VER VIAJE
                                        </button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
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
