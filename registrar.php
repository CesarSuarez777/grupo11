 <?php
                  require 'connect_db.php';
                    $errors = array();
                    
                    if(!empty($_POST)){
                        $nombre = $_POST['nombre'];
                        $apellido = $_POST['apellidos'];
                        $email = $_POST['correo'];
                        $contraseña = $_POST['clave'];
                        $contraseña2 = $_POST['clave_confirmacion'];
                        $fecha_nacimiento = $_POST['nacimiento'];
                        $foto = $_POST['foto'];
                        
                        if($contraseña != $contraseña2){
                            $errors[] = "Las contraseñas no coinciden";
                        }
                        
                        if (mysqli_query($link, "SELECT nombre FROM usuarios where nombre='$nombre'>0")){
                           $errors[] = "El email ya se encuentra registrado"; 
                        }    
                        
                        if(count($errors) == 0) {
                           $token = md5(uniqid(mt_rand(),false));
                           mysqli_query($link, "INSERT INTO usuarios VALUES('$nombre', '$apellido')");
                        }
                    }
            ?>