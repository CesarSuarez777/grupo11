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

            $noMostrar=false;
            
            $vehiculos = mysqli_query($link, "SELECT * FROM vehiculos where IDuser='$IDusuario'");
            $tarjetas = mysqli_query($link, "SELECT * FROM tarjetas where IDtarjeta=$IDusuario");


            $ciudades = mysqli_query($link,"SELECT * FROM ciudades ORDER BY nombre");

            $calificacionPendientes = false;
            $calificaciones = mysqli_query($link,"SELECT * FROM calificaciones where IDorigen=$IDusuario");
            $hace30 = new DateTime('-30 days');

            while($cali = $calificaciones->fetch_array(MYSQLI_NUM)){
                $fechaCal = new DateTime($cali[3]);
                if((($cali[4])==0) && ($hace30 > $fechaCal)){
                    $calificacionPendientes=true;
                }
            }

            if (isset($_POST['apreto_agregar'])){
                        $fecha = $_POST['dia'];
                        $hora = $_POST['horario'];
                        $IDOrigen = $_POST['IDorigen'];
                        $IDDestino = $_POST['IDDestino'];
                        $IDConductor = $_SESSION['id'];
                        $IDVehiculo = $_POST['IDvehiculo'];
                        $miVehiculo = mysqli_query($link, "SELECT Asientos FROM vehiculos where IDvehiculo=$IDVehiculo");
                        $miVehiculo = $miVehiculo -> fetch_array(MYSQLI_NUM);
                        $precio = $_POST['precio'];
                        $duracion = $_POST['duracion'];
                        $fechaIncorrecta=false;
                        $precioBajo=false;
                        $yaPoseeViaje=false;
                        $yaPoseeViajeDuranteFin=false;
                        $coincidenCiudades =false;
                        $fechaFinMenorInicio =false;
                       
                        
                        $hoy = new DateTime('+2 days');
                        $fechaCreada = new DateTime($fecha . $hora);
                        $fechaCreadaFinViaje = new DateTime($duracion);
                        $fechaCreada -> format('Y-m-d H:i:s');
                        $fechaCreadaFinViaje -> format('Y-m-d H:i:s');
                        
                        $viajes = mysqli_query($link, "SELECT * FROM viajes where IDconductor=$IDusuario");

                        while ($cadaViaje = $viajes->fetch_array(MYSQLI_NUM)){
                            $fechaDeViaje = new DateTime($cadaViaje[1] . $cadaViaje[2]);
                            $fechaFinViaje = new DateTime($cadaViaje[5]);
                            $fechaDeViaje -> format('Y-m-d H:i:s');
                            $fechaFinViaje -> format('Y-m-d H:i:s');
                            
                            if(($fechaCreada > $fechaDeViaje)&&($fechaCreada < $fechaFinViaje)){
                                $yaPoseeViaje=true;
                            }
                            
                            if(($fechaCreadaFinViaje >= $fechaDeViaje) && ($fechaCreadaFinViaje <= $fechaFinViaje)){
                                $yaPoseeViajeDuranteFin=true;
                            }
                            if (($fechaCreada <= $fechaDeViaje) && ($fechaCreadaFinViaje >= $fechaFinViaje)) {
                                $yaPoseeViaje=true;
                            }
                        }

                        if (!$yaPoseeViaje && !$calificacionPendientes){

                            if($IDOrigen == $IDDestino){
                                $coincidenCiudades = true;
                            }

                            if($fechaCreadaFinViaje<$fechaCreada){
                                $fechaFinMenorInicio = true;
                            }
                            

                            if($hoy > $fechaCreada){   
                                $fechaIncorrecta=true;
                            }
                            
                            if($precio <= 0){
                                $precioBajo=true;
                            }
                            
                            if(!$fechaIncorrecta && !$precioBajo && !$yaPoseeViajeDuranteFin && !$coincidenCiudades && !$fechaFinMenorInicio){
                                $pre = $precio / $miVehiculo[0];
                                $sql = "INSERT INTO `viajes` (`fecha`, `hora`, `IDvehiculo`, `IDconductor`, `llegada`, `IDOrigen`, `IDDestino`, `Precio`,asientos_disponibles) VALUES ('$fecha', '$hora', $IDVehiculo, $IDConductor, '$duracion', $IDOrigen, $IDDestino, $pre,$miVehiculo[0]);";
                            
                                if (mysqli_query($link, $sql)){
                                     header("Location: MiCuenta.php?vehiculo=true");
                                } else { 
                                  header("Location: MiCuenta.php?vehiculo=false");
                                }
                            }
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
                            <a href="MiCuenta.php" class="btn btn-outline-danger btn-block"><img src="Imagenes/Usuario.png" height="15x15"><font size="3" face="Univers-Light-Normal">    <?php echo $_SESSION['nombre']; ?></font></a><br>
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
                 <?php if (($vehiculos->num_rows)==0){
                    $noMostrar=true;
                    ?><br>
                    <h3 align="center" style="color: red">NO POSEE UN VEHICULO VINCULADO A LA CUENTA<br><font size="2" color="red" face="Univers-Light-Normal">Ir a <?php echo $_SESSION['nombre'] ?> -> Mis vehiculos -> Agregar vehiculo</font></h3><br>
                    <?php }
                    if ($calificacionPendientes){
                        $noMostrar=true;
                    ?><br>
                    <h3 align="center" style="color: red">USTED TIENE CALIFICACIONES PENDIENTES DE MAS DE 30 DIAS<br><font size="2" color="red" face="Univers-Light-Normal">Ir a Mis viajes -> Calificar </font></h3><br>
                    <?php } 
                    if (($tarjetas->num_rows)==0){
                    $noMostrar=true;
                    ?><br>
                    <h3 align="center" style="color: red">NO POSEE UNA TARJETA VINCULADA A LA CUENTA<br><font size="2" color="red" face="Univers-Light-Normal">Ir a <?php echo $_SESSION['nombre'] ?> -> Mi Tarjeta -> Agregar tarjeta</font></h3><br>
                    <?php } if (!$noMostrar) { ?>
                <font size="4" color="red" face="Univers-Light-Normal"><?php if(isset($_POST['apreto_agregar'])){if ($yaPoseeViaje) {echo "USTED TIENE UN VIAJE PENDIENTE A ESA FECHA";}else{if($yaPoseeViajeDuranteFin){echo "LA FECHA DE FIN DE VIAJE COINCIDE CON OTRO VIAJE PENDIENTE";}}} ?></font>
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
                                                <font size="2"  color="red" style="margin-left: 400px" face="Univers-Light-Normal"><?php if(isset($_POST['apreto_agregar'])){if ($coincidenCiudades) {echo "Las ciudades destino y origen no deben coincidir";}} ?></font>
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
                                                <label for="concept" class="col-sm-3 control-label">Dia</label>
                                                <font size="2"  color="red" face="Univers-Light-Normal"><?php if(isset($_POST['apreto_agregar'])){if ($fechaIncorrecta) {echo "La fecha del viaje debe superar las 48hs posteriores a su creacion";}} ?></font>
                                                <div class="col-sm-9">
                                                    <input type="date" class="form-control" name="dia" required value="<?php if (isset($_POST['apreto_agregar'])) {if (!$fechaIncorrecta) {echo $fecha;}} ?>">
                                                </div>
                                            </div>   
                                           <div class="form-group">
                                                <br>
                                                <label for="concept" class="col-sm-3 control-label">Hora</label>
                                                <div class="col-sm-9">
                                                    <input type="time" class="form-control" name="horario" required value="<?php if (isset($_POST['apreto_agregar'])) {if (!$fechaIncorrecta) {echo $hora;}} ?>">
                                                </div>
                                            </div> 
                                            <div class="form-group">
                                                <label for="amount" class="col-sm-3 control-label">Costo de viaje<font size="1">(En pesos sin simbolo)</font></label>
                                                <font size="2"  color="red" face="Univers-Light-Normal"><?php if(isset($_POST['apreto_agregar'])){if ($precioBajo) {echo "Precio invalido";}} ?></font>
                                                <div class="col-sm-9">
                                                    <input required type="text" class="form-control" name="precio" value="<?php if (isset($_POST['apreto_agregar'])) {if (!$precioBajo) {echo $precio;}} ?>">
                                                </div>
                                            </div>
                                           <div class="form-group">
                                                <label for="amount" class="col-sm-3 control-label">Fecha y horario de llegada</label>
                                                <font size="2"  color="red" face="Univers-Light-Normal"><?php if(isset($_POST['apreto_agregar'])){if ($fechaFinMenorInicio) {echo "La fecha de fin de viaje debe ser posterior a la de inicio";}} ?></font>
                                                <div class="col-sm-9">
                                                    <input required type="datetime-local" class="form-control" name="duracion" value="<?php if (isset($_POST['apreto_agregar'])) {if (!$fechaFinMenorInicio && !$fechaIncorrecta) {echo $duracion;}} ?>">
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
                                            <!--<div class="input-group mb-3" style="width: 72.5%;margin-left:14px ">
                                                <div class="input-group-prepend">
                                                  <label class="input-group-text" for="inputGroupSelect01">Tipo</label>
                                                </div>
                                                <select class="custom-select" name='tipo' id="inputGroupSelect01">
                                                  <option selected value="OC">Ocasional</option>
                                                  <option value="DI">Diario</option>
                                                  <option value="SE">Semanal</option>
                                                </select>
                                            </div> -->
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
                <?php } ?>
                <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        	<input type="submit" value="" />  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        	<script src="js/bootstrap.min.js"></script>
    	</body>
    </html>


