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
            
            $idtarjeta= $_GET['id'];
            
            $tarjeta = mysqli_query($link, "SELECT * FROM tarjetas where IDtarjeta='$idtarjeta'");
            $tar = $tarjeta->fetch_array(MYSQLI_NUM);
            
                    if (isset($_POST['apreto_editarT'])){
                        $nuevaMarca = $_POST['marca'];
                        $nuevoNumero = $_POST['numero'];
                        $nuevaFecha = $_POST['fecha_vencimiento'];
                        $fech = new DateTime("$nuevaFecha-01");
                        $result = $fech -> format('Y-m-d');
                        $formatoInvalido = false;
                        $tarjetaVencida = false;

                        $hoy= new DateTime('today');

                        if($hoy > $fech){
                            $tarjetaVencida=true;
                        }

                        if($nuevaMarca=="American Express"){
                            $regex = '/^\d{15}$/';
                            if(!preg_match($regex,$nuevoNumero)){
                                $formatoInvalido=true;
                            }
                        }else{
                          $regex = '/^\d{16}$/';
                            if(!preg_match($regex,$nuevoNumero)){
                                $formatoInvalido=true;
                            }  
                        }
                        
                        if(!$formatoInvalido && !$tarjetaVencida){
                            if($nuevaMarca != $tar[0]){
                                mysqli_query($link, "UPDATE tarjeta SET marca='$nuevaMarca' where IDtarjeta='$idtarjeta'");
                            }
                            
                            if($nuevoNumero != $tar[1]){
                                mysqli_query($link, "UPDATE tarjetas SET numero=$nuevoNumero where IDtarjeta='$idtarjeta'");
                            }
                            
                            if($nuevaFecha != $tar[2]){
                                mysqli_query($link, "UPDATE tarjetas SET fecha_vencimiento='$result' where IDtarjeta='$idtarjeta'");
                            }

                            header('Location: MiCuenta.php?tEditada=true');
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
				    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true"><font color="#f87678">Editar tarjeta</font></a>  
				  </div>
				</nav>
				<div class="tab-content" id="nav-tabContent">
				  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                      <div class="panel panel-default">
                                        <form id="modificar" method="POST">
                                            <br>
                                          <div class="panel-body form-horizontal payment-form">
                                            <div class="input-group mb-3" style="width: 72.5%;margin-left:12px ">
                                                <div class="input-group-prepend">
                                                  <label class="input-group-text" for="inputGroupSelect01">Marca</label>
                                                </div>
                                                <select class="custom-select" name='marca' id="inputGroupSelect01">
                                                  <option selected value="Visa">Visa</option>
                                                  <option value="Mastercard">Mastercard</option>
                                                  <option value="American Express">American Express</option>
                                                </select>
                                            </div>
                                         <div class="form-group">
                                                <label for="description" class="col-sm-3 control-label">Numero</label>
                                                <font size="2" color="red" face="Univers-Light-Normal"><?php if(isset($_POST['apreto_editarT'])){if ($formatoInvalido) {echo "El nuevo numero es invalido para una tarjeta $nuevaMarca";}} ?> </font> 
                                                <div class="col-sm-9">
                                                    <input type="number" value="<?php if(isset($_POST['apreto_editarT'])){ if(!$formatoInvalido){echo $nuevoNumero;}else{echo $tar[0];}} else{ echo $tar[0];} ?>" class="form-control" name="numero" required>
                                                </div>
                                            </div> 
                                            <div class="form-group">
                                                <label for="amount" class="col-sm-3 control-label">Fecha de vencimiento</label>
                                                <font size="2" color="red" face="Univers-Light-Normal"><?php if(isset($_POST['apreto_editarT'])){if ($tarjetaVencida) {echo "La tarjeta se encuentra vencida con la nueva fecha ingresada";}} ?> </font> 
                                                <div class="col-sm-9">
                                                    <input required type="month" value="<?php $f= new DateTime("$tar[2]"); $f = $f -> format('Y-m'); if(isset($_POST['apreto_editarT'])){ if(!$tarjetaVencida){echo $nuevaFecha;}else{echo $f;}} else{ echo $f;}?>" class="form-control" name="fecha_vencimiento">
                                                </div>
                                            </div> 
                                            <br>
                                            <div class="form-group">
                                                <div class="col-sm-12 text-left">
                                                    <a class="btn btn-outline-danger btn-lg" href="MiCuenta.php" role="button">Volver</a>
                                                    <input type="submit" name="apreto_editarT" class="btn btn-outline-danger preview-add-button btn-lg" value="Editar" style="margin-left: 10px" onclick="return confirm('¿Estás seguro?');">                       
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
