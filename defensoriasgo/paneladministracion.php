<?php

//inicio de sesion con el nombre del empleado
session_start();


$auth = $_SESSION['login'];
$nombreempleado = $_SESSION['nombreempleado'];
$rol = $_SESSION['rol'];

if(!$auth){
    header('Location: login.php');
}


// conexion
require('conexion.php');
$con = conectarDB();


$resultado = $_GET['resultado'] ?? null;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/logo-defensoria-png.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
    integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
    crossorigin=""/>
    <link rel="stylesheet" href="css/header.css">

    <title>panel administracion</title>
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

        <?php if($rol == 'administrador'):?>
        <div class="tarjeta">
            <img class="logoimagen" src="img/nuevousuario.png" alt="" srcset="">
            <a class="navegacion__enlace" href="crearempleado.php" class="">Crear Empleado</a>
        </div>
        <?php endif;?>


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

</div>

<!--alertas express-->




    <!-- mapa -->

<h1 class="centrar-texto">Puntos De Monitoreo</h1>

<div class="mapita">
<select name="select-location" id="select-location">
<option value="-1">Seleccione un punto</option>
<option value="-27.79511,-64.26149">Santiago del estero</option>
<option value="-27.675997,-65.425211">Rio Marapa/Graneros</option>
<option value="-27.582768,-65.078598">Arroyo Matazambi</option>
<option value="-27.407421, -65.124566">Arroyo mixta</option>
<option value="-27.475314, -65.619984">Rio chico</option>
<option value="-27.159618, -65.363922">Rio colorado</option>
<option value="-27.157715, -65.322194">Rio sali</option>
<option value="-27.419498, -65.409482">Rio gastona</option>
<option value="-27.285381, -65.550499">Rio seco</option>
<option value="-27.490886, -64.836646">Rio Dulce</option>
<option value="-27.512376, -64.894972">Murallon</option>
<option value="-27.540846,-64.929762">Embalse termas rio hondo</option>
</select>
</div>

<div id="map"></div>


    <!-- Make sure you put this AFTER Leaflet's CSS -->
 <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
 integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
 crossorigin=""></script>

 <script src="app.js"></script>
</div>
</body>
</html>