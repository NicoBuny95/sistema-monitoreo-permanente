<?php 
session_start();
//var_dump($_SESSION);

$auth = $_SESSION['login'] ?? false;
$rol = $_SESSION['rol'];

if(!$auth){
    header('Location: login.php');
}

// conexion
require('conexion.php');
$con = conectarDB();
$id = $_GET['id'];
$errores = [];


//actualizar

$consulta = "SELECT * FROM mediciones WHERE id_medicion = $id ;";
$resultado2 = mysqli_query($con,$consulta);
$medicion = mysqli_fetch_assoc($resultado2);


date_default_timezone_set("America/Argentina/Buenos_Aires");
$nombreempleado = $_SESSION['nombreempleado'];
$fecha = date('Y/m/d');
$hora = date('H:i:s');

//valores previos de la db
$nombrepuntomonitoreo = $medicion['nombre_puntomonitoreo'];
$temperaturadb = $medicion['temperatura'];
$phdb = $medicion['ph'];
$phmvdb = $medicion['phmv'];
$orpmvdb = $medicion['orpmv'];
$mscmdb = $medicion['mscm'];
$ntudb = $medicion['ntu'];
$mgldodb = $medicion['mgldo'];
$gltdsdb = $medicion['gltds'];
$pptdb = $medicion['ppt'];
$densidaddb = $medicion['densidad'];
$observacionesdb = $medicion['observaciones'];

// campos extras
$lluvia = $medicion['lluvia'];
$basura = $medicion['basura'];
$basura200m = $medicion['basura200m'];
$personascerca = $medicion['personascerca'];
$animalescerca = $medicion['animalescerca'];
$viento = $medicion['viento'];
$caudal = $medicion['caudal'];
$otros = $medicion['otros'];




