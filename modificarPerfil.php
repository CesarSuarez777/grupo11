
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
            $resultado = mysqli_query($link, "SELECT * FROM usuarios where email='$email'");
            $row = $resultado->fetch_array(MYSQLI_ASSOC);        
                
                    if (isset($_POST['apreto_modificar'])){
                        $nuevoNombre = $_POST['nuevoNombre'];
                        $nuevoApellido = $_POST['nuevoApellido'];
                        $nuevoEmail = $_POST['nuevoEmail'];
                        $nuevaFecha = $_POST['nuevaFecha'];
                        $nuevaFoto = $_POST['nuevaFoto']; 
                        $existeUsuario= false;
                        
                     
                        if ($nuevoApellido != $row['apellido']){
                            mysqli_query($link, "UPDATE usuarios SET apellido='$nuevoApellido' where email='$email'");
                        }
                        
                        if ($nuevoNombre != $row['nombre']){
                            mysqli_query($link, "UPDATE usuarios SET nombre='$nuevoNombre' where email='$email'");
                        }
                        
                        if ($nuevaFecha != $row['fecha']){
                            if (calcularEdad($nuevaFecha)>=18){
                                mysqli_query($link, "UPDATE usuarios SET fech}a='$nuevaFecha' where email='$email'");
                            }else{
                                header('Location: modificarPerfil.php?menor=true');
                                exit;
                            }
                        }
                                  
                        if ($nuevoEmail != $row['email']){
                            if (!usuarioExiste($nuevoEmail)){
                                mysqli_query($link, "UPDATE usuarios SET email='$nuevoEmail' where email='$email'");
                                $_SESSION['email']=$nuevoEmail;
                            } else {
                                header('Location: modificarPerfil.php?mailError=true');
                                exit;
                            }
                        }
                        
                        header("Location: MiCuenta.php");
                        exit;
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
				    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true"><font color="#f87678">Modificar perfil</font></a>  
				  </div>
				</nav>
				<div class="tab-content" id="nav-tabContent">
				  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                      <div class="panel panel-default">
                                        <form id="modificar" method="POST">
                                          <div class="panel-body form-horizontal payment-form">
                                            <div class="form-group">
                                                <br>
                                                <label for="concept" class="col-sm-3 control-label">Nombres</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="concept" value="<?php echo $row['nombre']; ?>" name="nuevoNombre">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="description" class="col-sm-3 control-label">Apellidos</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" value="<?php echo $row['apellido']; ?>" id="description" name="nuevoApellido">
                                                </div>
                                            </div> 
                                            <div class="form-group">
                                                <label for="amount" class="col-sm-3 control-label">Email</label>
                                                <?php if(!empty($_GET['mailError'])){
                                                    ?>
                                                <font color="red" size="2">El email ya se encuentra registrado, intente otro.</font>
                                                <?php
                                                }
                                                    ?>
                                                <div class="col-sm-9">
                                                    <input required type="email" class="form-control" value="<?php echo $row['email']; ?>" id="amount" name="nuevoEmail">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="date" class="col-sm-3 control-label">Fecha de nacimiento</label>
                                                <?php if(!empty($_GET['menor'])){
                                                    ?>
                                                <font color="red" size="2">Debe ser mayor de edad para utilizar el sistema.</font>
                                                <?php
                                                }
                                                    ?>
                                                <div class="col-sm-9">
                                                    <input type="date" class="form-control" value="<?php echo $row['fecha']; ?>" id="date" name="nuevaFecha">
                                                </div>
                                            </div>   
                                            <div class="form-group">
                                                <label for="date" class="col-sm-3 control-label">Foto de perfil</label>
                                                <div class="col-sm-9">
                                                    <input type="file" class="form-control" value="<?php echo $row['foto']; ?>" id="date" name="nuevaFoto">
                                                </div>
                                            </div>
                                              <br>
                                            <div class="form-group">
                                                <div class="col-sm-12 text-left">
                                                    <a class="btn btn-outline-danger btn-lg" href="MiCuenta.php" role="button">Volver</a>
                                                    <input type="submit" name="apreto_modificar" class="btn btn-outline-danger preview-add-button btn-lg" value="Modificar" style="margin-left: 10px">                       
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
