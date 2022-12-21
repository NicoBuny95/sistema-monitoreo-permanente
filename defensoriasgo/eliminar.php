<!-- sweet alert 2 -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<?php
session_start();

$auth = $_SESSION['login'];
$nombreempleado = $_SESSION['nombreempleado'];
$rol = $_SESSION['rol'];

if(!$auth){
    header('Location: login.php');
}



require('conexion.php');
$con = conectarDB();
$eliminar = $_POST['id'];
$sentencia = $con -> query("DELETE FROM mediciones WHERE id_medicion = '$eliminar'");

?>