if($_SERVER['REQUEST_METHOD']  === 'POST'){
    $temperatura = $_POST['temperatura'];
    $ph = $_POST['ph'];
    $phmv = $_POST['phmv'];
    $orpmv = $_POST['orpmv'];
    $mscm = $_POST['mscm'];
    $ntu = $_POST['ntu'];
    $mgldo = $_POST['mgldo'];
    $gltds = $_POST['gltds'];
    $ppt = $_POST['ppt'];
    $densidad = $_POST['densidad'];
    $observaciones = $_POST['observaciones'];
    //campos extras
    $lluvia = $_POST['lluvia'] ?? '';
    $basura = $_POST['basura'] ?? '';
    $basura200m = $_POST['basura200m'] ?? '';;
    $personascerca = $_POST['personascerca'] ?? '';
    $animalescerca = $_POST['animalescerca'] ?? '';
    $viento = $_POST['viento'] ?? '';
    $caudal = $_POST['caudal'] ?? '';
    $otros = $_POST['otros'] ?? '';


    //validaciones

    
    if($nombrepuntomonitoreo == ""){
        $errores[] = 'El punto es obligatorio';
    }

    if($temperatura == ""){
        $errores[] = 'temperatura es obligatorio';
    }

    if($ph == ""){
        $errores[] = 'ph es obligatorio';
    }

    if($phmv == ""){
        $errores[] = 'phmv es obligatorio';
    }

    if($orpmv == ""){
        $errores[] = 'orpmv es obligatorio';
    }
    
    if($mscm == ""){
        $errores[] = 'mscm es obligatorio';
    }

    if($ntu == ""){
        $errores[] = 'ntu es obligatorio';
    }

    if($mgldo == ""){
        $errores[] = 'mgldo es obligatorio';
    }

    if($gltds == ""){
        $errores[] = 'gltds es obligatorio';
    }

    if($ppt == ""){
        $errores[] = 'ppt es obligatorio';
    }

    if($densidad == ""){
        $errores[] = 'densidad es obligatorio';
    }

    if($observaciones == ""){
        $errores[] = 'observaciones es obligatorio';
    }

    if($lluvia == ""){
        $errores[] = 'presencia de lluvia es obligatoria';
    }

    if($basura == ""){
        $errores[] = 'presencia de basura es obligatoria';
    }

    if($basura200m == ""){
        $errores[] = 'presencia de basura 200m es obligatoria';
    }

    if($personascerca == ""){
        $errores[] = 'presencia de personas es obligatoria';
    }

    if($animalescerca == ""){
        $errores[] = 'presencia de animales es obligatoria';
    }

    if($viento == ""){
        $errores[] = 'presencia de viento es obligatoria';
    }

    if($caudal == ""){
        $errores[] = 'presencia de caudal es obligatoria';
    }

     

    //base de datos

    if(empty($errores)){


        $query = "UPDATE mediciones SET fecha = '$fecha',hora = '$hora' ,temperatura = '$temperatura',ph = '$ph',phmv = '$phmv',orpmv = '$orpmv',mscm = '$mscm',ntu = '$ntu',mgldo = '$mgldo',gltds = '$gltds',ppt = '$ppt',densidad = '$densidad',observaciones = '$observaciones',lluvia = '$lluvia',basura = '$basura',basura200m = '$basura200m',personascerca = '$personascerca',animalescerca = '$animalescerca',viento = '$viento',caudal = '$caudal',otros = '$otros' WHERE id_medicion = '$id'";
        $resultado = mysqli_query($con,$query);
        
        
        if($resultado){
            header('Location: mismediciones.php?resultado=2');
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

<h1 class="texto" >modificar una medicion</h1>
<?php foreach($errores as $error) :?>
        <div class="alerta error">
        <?php echo $error; ?>
        </div>
        <?php endforeach; ?>

    <form action="" method="POST" class="formulario">
    <div class="tarjeta">
        <h3 class="texto" >Empleado: <?php echo $_SESSION['nombreempleado'] ?></h3>
        <h3 class="texto" >Punto de monitoreo: <?php echo $nombrepuntomonitoreo ?></h3>
        <h3 class="texto" >Ultima Modificacion: <?php echo $fecha . " " . $hora ?></h3>
    </div>

        <div class="campo">
        <label class="campo__label" for="temperatura">Temp</label>
        <input class="campo__field" type="number" name="temperatura" placeholder="Escriba la Temperatura" step="0.00001" value="<?php echo $temperaturadb ?>">
        </div>

        <div class="campo">
        <label class="campo__label" for="ph">pH</label>
        <input class="campo__field" type="number" name="ph" placeholder="Escriba el ph" step="0.00001" value="<?php echo $phdb ?>">
        </div>
        
        <div class="campo">
        <label class="campo__label" for="phmv">pH/mv</label>
        <input class="campo__field" type="number" name="phmv" placeholder="Escriba el phmv" step="0.00001" value="<?php echo $phmvdb ?>">
        </div>        


        <div class="campo">
        <label class="campo__label" for="orpmv">ORPmv</label>
        <input class="campo__field" type="number" name="orpmv" placeholder="Escriba el orpmv" step="0.00001" value="<?php echo $orpmvdb ?>">
        </div>
        
        
        <div class="campo">
        <label class="campo__label" for="mscm">mS/cm</label>
        <input class="campo__field" type="number" name="mscm" placeholder="Escriba el mscm" step="0.00001" value="<?php echo $mscmdb ?>">
        </div>        


        <div class="campo">
        <label class="campo__label" for="ntu">NTU</label>
        <input class="campo__field" type="number" name="ntu" placeholder="Escriba el ntu" step="0.00001" value="<?php echo $ntudb ?>">
        </div>

        <div class="campo">
        <label class="campo__label" for="mgldo">Mg/LDO</label>
        <input class="campo__field" type="number" name="mgldo" placeholder="Escriba el mgldo" step="0.00001" value="<?php echo $mgldodb ?>">
        </div>                


        <div class="campo">
        <label class="campo__label" for="gltds">g/L TDS</label>
        <input class="campo__field" type="number" name="gltds" placeholder="Escriba el gltds" step="0.00001" value="<?php echo $gltdsdb ?>">
        </div>


        <div class="campo">        
        <label class="campo__label" for="ppt">PPT</label>
        <input class="campo__field" type="number" name="ppt" placeholder="Escriba el ppt" step="0.00001" value="<?php echo $pptdb ?>">
        </div>
        
        
        <div class="campo">
        <label class="campo__label" for="densidad">densidad</label>
        <input class="campo__field" type="number" name="densidad" placeholder="Escriba la densidad" step="0.00001" value="<?php echo $densidaddb ?>">
        </div>

        <div class="campo__label__textarea">
        <label for="observaciones">observaciones</label>
        </div>
        <textarea name="observaciones" cols="30" rows="10" placeholder="escriba sus observaciones"><?php echo $observacionesdb ?></textarea>
        

<!--campos extras -->

        <!--aqui empieza el campo-->
        <div>
        <pclass="p_formulario">¿hubo presencia de lluvia?</p>
        <input <?php echo $lluvia === 'Si' ? 'checked' : '';?> type="radio" id="lluviasi" name="lluvia" value="Si">
        <label for="lluviasi">Si</label>
        <input <?php echo $lluvia === 'No' ? 'checked' : '';?>  type="radio" id="lluviano" name="lluvia" value="No">
        <label for="lluviano">No</label>
        </div>
        <!--aqui termina el campo-->

        <!--aqui empieza el campo-->
        <div>
        <p class="p_formulario">¿hubo presencia de basura?</p>
        <input <?php echo $basura === 'Si' ? 'checked' : '';?> type="radio" id="basurasi" name="basura" value="Si">
        <label for="basurasi">Si</label>
        <input <?php echo $basura === 'No' ? 'checked' : '';?>  type="radio" id="basurano" name="basura" value="No">
        <label for="basurano">No</label>
        </div>
        <!--aqui termina el campo-->
        

        <!--aqui empieza el campo-->
        <div>
        <p class="p_formulario">¿hubo presencia de basura en un alrededor de 200 metros?</p>
        <input <?php echo $basura200m === 'Si' ? 'checked' : '';?> type="radio" id="basurasi200m" name="basura200m" value="Si">
        <label for="basurasi200m">Si</label>
        <input <?php echo $basura200m === 'No' ? 'checked' : '';?>  type="radio" id="basurano200m" name="basura200m" value="No">
        <label for="basurano200m">No</label>
        </div>
        <!--aqui termina el campo-->

        <!--aqui empieza el campo-->
        <div>
        <p class="p_formulario">¿hubo presencia de personas cerca?</p>
        <input <?php echo $personascerca === 'Si' ? 'checked' : '';?> type="radio" id="personascercasi" name="personascerca" value="Si">
        <label for="personascercasi">Si</label>
        <input <?php echo $personascerca === 'No' ? 'checked' : '';?>  type="radio" id="personascercano" name="personascerca" value="No">
        <label for="personascercano">No</label>
        </div>
        <!--aqui termina el campo-->

        <!--aqui empieza el campo-->
        <div>
        <p class="p_formulario">¿hubo presencia de animales cerca?</p>
        <input <?php echo $animalescerca === 'Si' ? 'checked' : '';?> type="radio" id="animalescercasi" name="animalescerca" value="Si">
        <label for="animalescercasi">Si</label>
        <input <?php echo $animalescerca === 'No' ? 'checked' : '';?>  type="radio" id="animalescercano" name="animalescerca" value="No">
        <label for="animalescercano">No</label>
        </div>
        <!--aqui termina el campo-->

        <!--aqui empieza el campo-->
        <div>
        <p class="p_formulario">nivel del viento</p>
        <input <?php echo $viento === 'Alto' ? 'checked' : '';?> type="radio" id="alto" name="viento" value="Alto">
        <label for="alto">Alto</label>
        <input <?php echo $viento === 'Medio' ? 'checked' : '';?> type="radio" id="medio" name="viento" value="Medio">
        <label for="medio">Medio</label>
        <input <?php echo $viento === 'Bajo' ? 'checked' : '';?> type="radio" id="bajo" name="viento" value="Bajo">
        <label for="bajo">Bajo</label>
        </div>
        <!--aqui termina el campo-->

        <!--aqui empieza el campo-->
        <div>
        <p class="p_formulario">nivel del caudal</p>
        <input <?php echo $caudal === 'Alto' ? 'checked' : '';?> type="radio" id="altoc" name="caudal" value="Alto">
        <label for="altoc">Alto</label>
        <input <?php echo $caudal === 'Medio' ? 'checked' : '';?> type="radio" id="medioc" name="caudal" value="Medio">
        <label for="medioc">Medio</label>
        <input <?php echo $caudal === 'Bajo' ? 'checked' : '';?> type="radio" id="bajoc" name="caudal" value="Bajo">
        <label for="bajoc">Bajo</label>
        </div>
        <!--aqui termina el campo-->

        <br>

        <div class="campo">
        <label class="campo__label" for="otros">Otros</label>
        <input class="campo__field" type="text" name="otros" placeholder="Otras observaciones..." value="<?php echo $otros ?>">
        </div>



        <div class="botonlogin">
        <input class="boton boton--verde" type="submit" value="CONFIRMAR">
        </div>
    </form>

</div>
</body>
</html>