<?php
$server = "localhost";
$database = "maquinasalegria";
$username = "ponce";
$password = "12345";

// Conectarse a la base de datos
$con = mysqli_connect($server, $username, $password, $database);

if (!$con) {
    die("No hay conexi      n: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los valores del formulario
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $password = $_POST['password'];
    $telefono = $_POST['telefono'];
    $edad = $_POST['Edad'];
$pais = $_POST['Pais'];

    // Crear la consulta SQL para insertar el usuario en la base de datos
    $sql = "INSERT INTO usuario (nombre, correo, password, telefono, Edad, Pais>

    // Ejecutar la consulta SQL
    if (mysqli_query($con, $sql)) {
        header('Location: ../html/Home.html');
        exit();
    } else {
        echo "Error al registrar el usuario: " . mysqli_error($con);
    }
}

// Cerrar la conexi      n a la base de datos
mysqli_close($con);
?>

