<?php

include '../php/Conexion.php';

//Por si tenemos errores en la conexion
if (!$con) {
    die("Conexión fallida: " . mysqli_connect_error());
}

//Consulta
$sql = "SELECT id, nombre, marca, precio, tipo, descripcion,
imagen FROM producto WHERE marca = 'Honda'";
$resultado = mysqli_query($con, $sql);

$resultado = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

mysqli_close($con);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

       <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<!-- custom css file link  -->
<link rel="stylesheet" href="../css/Styless.css">
<link rel="stylesheet" href="../css/estilos.css">


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri&family=Kaushan+Script&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri&family=Kaushan+Script&family=Open+Sans&family=PT+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Noto+Serif:400,700,700i|Open+Sans:400,700&display=swap" rel="stylesheet"> 

   
    
   
    
   

</head>



<body>

    <nav class="menu">
        <a href="/Proyecto Final/cliente/HomeUsuario.php">Home</a>
        <a href="Carrito.php">Carrito</a>
        <a href="/Proyecto Final/html/Home.html">Logout</a>

    </nav>
   
    <div class="container">
    <div class="products-container">

        
        <?php
        foreach($resultado as $row){  ?>     
       
        <tbody style="font-size: x-large;">
        <tr>
        <a href="shop-single.php?id=<?php echo $row['id']; ?>">
                  <div class="product">

                  <img src="/Proyecto Final/img/<?php echo $row['imagen']; ?>" alt="imagen auto">
                  
                   <h4>
                        <?php echo $row['nombre']; ?>
                    </h4>
                    <p>$<?php echo $row['precio']; ?>
                    </p>

                    <p>
                        <?php echo $row['tipo']; ?>
                   </p>

                    <p>
                        <?php echo $row['descripcion']; ?>
                    </p>   
                
                    <a href="shop-single.php?id=<?php echo $row['id']; ?>">
                    <div class="alinear-derecha flex">
                        
                      <button class="button " class="input-text" type="submit" value="">Especificaciones</button>
                        </div>
                    </div> 
      
        <?php } ?>
       
    </div>
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