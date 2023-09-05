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
        $imagen = $fila['imagen'];
        $sucursal = $fila['sucursal'];

        // Establecer la variable $id_usuario
        $id_usuario = $_SESSION['id_usuario'] == 0 ? null : $_SESSION['id_usuario'];

        $cantidad = 1;

        // Aquí deberías insertar los datos en la tabla de carrito



    } else {
        header("Location: ./ProductosUsuario.php");
    }
} else {
    header("Location: ./ProductosUsuario.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri&family=Kaushan+Script&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri&family=Kaushan+Script&family=Open+Sans&family=PT+Sans:wght@400;700&display=swap" rel="stylesheet">

  
    
    <link rel="stylesheet" href="../css/StylesUsuario.css">
   
    <link rel="stylesheet" href="../css/estilos.css">
    


</head>
<body>



<nav class="menu">
    <a href="/Proyecto Final/cliente/HomeUsuario.php">Home</a>
    <a href="/Proyecto Final/cliente/HondaCliente.php">Productos</a>
    <a href="Carrito.php">Carrito</a>
    <a href="/Proyecto Final/cliente/UbicacionCliente.php">Ubicacion</a>
    <a href="/Proyecto Final/html/Home.html">Logout</a>
    
</nav>

    <main class="contenedor">
          
        <?php
        foreach($resultado as $row){  ?>    
                <h2 class="centrar-texto producto__nombre">
                    <span class="producto__bold"><?php echo $fila['nombre']; ?></span>
                </h2> 
        <div class="producto">
                    <img src="/Proyecto Final/img/<?php echo $fila['imagen']; ?>" alt="<?php echo $fila['1']; ?>">
            <div class="producto__informacion">

                    <p class="producto__bold">Precio:
                         <span class="producto__precio">$<?php echo $fila['precio']; ?></span>
                    </p>

                    <p class="producto__bold">Stock
                        <span class="producto__precio"><?php echo $fila['sucursal']; ?></span>
                   </p>

                    <p class="producto__descripcion">
                        <?php echo $row['descripcion']; ?>
                    </p>  

            <form action="agregarCarrito.php" method="POST">
                     <input type="hidden" name="id" value="ID_DEL_PRODUCTO_A_AGREGAR">
                    <input type="hidden" name="id_producto" value="<?php echo $fila['id']; ?>">
                    <!-- <input type="number" name="cantidad" value="1" min="1" "> -->
                    <button class="button" type="submit">Añadir al carrito</button>
            </form>

  
            </div>          
        </div> 
        <?php } ?>
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