<?php

require('conexion.php');
$con = conectarDB();


$errores = [];

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];


    if(!$usuario){
        $errores[] = "El Usuario Es Incorrecto";
    }

    if(!$contrasena){
        $errores[] = "La Contraseña Es Incorrecta";
    }

    if(empty($errores)){
        $query = "SELECT * FROM empleados WHERE usuario_empleado = '$usuario'";
        $res = mysqli_query($con,$query);
        
        
        if($res->num_rows){

            //comprobar contraseña

            $usuarioauth = mysqli_fetch_assoc($res);
            $contrasenadb = $usuarioauth['dni_empleado'];
            $estado = $usuarioauth['activo_empleado'];

            if($contrasenadb === $contrasena && $estado == '1'){
                session_start();
                $_SESSION['login'] = true;
                $_SESSION['nombreempleado'] = $usuarioauth['usuario_empleado'];
                $_SESSION['rol'] = $usuarioauth['rol'];


                header('Location: paneladministracion.php');
                
            }

            if ($estado == '2'){
                $errores[] = "El empleado esta inactivo";

            }

            if ($contrasenadb === $contrasena && $estado == '2'){
                $errores[] = "Contraseña correcta! Pero el empleado esta inactivo";
            }

            else{
                $errores[] = "La Contraseña es Incorrecta";
            }


        }else{
            $errores[] = "El usuario no existe en la base de datos";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/logo-defensoria-png.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/header.css">
    <title>Inicia sesion</title>
</head>
<body>

<!-- header -->
<div class="contenedor">
    <div class="header">
            <img class="logodef" src="img/logos.png" alt="">
    </div>

        <h1 class="centrar-texto">INICIAR SESION</h4>
        <?php foreach($errores as $error) :?>
        <div class="alerta error">
        <?php echo $error; ?>
        </div>
        <?php endforeach; ?>



    <form action="" method="POST" class="formulario">

    <div class="campo">
    <label class="campo__label" for="usuario">Usuario:</label>
    <input class="campo__field" type="text" name="usuario" id="usuario" placeholder="Tu Usuario">
    </div>
    
    <div class="campo">
    <label class="campo__label" for="contrasena">Contraseña:</label>
    <input class="campo__field" type="password" name="contrasena" id="contrasena" placeholder="Tu Contraseña">
    </div> 


    <div class="botonlogin">
        <input class="boton boton--verde" type="submit" value="INICIAR SESION">
    </div>
    </form>
</div>
</body>
</html>