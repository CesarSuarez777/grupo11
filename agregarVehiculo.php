
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
            $id = $_SESSION['id'];
            $link=conectarABase();
            $resultado = mysqli_query($link, "SELECT * FROM usuarios where email='$email'");
            $vehiculos = mysqli_query($link, "SELECT * FROM vehiculos where IDuser=$id");

            $row = $resultado->fetch_array(MYSQLI_ASSOC);        
                
                    if (isset($_POST['apreto_agregar'])){
                        $marca = $_POST['marca'];
                        $modelo = $_POST['modelo'];
                        $patente = $_POST['patente'];
                        $patente = strtoupper($patente);
                        $asientos = $_POST['asientos'];
                        $IDusuario = $row['ID'];
                        $formatoInvalido = false;
                        $patenteRegistrada = false;
                        $errorAsientos =false;

                        $regex = '/^[a-zA-Z]{3}\d{3}$/';
                        if(!preg_match($regex,$patente)){
                            $formatoInvalido=true;
                        } else{
                            while ($filaVe = $vehiculos -> fetch_array(MYSQLI_NUM)){
                                if($patente == $filaVe[2]){
                                    $patenteRegistrada=true;
                                }
                            }
                        }

                        if ($asientos <= 0){
                            $errorAsientos =true;
                        }
                     
                        if (!$patenteRegistrada && !$errorAsientos && !$formatoInvalido){
                            $sql = "INSERT INTO vehiculos(marca,modelo,patente,asientos,IDuser) VALUES('$marca','$modelo','$patente',$asientos,$IDusuario)";
                            
                            if (mysqli_query($link, $sql)){
                                header("Location: MiCuenta.php?vehiculo=true");
                            } else { 
                                header("Location: MiCuenta.php?vehiculo=false");
                            }
                        }
                    }
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
		<div class="row">
			<div class="col-2">
			</div>
			<div class="col-10">
				<nav>
				  <div class="nav nav-tabs" id="nav-tab" role="tablist">
				    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true"><font color="#f87678">Agregar vehículo</font></a>  
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
                                                    <input type="text" class="form-control" name="marca" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="description" class="col-sm-3 control-label">Modelo</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="modelo" required>
                                                </div>
                                            </div> 
                                            <div class="form-group">
                                                <label for="amount" class="col-sm-3 control-label">Patente (sin espacios)</label>
                                                <font size="2" color="red" face="Univers-Light-Normal"><?php if(isset($_POST['apreto_agregar'])){if($formatoInvalido){ echo "El formato de la patente es invalido";} else {if ($patenteRegistrada) {echo "Ya posee un vehiculo registrado con la patente ingresada";}}} ?> </font>
                                                <div class="col-sm-9">
                                                    <input required type="text" class="form-control" name="patente">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="text" class="col-sm-3 control-label">Asientos (sin incluir el del conductor)</label>
                                                <font size="2" color="red" face="Univers-Light-Normal"><?php if(isset($_POST['apreto_agregar'])){if ($errorAsientos) {echo "Su vehiculo debe poseer al menos un asiento para acompañante";}} ?> </font> 
                                                <div class="col-sm-9">
                                                    <input type="number" class="form-control" name="asientos" required>
                                                </div>
                                            </div>   
                                            <br>
                                            <div class="form-group">
                                                <div class="col-sm-12 text-left">
                                                    <a class="btn btn-outline-danger btn-lg" href="MiCuenta.php" role="button">Volver</a>
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
