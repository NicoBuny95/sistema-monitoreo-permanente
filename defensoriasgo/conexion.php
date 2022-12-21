<?php

function conectarDB() {
    $db = mysqli_connect('127.0.0.1','root','','defensoriadb');
    /*$db = mysqli_connect('127.0.0.1','u671945832_nicovich','Esteban66','u671945832_defensoriadb','3306');*/



if ($db){
    return $db;
}
else{
    echo 'no se conecto';
}

}
?>