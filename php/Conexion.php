<?php

//Estas son las variables para conectar a tu base de datos

$server="localhost";
$database= "maquinasalegria";
$username= "ponce";
$password="12345";

//Aqui se traen las variables para poderlas enviar

    $con = mysqli_connect($server,$username,$password,$database);

if ($con) {
  echo "Hay conexi      n";
}
    //Por si tenemos errores en la conexion
if(!$con){
    die("No hay conexi      n".mysqli_connect_error());
}    

?>
