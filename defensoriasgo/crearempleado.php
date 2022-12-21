<?php 
session_start();


$auth = $_SESSION['login'] ?? false;
$nombreempleado = $_SESSION['nombreempleado'];
$rol = $_SESSION['rol'];

if(!$auth || $_SESSION['rol'] === "empleado" || $_SESSION['rol'] === "alerta temprana" ){
    header('Location: login.php');
}

// conexion
require('conexion.php');
$con = conectarDB();
$errores = [];


// roles

$consulta5 = "SELECT * FROM roles;";
$consulta6 = mysqli_query($con,$consulta5); 

//estados
$consulta7 = "SELECT * FROM estados;";
$consulta8 = mysqli_query($con,$consulta7); 



date_default_timezone_set("America/Argentina/Buenos_Aires");

$fecha = date('Y/m/d');
$hora = date('H:i:s');

//valores previos de la db
$nombre = "";
$apellido = "";
$usuario = "";
$dni = "";
$activo = "";
$telefono = "";
$rol = "";



if($_SERVER['REQUEST_METHOD']  === 'POST'){
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $usuario = $_POST['usuario'];
    $dni = $_POST['dni'];
    $activo = $_POST['activo'];
    $telefono = $_POST['telefono'];
    $rol = $_POST['rol'];


    //validaciones

    
    if($nombre == ""){
        $errores[] = 'El Nombre es obligatorio';
    }

    if($apellido == ""){
        $errores[] = 'El Apellido es obligatorio';
    }

    if($usuario == ""){
        $errores[] = 'El Usuario es obligatorio';
    }

    if($dni == ""){
        $errores[] = 'El Dni es obligatorio';
    }

    if($activo == ""){
        $errores[] = 'El estado es obligatorio';
    }
    
    if($telefono == ""){
        $errores[] = 'El Telefono es obligatorio';
    }

    if($rol == ""){
        $errores[] = 'El Rol es obligatorio';
    }

     

    //base de datos

    if(empty($errores)){


        $query = "INSERT INTO empleados (nombre_empleado,apellido_empleado,usuario_empleado,dni_empleado,activo_empleado,telefono_empleado,rol) VALUES ('$nombre','$apellido','$usuario','$dni','$activo','$telefono','$rol')";
        $resultado = mysqli_query($con,$query);
        
        
        if($resultado){
            header('Location: panelempleados.php?resultado=1');
        }
    }   
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/logo-defensoria-png.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/header.css">
    <title>Mediciones</title>
</head>
<body>
    <!-- header -->
    <div class="contenedor">


    <div class="header">
    <img class="logodef" src="img/logos.png" alt="">
    </div>

<!-- navegacion  -->

<nav class="barra">
    <div class="tarjetas">
        <div class="tarjeta">
            <img class="logoimagen"  src="img/menu2.png" alt="" srcset="">
            <a class="navegacion__enlace" href="paneladministracion.php">Menu Principal</a>
        </div>

        <div class="tarjeta">
            <img class="logoimagen" src="img/nuevo.png" alt="" srcset="">
            <a class="navegacion__enlace" href="crearmedicion.php">Crear Medicion</a>
        </div>

        <div class="tarjeta">
            <img class="logoimagen" src="img/busqueda.png" alt="" srcset="">
            <a class="navegacion__enlace" href="buscarmediciones.php">Buscar por Fecha</a>
        </div>
       
        <div class="tarjeta">
            <img class="logoimagen" src="img/medicion.png" alt="" srcset="">
            <a class="navegacion__enlace" href="mismediciones.php" class="">ver mis mediciones</a>
        </div>
        
        <div class="tarjeta">
            <img class="logoimagen" src="img/tierra.png" alt="" srcset="">
            <a class="navegacion__enlace" href="todaslasmediciones.php">Todas las mediciones</a>
        </div>

        <?php if($_SESSION['rol'] == 'administrador'):?>
        <div class="tarjeta">
            <img class="logoimagen" src="img/empleados.png" alt="" srcset="">
            <a class="navegacion__enlace" href="panelempleados.php" class="">Empleados</a>
        </div>
        <?php endif;?>

        <div class="tarjeta">
            <img class="logoimagen" src="img/nuevousuario.png" alt="" srcset="">
            <?php if($_SESSION['rol'] == 'administrador'):?>
            <a class="navegacion__enlace" href="crearempleado.php" class="">Crear Empleado</a>
            <?php endif;?>
        </div>

        <div class="tarjeta">
            <img class="logoimagen" src="img/soporte.png" alt="" srcset="">
            <a class="navegacion__enlace" href="archivos/documentacion.pdf" download="Documentacion Sistema Defensoria">Descargar Documentacion</a>
        </div>

        <div class="tarjeta">
            <img class="logoimagen" src="img/grafica.png" alt="" srcset="">
            <a class="navegacion__enlace" href="grafica.php">Ver Grafica</a>
        </div>
        
        <div class="tarjeta">
            <img class="logoimagen" src="img/salida.png" alt="" srcset="">
            <?php if($auth):?>
            <a class="navegacion__enlace" href="cerrarsesion.php" class="">Cerrar Sesion</a>
            <?php endif;?>
        </div>
        
        
    </div>
</nav>
    <form action="" method="POST">

        <h1 class="texto" >Crear Un Empleado</h1>
        
        <?php foreach($errores as $error) :?>
        <div class="alerta error">
        <?php echo $error; ?>
        </div>
        <?php endforeach; ?>


        <div class="campo">
        <label class="campo__label" for="nombre">Nombre</label>
        <input class="campo__field" type="text" name="nombre" placeholder="Escriba el nombre" value="<?php echo $nombre ?>">
        </div>

        <div class="campo">
        <label class="campo__label" for="apellido">Apellido</label>
        <input class="campo__field" type="text" name="apellido" placeholder="Escriba el apellido" value="<?php echo $apellido ?>">
        </div>
        
        <div class="campo">
        <label class="campo__label" for="usuario">Usuario</label>
        <input class="campo__field" type="text" name="usuario" placeholder="Escriba el usuario" value="<?php echo $usuario ?>">
        </div>

        <div class="campo">
        <label class="campo__label" for="dni">Dni</label>
        <input class="campo__field" type="text" name="dni" placeholder="Escriba el Dni" value="<?php echo $dni ?>">
        </div>

        <div class="campo">
        <label class="campo__label" for="activo">Activo</label>
            <select name="activo">
            <?php while($row = mysqli_fetch_assoc($consulta8)): ?>
            <option <?php echo $activo === $row['id_estado'] ? 'selected' : '';?> value="<?php echo $row['id_estado'] ?>"><?php echo $row['nombre_estado'] ?></option>
            <?php endwhile; ?>
            </select>
        </div>

        <div class="campo">
        <label class="campo__label" for="telefono">Telefono</label>
        <input class="campo__field" type="text" name="telefono" placeholder="Escriba el Telefono" value="<?php echo $telefono ?>">
        </div>
        
        <div class="campo">
        <label class="campo__label" for="activo">rol</label>
            <select name="rol">
            <?php while($row = mysqli_fetch_assoc($consulta6)): ?>
            <option <?php echo $rol === $row['nombre_rol'] ? 'selected' : '';?> value="<?php echo $row['nombre_rol'] ?>"><?php echo $row['nombre_rol'] ?></option>
            <?php endwhile; ?>
            </select>
        </div>

    


        <div class="botonlogin">
        <input class="boton boton--verde" type="submit" value="CONFIRMAR">
        </div>
    </form>

</div>
</body>
</html>