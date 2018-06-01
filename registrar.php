 <?php
                  require 'funciones.php';     
                  $nombre = $_POST['nombre'];
                  $apellido = $_POST['apellidos'];
                  $email = $_POST['correo'];
                  $contrasena = $_POST['clave'];
                  $contrasena2 = $_POST['clave_confirmacion'];
                  $fecha_nacimiento = $_POST['nacimiento'];
                  $foto = $_POST['foto'];
                  $error1=false;
                  $error2=false;
                  $error3=false;
                  $error4=true; 
                          
                                  
                  if($contrasena != $contrasena2){    
                     $error1 = true;
                  }

                  if(usuarioExiste($email)){
                     $error2 = true;
                  }

                  if (calcularEdad($fecha_nacimiento)<18){
                      $error3 =true;
                  }                           

                  if(!$error1 && !$error2 && !$error3) {
                         $link = conectarABase();
                         $token = md5(uniqid(mt_rand(),false));
                         $sql = "INSERT INTO usuarios (nombre,apellido,email,clave,fecha,foto,token)
                         VALUES ('$nombre','$apellido', '$email', '$contrasena', '$fecha_nacimiento','$foto','$token')";
                         $exito = mysqli_query($link, $sql);
                         if ($exito) {
                          $error4=false;
                         }     
                  }
?>