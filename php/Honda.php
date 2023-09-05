<?php

include 'Conexion.php';

//Por si tenemos errores en la conexion
if (!$con) {
    die("Conexión fallida: " . mysqli_connect_error());
}

//Consulta
$sql = "SELECT id, nombre, marca, precio, tipo, descripcion, imagen FROM producto WHERE marca = 'Honda'";
$resultado = mysqli_query($con, $sql);

//Obtener resultados
$resultado = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

//Cerrar conexión
mysqli_close($con);
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

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <link rel="stylesheet" href="/Proyecto Final/css/StylesUsuario.css">
    <link rel="stylesheet" href="/Proyecto Final/css/normalize.css">
      <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<!-- custom css file link  -->
<link rel="stylesheet" href="../css/Styless.css">
<link rel="stylesheet" href="../css/estilos.css">


</head>

<body>

<nav class="menu">
        <a href="../html/Home.html">Home</a>
        <a href="../html/Registro.html">Registrarse</a>
        <a href="../html/Login.html">Iniciar sesion</a>
        <a href="../html/Ubicacion.html">Ubicacion</a>
        
        <a href="../php/Honda.php">Productos</a>
        
    </nav>


    <main class="contenedor">
        
        <h2 class="centrar-texto">Productos muestra</h2>  
        <h6 class="centrar-texto">Tiene que registrarse para poder comprar</h6>  
        
       
        
        <?php 

        foreach($resultado as $row){ 
        ?>
        <form action="formulario" method="POST" action="Carrito.php">
            <div class="producto">
                <div class="producto__imagen">
                    <img src="/Proyecto Final/img/<?php echo $row['imagen']; ?>" alt="imagen auto">
                </div>
                <div class="producto__informacion">
                    <h3 class="no-margin producto__nombre">
                        <span class="producto__bold"><?php echo $row['nombre']; ?></span>
                    </h3>
                    <p class="producto__bold">Precio:
                        
                        <span class="producto__precio">$<?php echo $row['precio']; ?></span>
                    </p>
                    <p class="producto__bold">Tipo:
                        <span class="producto__precio"><?php echo $row['tipo']; ?></span>
                </p>
                    <p class="producto__descripcion">
                        <?php echo $row['descripcion']; ?>
                </p>

                <a href="../html/Login.html">
                        <div class="alinear-derecha flex">
                            
                        </div>
                    </a>
                </div>          
            </div> 
        </form>    
        <?php   
                } ?>
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