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
            $id = $_SESSION['id'];
            $idc = $_GET['id'];
            
            $comentario = mysqli_query($link, "SELECT Contenido,nombre,apellido FROM comentarios,usuarios where comentarios.ID=$idc and IDuser=usuarios.ID");
            $com = $comentario-> fetch_array(MYSQLI_NUM);
            
            if(isset($_POST['respondio'])){
                $respuesta=$_POST['respuesta'];
                if(!empty($respuesta)){
                    mysqli_query($link, "UPDATE comentarios SET Respuesta='$respuesta' where ID=$idc");
                    $viaje = mysqli_query($link, "SELECT IDviaje from comentarios where ID=$idc");
                    $v = $viaje->fetch_array(MYSQLI_NUM);
                    header("Location: verViaje?id=$v[0]&respondio=true");
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
                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true"><font color="#f87678">Responder comentario</font></a>  
                  </div>
                </nav>
                
                <div class="tab-content" id="nav-tabContent">
                 <br>
                 <form method="POST" action="">
                    <div class="form-group" style="margin-right: 200px">
                        <h3>Respuesta a <?php echo $com[1] . " " . $com[2] ; ?> </h3>
                        <p>"<?php echo $com[0];?>"</p> 
                        <label for="comment"><font size='5'>Respuesta:</font></label>
                        <?php if(isset($_POST['respondio'])){
                            if(empty($respuesta)){
                                ?> <br><font size="2" color="red" face="Univers-Light-Normal">Es obligatorio escribir un comentario.</font><?php 
                            }
                        }
                        ?>
                        <textarea class="form-control" rows="4" id="respuesta" name="respuesta"></textarea>
                        <br>
                    <button class="btn btn-danger btn-block" type="submit" name="respondio">
                        Responder
                    </button>
                    </div>             
                    
                 </form>
                </div>
            </div>
                           
        </div>
               
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <input type="submit" value="" />  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
            <script src="js/bootstrap.min.js"></script>
        </body>
    </html>