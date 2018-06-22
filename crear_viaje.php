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
            $IDusuario=$_SESSION['id'];
            $link=conectarABase();
            $resultado = mysqli_query($link, "SELECT * FROM usuarios where email='$email'");
            $row = $resultado->fetch_array(MYSQLI_ASSOC);
            
            $vehiculos = mysqli_query($link, "SELECT * FROM vehiculos where IDuser='$IDusuario'");
            $ciudades = mysqli_query($link,"SELECT * FROM ciudades");
            
            if (isset($_POST['apreto_agregar'])){
                        $fecha = $_POST['horario'];
                        $IDOrigen = $_POST['IDorigen'];
                        $IDDestino = $_POST['IDDestino'];
                        $IDConductor = $_SESSION['id'];
                        $tipo = $_POST['tipo'];
                        $IDVehiculo = $_POST['IDvehiculo'];
                        $precio = $_POST['precio'];
                        $duracion = $_POST['duracion'];
                                                                
                     
                        $sql = "INSERT INTO viajes(fecha,IDVehiculo,tipo,IDConductor,Duracion,IDOrigen,IDDestino,Precio) VALUES('$fecha',$IDVehiculo,'$tipo',$IDConductor,$duracion,$IDOrigen,$IDDestino,$precio)";
                        
                        if (mysqli_query($link, $sql)){
                            header("Location: MiCuenta.php?vehiculo=true");
                        } else { 
                            header("Location: MiCuenta.php?vehiculo=false");
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
				<nav>
				  <div class="nav nav-tabs" id="nav-tab" role="tablist">
				    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true"><font color="#f87678">Crear viaje</font></a>  
				  </div>
				</nav>
				<div class="tab-content" id="nav-tabContent">
				  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                      <div class="panel panel-default">
                                        <form id="modificar" method="POST">
                                            <br>
                                          <div class="panel-body form-horizontal payment-form"> 
                                            <div class="form-group">
                                                <div class="input-group mb-3" style="width: 72.8%;margin-left:14px ">
                                                <div class="input-group-prepend">
                                                  <label class="input-group-text" for="inputGroupSelect01">Origen</label>
                                                </div>
                                                <select class="custom-select" placeholder='vehiculo' name='IDorigen' id="inputGroupSelect01">
                                                  <?php while($fila1 = $ciudades->fetch_array(MYSQL_NUM)){?>
                                                    <option value="<?php echo $fila1[1]?>"><?php echo $fila1[0] ?></option>
                                                  <?php }?>
                                                </select>
                                                </div>
                                            </div>
                                              <br>
                                            <div class="form-group">
                                                <div class="input-group mb-3" style="width: 72.8%;margin-left:14px ">
                                                <div class="input-group-prepend">
                                                  <label class="input-group-text" for="inputGroupSelect01">Destino</label>
                                                </div>
                                                <select class="custom-select" placeholder='vehiculo' name='IDDestino' id="inputGroupSelect01">
                                                  <?php mysqli_data_seek($ciudades,0);while($fila3 = $ciudades->fetch_array(MYSQL_NUM)){?>
                                                    <option value="<?php echo $fila3[1]?>"><?php echo $fila3[0] ?></option>
                                                  <?php }?>
                                                </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <br>
                                                <label for="concept" class="col-sm-3 control-label">Dia y horario</label>
                                                <div class="col-sm-9">
                                                    <input type="datetime-local" class="form-control" name="horario" required>
                                                </div>
                                            </div>                
                                            <div class="form-group">
                                                <label for="amount" class="col-sm-3 control-label">Precio por asiento <font size="1">(En pesos sin simbolo)</font></label>
                                                <div class="col-sm-9">
                                                    <input required type="text" class="form-control" name="precio">
                                                </div>
                                            </div>
                                           <div class="form-group">
                                                <label for="amount" class="col-sm-3 control-label">Duracion</label>
                                                <div class="col-sm-9">
                                                    <input required type="time" class="form-control" name="duracion">
                                                </div>
                                            </div>
                                              <br>
                                            <div class="form-group">
                                                <div class="input-group mb-3" style="width: 72.8%;margin-left:14px ">
                                                <div class="input-group-prepend">
                                                  <label class="input-group-text" for="inputGroupSelect01">Vehiculo</label>
                                                </div>
                                                <select class="custom-select" placeholder='vehiculo' name='IDvehiculo' id="inputGroupSelect01">
                                                  <?php while($fila = $vehiculos->fetch_array(MYSQL_NUM)){?>
                                                    <option value="<?php echo $fila[4]?>"><?php echo $fila[0] . ' ' . $fila[1] . ' ' . $fila[2]?></option>
                                                  <?php }?>
                                                </select>
                                                </div>
                                            </div>   
                                              <br>
                                            <div class="input-group mb-3" style="width: 72.5%;margin-left:14px ">
                                                <div class="input-group-prepend">
                                                  <label class="input-group-text" for="inputGroupSelect01">Tipo</label>
                                                </div>
                                                <select class="custom-select" name='tipo' id="inputGroupSelect01">
                                                  <option selected value="OC">Ocasional</option>
                                                  <option value="DI">Diario</option>
                                                  <option value="SE">Semanal</option>
                                                </select>
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <div class="col-sm-12 text-left">
                                                    <a class="btn btn-outline-danger btn-lg" href="PaginaPrincipal.php" role="button">Volver</a>
                                                    <input type="submit" name="apreto_agregar" class="btn btn-outline-danger preview-add-button btn-lg" value="Agregar" style="margin-left: 10px">                       
                                                 </div>
                                            </div>
                                         </div>
                                       </form>
                                    </div>
				</div>
                            </div>
                        </div>
               
                <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        	<input type="submit" value="" />  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        	<script src="js/bootstrap.min.js"></script>
    	</body>
    </html>


