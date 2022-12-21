<?php
session_start();


$auth = $_SESSION['login'];
$nombreempleado = $_SESSION['nombreempleado'];
$rol = $_SESSION['rol'];
$resultado = $_GET['resultado'] ?? null;

if(!$auth){
    header('Location: login.php');
}



require('conexion.php');
$con = conectarDB();
$query = "SELECT * FROM mediciones WHERE nombre_empleado = '$nombreempleado'";
$res = mysqli_query($con,$query);

//eliminar registro

/* //eliminar registro
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $id = $_POST['id'];
// borrar el registro
    $query2 = "DELETE FROM mediciones WHERE id_medicion = '$id'";
    $res2 = mysqli_query($con,$query2);

    if($res2){
        header('Location: paneladministracion.php?resultado=3');
    }
}*/

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/logo-defensoria-png.ico" type="image/x-icon">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- CSS personalizado --> 
    <link rel="stylesheet" href="css/header.css">  
      
    <!--datables CSS básico-->
    <link rel="stylesheet" type="text/css" href="datatables/datatables.min.css"/>

    <link rel="stylesheet" type="text/css" href="datatables/DataTables-1.13.1/css/dataTables.bootstrap5.min.css"/>
    <link rel="stylesheet" type="text/css" href="datatables/Buttons-2.3.2/css/buttons.bootstrap5.min.css"/>
    <link rel="stylesheet" type="text/css" href="datatables/Responsive-2.4.0/css/responsive.bootstrap5.min.css"/>
           
    <!--font awesome con CDN-->  
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">  
      
<!-- sweet alert 2 -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>



    <title>Programa permanente de monitoreo</title>
</head>
<body>

<!-- sweet alert 2 -->
<!--alertas express-->
<?php if($resultado == 1): ?>
        <script>
            Swal.fire(
        'Nueva Medicion!',
        'Se Agrego La Medicion Correctamente!',
        'success'
        )
        </script>
    <?php elseif($resultado == 2): ?>
        <script>
            Swal.fire(
        'Medicion Modificada!',
        'Se Modifico La Medicion Correctamente!',
        'success'
        )
        </script>
    <?php endif ;?>


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

        <?php if($rol == 'administrador'):?>
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
            <a class="navegacion__enlace" href="grafica.php">Ver Estadisticas</a>
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


<div class="container">
    <div class="row">
        <div class="col-lg-12">

            <div class="table table-bordered display nowrap">


                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Empleado</th>
                            <th>Punto de monitoreo</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>temp</th>
                            <th>ph</th>
                            <th>phmv</th>
                            <th>orpmv</th>
                            <th>mscm</th>
                            <th>ntu</th>
                            <th>mgldo</th>
                            <th>gltds</th>
                            <th>ppt</th>
                            <th>densidad</th>
                            <th>observacion</th>
                            <!--campos extras-->
                            <th>Lluvia</th>
                            <th>Basura</th>
                            <th>Basura En 200m</th>
                            <th>Personas cerca</th>
                            <th>Animales cerca</th>
                            <th>Viento</th>
                            <th>Caudal</th>
                            <th>Otros</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($res as $r): ?>
                        <tr>
                            <td><?php echo $r['nombre_empleado']?></td>
                            <td><?php echo $r['nombre_puntomonitoreo']?></td>
                            <td><?php echo $r['fecha']?></td>
                            <td><?php echo $r['hora']?></td>
                            <td><?php echo $r['temperatura']?></td>
                            <td><?php echo $r['ph']?></td>
                            <td><?php echo $r['phmv']?></td>
                            <td><?php echo $r['orpmv']?></td>
                            <td><?php echo $r['mscm']?></td>
                            <td><?php echo $r['ntu']?></td>
                            <td><?php echo $r['mgldo']?></td>
                            <td><?php echo $r['gltds']?></td>
                            <td><?php echo $r['ppt']?></td>
                            <td><?php echo $r['densidad']?></td>
                            <td><?php echo $r['observaciones']?></td>

                            <!-- campos extras -->
                            <td><?php echo $r['lluvia']?></td>
                            <td><?php echo $r['basura']?></td>
                            <td><?php echo $r['basura200m']?></td>
                            <td><?php echo $r['personascerca']?></td>
                            <td><?php echo $r['animalescerca']?></td>
                            <td><?php echo $r['viento']?></td>
                            <td><?php echo $r['caudal']?></td>
                            <td><?php echo $r['otros']?></td>

                            <td>
                            <div class="btn-group">
                                <a class="btn btn-warning" href="modificarmedicion.php?id=<?php echo $r['id_medicion'] ; ?>">Modificar</a>
                            

                                <?php if($_SESSION['rol'] == 'administrador'):?>

                                <a onclick="alerta_eliminar(<?php echo $r['id_medicion'] ; ?>)" class="btn btn-danger" >Eliminar</a>

                                <?php endif; ?>
                            </div>
                        </td>
                        </tr>
                        <?php endforeach;?>
                </table>
                </div>
        </div>
    </div>
</div>

    <!-- jQuery, Popper.js, Bootstrap JS -->
    <script src="jquery/jquery-3.3.1.min.js"></script>
    <script src="popper/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
      
    <!-- datatables JS -->
    <script type="text/javascript" src="datatables/datatables.min.js"></script>    
     
    <!-- para usar botones en datatables JS -->  
    <script type="text/javascript" src="datatables/JSZip-2.5.0/jszip.min.js"></script>
    <script type="text/javascript" src="datatables/pdfmake-0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="datatables/DataTables-1.13.1/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="datatables/DataTables-1.13.1/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript" src="datatables/Buttons-2.3.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="datatables/Buttons-2.3.2/js/buttons.bootstrap5.min.js"></script>
    <script type="text/javascript" src="datatables/Buttons-2.3.2/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="datatables/Buttons-2.3.2/js/buttons.print.min.js"></script>
    <script type="text/javascript" src="datatables/Responsive-2.4.0/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="datatables/Responsive-2.4.0/js/responsive.bootstrap5.js"></script>
     
    <!-- código JS propìo-->    
    <script type="text/javascript" src="main.js"></script> 
    <script src="eliminar.js"></script> 
    
    <!--extensiones para estilos de excel-->
    <script src="https://cdn.jsdelivr.net/npm/datatables-buttons-excel-styles@1.2.0/js/buttons.html5.styles.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/datatables-buttons-excel-styles@1.2.0/js/buttons.html5.styles.templates.min.js"></script>
</body>
</html>



