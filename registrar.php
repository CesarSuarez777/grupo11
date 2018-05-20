 <?php
                  require('funciones.php');
                    $link=conectarABase();
                    $errors = array();
                        if(!empty($_POST)){
                            $nombre = $_POST['nombre'];
                            $apellido = $_POST['apellidos'];
                            $email = $_POST['correo'];
                            $contrasena = $_POST['clave'];
                            $contrasena2 = $_POST['clave_confirmacion'];
                            $fecha_nacimiento = $_POST['nacimiento'];
                            $foto = $_POST['foto'];
                                            
                            if($contrasena != $contrasena2){
                               $errors[] = "Las contraseñas no coinciden";
                            }

                            $buscarUsuario = mysqli_query($link,"SELECT COUNT(email) FROM usuarios WHERE email='$email'");
                            $row = mysqli_fetch_array($buscarUsuario);
                            if ($row[0]>0){
                               $errors[] = "El email ya se encuentra registrado"; 
                            }   

                            if (calcularEdad($fecha_nacimiento)<18){
                                $errors[] = "Es menor de 18 años";
                            }                           

                            if(count($errors) == 0) {
                                   $token = md5(uniqid(mt_rand(),false));
                                   $exito = mysqli_query($link, "INSERT INTO usuarios (nombre,apellido,email,clave,fecha,foto,token)
                                   VALUES ('$nombre','$apellido', '$email', '$contrasena', '$fecha_nacimiento', '$foto', '$token');");
                                   if ($exito) {
                                    header('Location:inicio_sesion.php');
                                   } else {
                                   header('Location:index.php');
                                    }
                            } else {
                                header('Location:index.php');
                            }
                      }
        ?>