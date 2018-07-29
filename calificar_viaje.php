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
            $usuariocalif = mysqli_query($link, "SELECT nombre,apellido FROM calificaciones,usuarios where IDcalif=$idc AND IDdestino=ID");
            $usu = $usuariocalif -> fetch_array(MYSQLI_NUM);
            
            if (isset($_POST['apreto_like'])){
                $comentario = $_POST['comentario'];
                if (!empty($comentario)){
                    if (mysqli_query($link, "UPDATE calificaciones SET comentario='$comentario',calificacion=1 where IDcalif=$idc")){                
                        header("Location: MisViajes.php?calificado=true");exit();
                }
                    }
                    
            }else{
                if(isset($_POST['apreto_unlike'])){
                    $comentario = $_POST['comentario'];
                    if (!empty($comentario)){
                        if (mysqli_query($link, "UPDATE calificaciones SET comentario=$comentario,calificacion=-1 where IDcalif=$idc")){
                            header("Location: MisViajes.php?calificado=true");
                            exit();
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
                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true"><font color="#f87678">Calificar</font></a>  
                  </div>
                </nav>
                
                <div class="tab-content" id="nav-tabContent">
                 <br>
                 <form method="POST" action="">
                    <div class="form-group" style="margin-right: 200px">
                        <h3>Calificación a <?php echo $usu[0] . " " . $usu[1] ; ?> </h3>
                        <label for="comment"><font size='5'>Comentario:</font></label>
                        <?php if(isset($_POST['apreto_like'])||isset($_POST['apreto_unlike'])){
                            if(empty($comentario)){
                                ?> <br><font size="2" color="red" face="Univers-Light-Normal">El comentario es obligatorio.</font><?php 
                            }
                        }
                        ?>
                        <textarea class="form-control" rows="4" id="comentario" name="comentario"></textarea>
                    </div>             
                    <button class="btn btn-outline-success" type="submit" name="apreto_like">
                        <img  src="Imagenes/like.png" onclick="return confirm('¿Estás seguro?');" height="40x40" />
                    </button>
                     <button class="btn btn-outline-danger" onclick="return confirm('¿Estás seguro?');" type="submit" name="apreto_unlike">
                         <img src="Imagenes/unlinke.png" height="40x40" />
                    </button>
                 </form>
                </div>
            </div>
                           
        </div>
               
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <input type="submit" value="" />  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
            <script src="js/bootstrap.min.js"></script>
        </body>
    </html>