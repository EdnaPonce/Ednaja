<?php

session_start();

include '../php/Conexion.php';

if (!isset($_SESSION['id_usuario'])) {
    // Definir la variable de sesión con un valor por defecto si no está establecida
    $_SESSION['id_usuario'] = 0;
}


if(isset($_GET['id'])){
    $id_producto = $_GET['id'];
    $resultado = $con->query("SELECT * FROM producto WHERE id = $id_producto");
    if(mysqli_num_rows($resultado) > 0){
        $fila = mysqli_fetch_assoc($resultado);
        $nombre = $fila['nombre'];
        $precio = $fila['precio'];

        // Establecer la variable $id_usuario
        $id_usuario = $_SESSION['id_usuario'] == 0 ? null : $_SESSION['id_usuario'];

        $cantidad = 1;

        // Aquí deberías insertar los datos en la tabla de carrito
    } 
} 


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Noto+Serif:400,700,700i|Open+Sans:400,700&display=swap" rel="stylesheet"> 

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri&family=Kaushan+Script&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri&family=Kaushan+Script&family=Open+Sans&family=PT+Sans:wght@400;700&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
   
    <link rel="stylesheet" href="../css/StylesUsuario.css">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/estilos.css">


</head>
<body>
    
<?php


$nombre = $_SESSION['nombre'];
$telefono = $_SESSION['telefono'];

if(isset($_SESSION['correo'])){
    $correo = $_SESSION['correo'];

    
    $sql_busqueda = "SELECT * FROM usuario WHERE correo = '$correo'";
    
    $sql_query = mysqli_query($con,$sql_busqueda);
    
    

    while($row = mysqli_fetch_array($sql_query)){    
        ?>
        <p class="correo"><?= $row["correo"] ?></p>
        <?php
    }
}else{
    echo "Seccion no iniciada";
}
?> 

<nav class="menu">
    <a href="/Proyecto Final/cliente/HomeUsuario.php">Home</a>
    <a href="/Proyecto Final/cliente/HondaCliente.php">Productos</a>
    <a href="Carrito.php">Carrito</a>
    <a href="/Proyecto Final/cliente/UbicacionCliente.php">Ubicacion</a>
    <a href="/Proyecto Final/html/Home.html">Logout</a>
    
</nav>


    <main class="contenedor">
        <?php
           
           $sql_busqueda = "SELECT * FROM usuario WHERE  nombre = '$nombre' and correo = '$correo'
            and telefono = '$telefono'";
            
            $sql_query = mysqli_query($con,$sql_busqueda);

            while($row = mysqli_fetch_array($sql_query)){    
                ?>
                <!-- <form action="agregarHistorial.php" method="POST"> -->
                    <form  action="correo.php" method="POST">
                        <div class="grid_productos">
                            <div class="compra">
                                <h3>Datos del remitente </h3>
                                <p> <span class="negrita">Comprador: </span><?= $row["nombre"] ?></p>
                                <p> <span class="negrita">Cel: </span><?= $row["telefono"] ?></p>
                                                        

                                    <button class="button" type="submit">Pagar</button>
                                    
                                        <!-- </form> -->
                                    </form>
         
                            </div>

                            
                            <div class="">
        <?php
            }
        ?>

<table>
                <h3>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspDatos de Compra</h3>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                </tr>

<?php
// Obtener el id del usuario logueado
$id_usuario = $_SESSION['id_usuario'];

$total = 0;


$sql_busqueda = "SELECT * FROM carrito WHERE id_usuario = '$id_usuario'";

$sql_query = mysqli_query($con,$sql_busqueda);
$array=[];
while($row = mysqli_fetch_array($sql_query)){
    array_push($array,$row);
    ?>
    
    
   
    <tr>
            <td><?= $row["nombre_producto"] ?></td> 
            <td>$<?= $row["precio_producto"] ?></td>
            <td><?= $row["cantidad"] ?></td> 
            
     </tr>

<?php }
$_SESSION["productos"]=json_encode($array);
?>      

</table>

</div>


    </main>



    <style>
        /* Estilos para el pie de página */
        .footer {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #5b75f3;
            padding: 10px 0;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="content">
            <!-- Aquí va tu contenido principal -->
        </div>
        <footer class="footer">
            <a href="#"><img src="../img/icons/facebook.png" alt=""></a>
            <a href="#"><img src="../img/icons/twitter.png" alt=""></a>
            <a href="#"><img src="../img/icons/instagram-new.png" alt=""></a>
        </footer>
    </div>
    
</body>
</html>