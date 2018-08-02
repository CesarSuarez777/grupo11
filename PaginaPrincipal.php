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
          
          $id = $_SESSION['id'];
                  
          $hoy = new DateTime('today');
          $ordenamiento=1;
          $forma='a';
          
          if (!empty($_GET['ordenar'])){
              $ordenamiento = $_GET['ordenar'];
          }
          
          if (!empty($_GET['form'])){
              $forma=$_GET['form'];
          }


          switch ($ordenamiento) {
                case 1:
                    if($forma=='d'){$viajes = mysqli_query($link,"SELECT * FROM viajes ORDER BY fecha desc,hora desc");}
                    else{$viajes = mysqli_query($link,"SELECT * FROM viajes ORDER BY fecha,hora");}
                    break;
                case 2:
                    if($forma=='d'){$viajes = mysqli_query($link,"SELECT * FROM viajes ORDER BY precio desc");}
                    else{$viajes = mysqli_query($link,"SELECT * FROM viajes ORDER BY precio");}
                    break;
                case 3:
                    if($forma=='d'){$viajes = mysqli_query($link,"SELECT * FROM viajes,ciudades where IDOrigen=IDCiudad ORDER BY nombre desc");}
                    else{$viajes = mysqli_query($link,"SELECT * FROM viajes,ciudades where IDOrigen=IDCiudad ORDER BY nombre ");}
                    break;
                case 4:
                    if($forma=='d'){$viajes = mysqli_query($link,"SELECT * FROM viajes,ciudades where IDDestino=IDCiudad ORDER BY nombre desc");}
                    else{$viajes = mysqli_query($link,"SELECT * FROM viajes,ciudades where IDDestino=IDCiudad ORDER BY nombre");}
                    break;


            }

            if(isset($_POST['filtro'])){
                $puntoMinimo=$_POST['c'];
                $precioMaximo=$_POST['precioMa'];
                $precioMinimo=$_POST['precioM'];
                $durma=$_POST['t'];
                
            }

            if(isset($_POST['apreto_ir'])){
              $des=$_POST['IDDestino'];
              $des1=$_POST['IDOrigen'];
              $des2=$_POST['fecha'];
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
            </nav>
        </header>
      <br><br><br><br><br><br>
          <div class="row">
              <div class="col-2 bg-white">
                  <div class="container-fluid">
                      <br>
                      <a href='crear_viaje.php' class="btn btn-block btn-outline-danger btn-lg"><font size='5'>Crear viaje</font></a><br>
                      <br>
                      <h3 style="color:#f87678">Ordenar por:</h3>
                      <div class="form-group">
                          <select name="forma" onchange="location = this.value;">
                          <option value="PaginaPrincipal.php?<?php if(isset($_POST['filtro'])){echo '&fil1=' . $_POST['c'] . '&fil2=' . $_POST['precioMa'] . '&fil3=' . $_POST['precioM'] . '&fil4=' . $_POST['t'];}else{if(!empty($_GET['fil1'])){echo 'fil1=' . $_GET['fil1'];}if(!empty($_GET['fil2'])){echo '&fil2=' . $_GET['fil2'];}if(!empty($_GET['fil3'])){echo '&fil3=' . $_GET['fil3'];}if(!empty($_GET['fil4'])){echo '&fil4=' . $_GET['fil4'];}} ?>&ordenar=1&form=<?php echo $forma;if(isset($_POST['apreto_ir'])){echo '&bus=' . $des . '&bus2=' . $des1 . '&bus3=' . $des2; }
                          else{if(!empty($_GET['bus'])){ echo '&bus=' . $_GET['bus'];}if(!empty($_GET['bus2'])){echo '&bus2=' . $_GET['bus2'];}if(!empty($_GET['bus3'])){echo '&bus3=' . $_GET['bus3'];}} ?>" <?php if (!empty($_GET['ordenar'])){if($_GET['ordenar']==1) {echo "selected";}} ?>>Fecha</option>
                          <option value="PaginaPrincipal.php?<?php if(isset($_POST['filtro'])){echo '&fil1=' . $_POST['c'] . '&fil2=' . $_POST['precioMa'] . '&fil3=' . $_POST['precioM'] . '&fil4=' . $_POST['t'];}else{if(!empty($_GET['fil1'])){echo 'fil1=' . $_GET['fil1'];}if(!empty($_GET['fil2'])){echo '&fil2=' . $_GET['fil2'];}if(!empty($_GET['fil3'])){echo '&fil3=' . $_GET['fil3'];}if(!empty($_GET['fil4'])){echo '&fil4=' . $_GET['fil4'];}}?>&ordenar=2&form=<?php echo $forma;if(isset($_POST['apreto_ir'])){echo '&bus=' . $des . '&bus2=' . $des1 . '&bus3=' . $des2; }
                          else{if(!empty($_GET['bus'])){ echo '&bus=' . $_GET['bus'];}if(!empty($_GET['bus2'])){echo '&bus2=' . $_GET['bus2'];}if(!empty($_GET['bus3'])){echo '&bus3=' . $_GET['bus3'];}} ?>"<?php if (!empty($_GET['ordenar'])){if($_GET['ordenar']==2) {echo "selected";}} ?> >Precio</option>
                          <option value="PaginaPrincipal.php?<?php if(isset($_POST['filtro'])){echo '&fil1=' . $_POST['c'] . '&fil2=' . $_POST['precioMa'] . '&fil3=' . $_POST['precioM'] . '&fil4=' . $_POST['t'];}else{if(!empty($_GET['fil1'])){echo 'fil1=' . $_GET['fil1'];}if(!empty($_GET['fil2'])){echo '&fil2=' . $_GET['fil2'];}if(!empty($_GET['fil3'])){echo '&fil3=' . $_GET['fil3'];}if(!empty($_GET['fil4'])){echo '&fil4=' . $_GET['fil4'];}}?>&ordenar=3&form=<?php echo $forma;if(isset($_POST['apreto_ir'])){echo '&bus=' . $des . '&bus2=' . $des1 . '&bus3=' . $des2; }
                          else{if(!empty($_GET['bus'])){ echo '&bus=' . $_GET['bus'];}if(!empty($_GET['bus2'])){echo '&bus2=' . $_GET['bus2'];}if(!empty($_GET['bus3'])){echo '&bus3=' . $_GET['bus3'];}} ?>"<?php if (!empty($_GET['ordenar'])){if($_GET['ordenar']==3) {echo "selected";}} ?> >Ciudad de origen</option>
                          <option value="PaginaPrincipal.php?<?php if(isset($_POST['filtro'])){echo '&fil1=' . $_POST['c'] . '&fil2=' . $_POST['precioMa'] . '&fil3=' . $_POST['precioM'] . '&fil4=' . $_POST['t'];}else{if(!empty($_GET['fil1'])){echo 'fil1=' . $_GET['fil1'];}if(!empty($_GET['fil2'])){echo '&fil2=' . $_GET['fil2'];}if(!empty($_GET['fil3'])){echo '&fil3=' . $_GET['fil3'];}if(!empty($_GET['fil4'])){echo '&fil4=' . $_GET['fil4'];}}?>&ordenar=4&form=<?php echo $forma;if(isset($_POST['apreto_ir'])){echo '&bus=' . $des . '&bus2=' . $des1 . '&bus3=' . $des2; }
                          else{if(!empty($_GET['bus'])){ echo '&bus=' . $_GET['bus'];}if(!empty($_GET['bus2'])){echo '&bus2=' . $_GET['bus2'];}if(!empty($_GET['bus3'])){echo '&bus3=' . $_GET['bus3'];}} ?>"<?php if (!empty($_GET['ordenar'])){if($_GET['ordenar']==4) {echo "selected";}} ?>>Ciudad de destino</option>
                        </select>   
                      </div>
                      <h3 style="color:#f87678">De forma:</h3>
                      <div class="form-group">
                        <select name="forma2" onchange="location = this.value;">
                          <<option value="PaginaPrincipal.php?<?php if(isset($_POST['filtro'])){echo '&fil1=' . $_POST['c'] . '&fil2=' . $_POST['precioMa'] . '&fil3=' . $_POST['precioM'] . '&fil4=' . $_POST['t'];}else{if(!empty($_GET['fil1'])){echo 'fil1=' . $_GET['fil1'];}if(!empty($_GET['fil2'])){echo '&fil2=' . $_GET['fil2'];}if(!empty($_GET['fil3'])){echo '&fil3=' . $_GET['fil3'];}if(!empty($_GET['fil4'])){echo '&fil4=' . $_GET['fil4'];}}?>&ordenar=<?php echo $ordenamiento;?>&form=a<?php if(isset($_POST['apreto_ir'])){echo '&bus=' . $des . '&bus2=' . $des1 . '&bus3=' . $des2; }
                          else{if(!empty($_GET['bus'])){ echo '&bus=' . $_GET['bus'];}if(!empty($_GET['bus2'])){echo '&bus2=' . $_GET['bus2'];}if(!empty($_GET['bus3'])){echo '&bus3=' . $_GET['bus3'];}} ?>" <?php if (!empty($_GET['form'])){if($_GET['form']=='a') {echo " selected";}} ?> >Ascendente</option>
                          <option value="PaginaPrincipal.php?<?php if(isset($_POST['filtro'])){echo '&fil1=' . $_POST['c'] . '&fil2=' . $_POST['precioMa'] . '&fil3=' . $_POST['precioM'] . '&fil4=' . $_POST['t'];}else{if(!empty($_GET['fil1'])){echo 'fil1=' . $_GET['fil1'];}if(!empty($_GET['fil2'])){echo '&fil2=' . $_GET['fil2'];}if(!empty($_GET['fil3'])){echo '&fil3=' . $_GET['fil3'];}if(!empty($_GET['fil4'])){echo '&fil4=' . $_GET['fil4'];}}?>&ordenar=<?php echo $ordenamiento;?>&form=d<?php if(isset($_POST['apreto_ir'])){echo '&bus=' . $des . '&bus2=' . $des1 . '&bus3=' . $des2; }
                          else{if(!empty($_GET['bus'])){ echo '&bus=' . $_GET['bus'];}if(!empty($_GET['bus2'])){echo '&bus2=' . $_GET['bus2'];}if(!empty($_GET['bus3'])){echo '&bus3=' . $_GET['bus3'];}} ?>"<?php if (!empty($_GET['form'])){if($_GET['form']=='d') {echo " selected";}} ?> >Descendente</option>
                        </select>   
                      </div>
                      <h3 style="color:#f87678">Filtrar por:</h3>
                      <div class="containerfluid">
                        <form action="PaginaPrincipal.php?ordenar=<?php echo $ordenamiento;?>&form=<?php echo $forma; if(isset($_POST['apreto_ir'])){echo '&bus=' . $des . '&bus2=' . $des1 . '&bus3=' . $des2; }
                          else{if(!empty($_GET['bus'])){ echo '&bus=' . $_GET['bus'];}if(!empty($_GET['bus2'])){echo '&bus2=' . $_GET['bus2'];}if(!empty($_GET['bus3'])){echo '&bus3=' . $_GET['bus3'];}} ?>" method="POST" accept-charset="utf-8">
                        <strong>Precios</strong>
                        <div class="input-group">
                          <input style="width:45%" type="number" step="0.01" class="form-control" id="precioM" value="<?php if(isset($_POST['filtro'])){echo $precioMinimo;}else{if(!empty($_GET['fil3'])){echo $_GET['fil3'];}}?>" name="precioM" aria-describedby="emailHelp" placeholder="Minimo">
                          <span>  -  </span>
                          <input style="width:45%" type="number" step="0.01" class="form-control" id="precioMa" value="<?php if(isset($_POST['filtro'])){echo $precioMaximo;}else{if(!empty($_GET['fil2'])){echo $_GET['fil2'];}}?>" name="precioMa" placeholder="Maximo">
                          <input style="width:98%;margin-bottom: 10px;margin-top:10px; " type="number" class="form-control" value="<?php if(isset($_POST['filtro'])){echo $durma;}else{if(!empty($_GET['fil4'])){echo $_GET['fil4'];}}?>" id="t" name="t" aria-describedby="emailHelp" placeholder="Duración máxima en hs">
                          <input style="width:98%;margin-bottom: 10px" type="number" class="form-control" value="<?php if(isset($_POST['filtro'])){echo $puntoMinimo;}else{if(!empty($_GET['fil1'])){echo $_GET['fil1'];}}?>" id="c" name="c" aria-describedby="emailHelp" placeholder="Calificacion mínima">
                          <input style="width:98%;margin-bottom: 10px" class="btn btn-outline-danger" value="Filtrar" type="submit" id="filtro" name="filtro" aria-describedby="emailHelp" placeholder="Calificacion mínima">
                        </div>
                        </form>             
                      </div>
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
                                    $fecha1 = new DateTime("$row[1] . $row[2]");
                                    $fecha2 = new DateTime($row[5]);
                                    $diferencia = $fecha2->diff($fecha1);$agregar=0;
                                    if($diferencia->d>0){
                                      $agregar=$diferencia->d*24;
                                    }

                                    $horas=$diferencia->h+$agregar;

                                    while($cal = $calificaciones->fetch_array(MYSQLI_NUM)){
                                        $puntos=$puntos+$cal[0];
                                    }
                                    $puntos = $puntos - $conductor[9];
                                    $mostrar = true;
                                    if(isset($_POST['filtro'])){

                                      if(!empty($puntoMinimo)){
                                        if($puntoMinimo>$puntos){
                                           $mostrar=False;
                                        }
                                      }

                                      if(!empty($precioMaximo)){
                                        if($precioMaximo<$row[8]){
                                           $mostrar=False;
                                        }
                                      }

                                      if(!empty($precioMinimo)){
                                        if($precioMinimo>$row[8]){
                                           $mostrar=False;
                                        }
                                      }

                                      if(!empty($durma)){
                                        if($durma<=$horas){
                                           $mostrar=False;
                                        }
                                      }
                                    }

                                    if (isset($_POST['apreto_ir'])){
                                      if(!empty($_POST['fecha'])){
                                        $fechaQ = $_POST['fecha'];
                                          if($fechaQ != $row[1]){
                                            $mostrar=false;
                                          }
                                      }
                                      if(!empty($_POST['IDDestino'])){
                                        $destiny1 = $_POST['IDDestino'];
                                          if($destiny1 != $row[7]){
                                            $mostrar=false;
                                          }
                                      }
                                      if(!empty($_POST['IDOrigen'])){
                                        $destiny2 = $_POST['IDOrigen'];
                                          if($destiny2 != $row[6]){
                                            $mostrar=false;
                                          }
                                      }

                                    }

                                    if(!empty($_GET['bus'])){
                                      $dest=$_GET['bus'];
                                      if($dest != $row[7]){
                                        $mostrar=False;
                                      }
                                    }

                                    if(!empty($_GET['bus2'])){
                                      $dest1=$_GET['bus2'];
                                      if($dest1 != $row[6]){
                                        $mostrar=False;
                                      }
                                    }

                                    if(!empty($_GET['bus3'])){
                                      $dest2=$_GET['bus3'];
                                      if($dest2 != $row[1]){
                                        $mostrar=False;
                                      }
                                    }
     
                                    if(!empty($_GET['fil2'])){
                                      if($_GET['fil2']<$row[8]){
                                         $mostrar=False;
                                      }
                                    }

                                   if(!empty($_GET['fil1'])){
                                      if($_GET['fil1']>$puntos){
                                         $mostrar=False;
                                      }
                                    }

                                    if(!empty($_GET['fil3'])){
                                      if($_GET['fil3']>$row[8]){
                                         $mostrar=False;
                                      }
                                    }

                                    if(!empty($_GET['fil4'])){
                                      if($_GET['fil4']<=$horas){
                                         $mostrar=False;
                                      }
                                    }
                                  

                                    if($mostrar){
                                    ?>
                                    <tr style="background-color: <?php if ($row[4]==$id) { echo "#ffffd9";} ?> ">
                                        <td>
                                        <div class="media">                                           
                                            <div class="media-body">
                                                <img src="Imagenes/VIAJE.png" height="20"><font size='5' color='black'> <?php echo"$origen[0] - $destino[0]" ?></font>&nbsp;<img src="Imagenes/reloj.png" height="15"><strong style="font-size: 13px"> <?php if($horas != 0 ){echo $horas; if($horas==1){echo " hora";} else { echo " horas";}} if(($diferencia->i)!=0){echo" $diferencia->i minutos";}?></strong><br>
                                                <img src="Imagenes/CONDUCTOR.png" height="28"><font size='4'><a href="verPerfil.php?id=<?php echo $conductor[7]?>"> <?php echo "$conductor[0] $conductor[1]"?></a></font><font size='2' color='<?php if ($puntos>=0){echo "green";}else{echo "red";}?>'><strong color='<?php if($puntos>=0){echo "green";}else{echo "red";} ?>'>&nbsp;&nbsp;<?php echo $puntos?></strong> puntos</font><br>  
                                            </div>
                                        </div> </td>
                                        <td style="text-align: center">                                    
                                        <?php $fechaS = new DateTime($row[1]); echo $fechaS->format('d-m-Y');?>
                                        </td>
                                        <td style="text-align: center"><strong><?php echo '$' . round($row[8],2);?></strong></td>
                                        <td>
                                            <a class="btn btn-outline-danger" href="verViaje.php?id=<?php echo $row[0];?>">
                                             VER VIAJE
                                        </a></td>
                                    </tr>
                                    <?php }}}?>
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
