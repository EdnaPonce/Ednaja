
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
session_start();

include "../php/Conexion.php";


?> 

<nav class="menu">
    <a href="/Proyecto Final/cliente/HomeUsuario.php">Home</a>
    <a href="/Proyecto Final/cliente/HondaCliente.php">Productos</a>
    <a href="Carrito.php">Carrito</a>
    <a href="/Proyecto Final/cliente/UbicacionCliente.php">Ubicacion</a>
    <a href="/Proyecto Final/html/Home.html">Logout</a>
    
</nav>



    <main class="contenedor sombra">
        <h2 class="centrar-texto"></h2>

    <table>
            <tr>
                <th>&nbsp&nbsp&nbsp&nbspNOMBRE</th>
                <th>PRECIO</th>
                <th class="responsive-hide">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspPRODUCTO</th>
                <th>CANTIDAD</th>
                <th class="responsive-hide">TOTAL</th>
                <th>&nbsp&nbspELIMINAR</th>
            </tr>

<?php



include "../php/Conexion.php";

// Obtener el id del usuario logueado
$id_usuario = $_SESSION['id_usuario'];

$total = 0;


$sql_busqueda = "SELECT * FROM carrito WHERE id_usuario = '$id_usuario'";

$sql_query = mysqli_query($con,$sql_busqueda);

while($row = mysqli_fetch_array($sql_query)){?>
    
    <tr>
    <td><?= $row["nombre_producto"] ?></td> 
    <td>$<?= $row["precio_producto"] ?></td>
    <td>
        <img class="responsive-hide" src="/Proyecto Final/img/<?php echo $row['imagen_producto']; ?>" alt="imagen auto">
    </td>
    <td><?= $row["cantidad"] ?></td> 
    <?php
    $subtotal = $row["cantidad"] * $row["precio_producto"];
    ?>
    <td class="responsive-hide">
        $<?= $subtotal ?>
    </td>
    <td>
        <form action="eliminarCarrito.php" method="post">
            <input type="hidden" name="id" value="<?= $row["id"] ?>">
            <input class="remover" type="submit" value="Eliminar" name="eliminar">
        </form>
    </td>
</tr>


        <?php
        $subtotal = $row["cantidad"] * $row["precio_producto"];
        $total += $subtotal;

        ?>

<?php }
    $_SESSION["total"]=$total;
?>  
        </table>
    <section class="grid_right">
        <h3 class="">Cars Totals</h3>
   
        <h4 class="">Total: <span>$<?= $total ?></span> </h4>
    <?php

    $sql_busqueda = "SELECT * FROM carrito WHERE id_usuario = '$id_usuario'";
    $sql_query = mysqli_query($con, $sql_busqueda);

     if(mysqli_num_rows($sql_query) > 0){    ?> 
        <a  href="../cliente/CompraUsuario.php">
        <input class="button button_comprar" type="submit" value="Comprar" name="comprar">
        </a>
    <?php }
    ?> 
    </section>


    </main>



		<footer class="row justify-content-center redes-sociales">
			<div class="col-auto">
				<a href="#"><img src="../img/icons/facebook.png" alt=""></a>
				<a href="#"><img src="../img/icons/twitter.png" alt=""></a>
				<a href="#"><img src="../img/icons/instagram-new.png" alt=""></a>
			</div>
	    </footer>
	

    </body>
</html>