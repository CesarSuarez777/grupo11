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
                exit;
            }
            
            $email=$_SESSION['email'];
            $link=conectarABase();
            
            $idvehiculo= $_GET['id'];
            $vehiculo = mysqli_query($link, "SELECT * FROM vehiculos where IDvehiculo='$idvehiculo'");
            $vehiculos =mysqli_query($link, "SELECT * FROM vehiculos where IDvehiculo='$idvehiculo'");
            $veh = $vehiculo->fetch_array(MYSQLI_NUM);
            $viajes = mysqli_query($link, "SELECT * FROM viajes where IDvehiculo='$idvehiculo'");
                    if (isset($_POST['apreto_editar'])){
                        $nuevaMarca = $_POST['marca'];
                        $nuevoModelo = $_POST['modelo'];
                        $nuevaPatente = $_POST['patente'];
                        $nuevoAsientos = $_POST['asientos'];
                        $formatoInvalido = false;
                        $patenteRegistrada = false;
                        $errorAsientos =false;

                        if($nuevaPatente != $veh[2]){
                            $regex = '/^[a-zA-Z]{3}\d{3}$/';
                            if(!preg_match($regex,$nuevaPatente)){
                                $formatoInvalido=true;
                            } else{
                                while ($filaV = $vehiculos -> fetch_array(MYSQLI_NUM)){
                                    if($nuevaPatente == $filaV[2]){
                                        $patenteRegistrada=true;
                                    }
                                }
                            }
                        }

                        if($nuevoAsientos != $veh[3]){
                            if ($nuevoAsientos <= 0){
                                $errorAsientos =true;
                           }
                        }

                        if (!$formatoInvalido && !$patenteRegistrada && !$errorAsientos){
                            if($nuevaMarca != $veh[0]){
                                mysqli_query($link, "UPDATE vehiculos SET marca='$nuevaMarca' where IDvehiculo='$idvehiculo'");
                            }
                            
                            if($nuevaModelo != $veh[1]){
                                mysqli_query($link, "UPDATE vehiculos SET modelo='$nuevoModelo' where IDvehiculo='$idvehiculo'");
                            }
                            
                            if($nuevaPatente != $veh[2]){
                                mysqli_query($link, "UPDATE vehiculos SET patente='$nuevaPatente' where IDvehiculo='$idvehiculo'");
                            }
                            
                            if($nuevoAsientos != $veh[3]){
                                mysqli_query($link, "UPDATE vehiculos SET asientos='$nuevoAsientos' where IDvehiculo='$idvehiculo'");
                            }
                            
                            header('Location: MiCuenta.php?vEditado=true');
                        }
                
                    }
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
                            <a href="MiCuenta.php" class="btn btn-outline-danger btn-block"><img src="Imagenes/Usuario.png" height="15x15"><font size="3" face="Univers-Light-Normal">     Mi cuenta</font></a><br>
                            <a href="MisViajes.php" class="btn btn-outline-danger btn-block"><img src="Imagenes/MisViajes.png" height="17x17"><font size="3" face="Univers-Light-Normal">     Mis viajes</font></a>
                        </div>     
                    </div>
                 </ul>
            </nav>        
        </header>
        <div class="row">
            <div class="col-2">
            </div>
            <div class="col-10">
                <?php if(($viajes -> num_rows)==0){ ?>
                <nav>
                  <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true"><font color="#f87678">Editar vehículo</font></a>  
                  </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                      <div class="panel panel-default">
                                        <form id="modificar" method="POST">
                                          <div class="panel-body form-horizontal payment-form">
                                            <div class="form-group">
                                                <br>
                                                <label for="concept" class="col-sm-3 control-label">Marca</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" value="<?php if(isset($_POST['apreto_editar'])){echo $nuevaMarca;}else{ echo $veh[0];}?>" name="marca" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="description" class="col-sm-3 control-label">Modelo</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" value="<?php if(isset($_POST['apreto_editar'])){echo $nuevoModelo;}else{ echo $veh[1];}?>" name="modelo" required>
                                                </div>
                                            </div> 
                                            <div class="form-group">
                                                <label for="amount" class="col-sm-3 control-label">Patente (sin espacios)</label>
                                                <font size="2" color="red" face="Univers-Light-Normal"><?php if(isset($_POST['apreto_editar'])){if($formatoInvalido){ echo "El formato de la patente es invalido";} else {if ($patenteRegistrada) {echo "Ya posee un vehiculo registrado con la patente ingresada";}}} ?> </font>
                                                <div class="col-sm-9">
                                                    <input required type="text" value="<?php if(isset($_POST['apreto_editar'])){if((!$patenteRegistrada) && (!$formatoInvalido)){echo $nuevaPatente;}else{ echo $veh[2];}}else{ echo $veh[2];}?>" class="form-control" name="patente">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="text" class="col-sm-3 control-label">Asientos (sin incluir el del conductor)</label> 
                                                <font size="2" color="red" face="Univers-Light-Normal"><?php if(isset($_POST['apreto_editar'])){if ($errorAsientos) {echo "Su vehiculo debe poseer al menos un asiento para acompañante";}} ?> </font> 
                                                <div class="col-sm-9">
                                                    <input type="number" class="form-control" value="<?php if(isset($_POST['apreto_editar'])){if(!$errorAsientos){echo $nuevoAsientos;}else{ echo $veh[3];}}else{ echo $veh[3];}?>" name="asientos" required>
                                                </div>
                                            </div>   
                                            <br>
                                            <div class="form-group">
                                                <div class="col-sm-12 text-left">
                                                    <a class="btn btn-outline-danger btn-lg" href="MiCuenta.php" role="button">Volver</a>
                                                    <input type="submit" name="apreto_editar" class="btn btn-outline-danger preview-add-button btn-lg" value="Editar" style="margin-left: 10px" onclick="return confirm('¿Estás seguro?');">                       
                                                 </div>
                                            </div>
                                         </div>
                                       </form>
                                    </div>
                                </div>
                            </div>
                            <?php  }else{ ?>
                                <h3 align="center" style="color: red">El vehiculo que desea editar tiene viajes asociados.</h3>
                            <?php } ?>
                        </div>
                    </div>
               
                <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <input type="submit" value="" />  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
            <script src="js/bootstrap.min.js"></script>
        </body>
    </html>