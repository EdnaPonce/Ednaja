<?php

session_start();

include '../php/Conexion.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require "../vendor/autoload.php";
require('../fpdf185/fpdf.php');
require('../PHPMailer/src/PHPMailer.php');
require('../PHPMailer/src/SMTP.php');
require('../PHPMailer/src/Exception.php');

$id_usuario = $_SESSION['id_usuario']; 
$nombre = $_SESSION['nombre'];
$telefono = $_SESSION['telefono'];
$correo = $_SESSION['correo'];
$total = $_SESSION['total'];
$productos = json_decode($_SESSION["productos"]);
$producto = $productos[0]->nombre_producto;


$sql_carrito = "SELECT * FROM carrito WHERE id_usuario = $id_usuario";
$resultado_carrito = $con->query($sql_carrito);

 $sql_busqueda = "SELECT * FROM usuario WHERE  nombre = '$nombre' and correo = '$correo'
 and telefono = '$telefono' ";

    // Crear un nuevo objeto FPDF
    $pdf = new FPDF();

    // Agregar una nueva página al PDF
    $pdf->AddPage();

    $inicioY = $pdf->GetY();

    // Especifica el nuevo ancho y alto deseado para la imagen
    $nuevoAncho = 200; // Cambia el valor según tus necesidades
    $nuevoAlto = 240;  // Cambia el valor según tus necesidades

    // Carga la imagen y obtiene sus dimensiones originales
    $imagenPath = '../img/products/gracias.png'; // Ruta de la imagen
    list($ancho, $alto) = getimagesize($imagenPath);

    // Calcula el factor de escala para ajustar la imagen al nuevo tamaño
    $factorEscalaAncho = $nuevoAncho / $ancho;
    $factorEscalaAlto = $nuevoAlto / $alto;

    // Calcula la nueva altura de la imagen manteniendo la proporción original
    $nuevaAltura = $alto * min($factorEscalaAncho, $factorEscalaAlto);

    // Calcula la nueva posición Y para dejar espacio después de la imagen
    $nuevaY = $inicioY + $nuevaAltura + 10; // Ajusta el valor 10 según tus necesidades

    // Establece la nueva posición Y
    $pdf->SetY($nuevaY);

    // Agrega la imagen al PDF con el nuevo ancho y alto
    $pdf->Image($imagenPath, 10, $inicioY, $nuevoAncho, $nuevaAltura);

// Luego, puedes continuar con el resto de tu contenido
$pdf->SetFont('Arial', '', 16);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(0, 10, 'Para: ' . $nombre, 0, 1, 'L');
$pdf->Cell(0, 10, 'Telefono: ' . $telefono, 0, 1, 'L');

    
    $fecha = date('l jS \of F Y h:i:s A');
    $pdf->Cell(0, 10, 'Fecha: ' . $fecha, 0, 1); // Cambio de $datos_historial['fecha'] a $fecha
    $pdf->Cell(0, 10, 'Total: $' . $total, 0, 1); // Cambio de $datos_historial['total'] a $total

    $pdf->Cell(0, 10, 'Producto:', 0, 1, 'L');


    if ($resultado_carrito && $resultado_carrito->num_rows > 0) {
        while ($fila_carrito = mysqli_fetch_assoc($resultado_carrito)) {
            // Obtener los datos específicos del carrito
            $nombre_producto = $fila_carrito['nombre_producto'];
            
            // Agregar los datos del carrito al PDF
            $pdf->Cell(0, 10, "\t\t$nombre_producto", 0, 1);
            // Agregar otros campos del carrito al PDF
            
        }
    }

      // Guardar el PDF en el servidor
    $pdfPath = '../pdf/orden'.$id_usuario.'.pdf';
    $pdf->Output($pdfPath, 'F');

    // Definir los encabezados del correo electrónico
    $mail = new PHPMailer();
	$mail->CharSet = 'utf-8';
	$mail->Host = "smtp.gmail.com";
	$mail->From = "a21310380@ceti.mx";
	$mail->IsSMTP();
	$mail->SMTPAuth = true;
	$mail->Username = "a21310380@ceti.mx";
	$mail->Password = "qdoirzqeishxfqvv";
	$mail->Port = 587;
	$mail->AddAddress($correo);
	$mail->SMTPDebug = 0;   //Muestra las trazas del mail, 0 para ocultarla
	$mail->isHTML(true);                                  // Set email format to HTML
	$mail->Subject = 'COMPRA REALIZADA';
	$mail->Body = '<b>Tu recibo persona de buen corazon</b>';
	$mail->AltBody = 'Hemos enviado el recibo';

	$inMailFileName = "recibo.pdf";
	$filePath = "../pdf/orden" .$id_usuario.".pdf" ;
	$mail->AddAttachment($filePath, $inMailFileName);

	$mail->send();


    // Obtener el ID de la sucursal en función de la dirección
$usuario_query = mysqli_query($con, "SELECT id FROM usuario");
$usuario = mysqli_fetch_assoc($usuario_query );

//Agregar
if(isset($_SESSION['id_usuario'])){
    // El usuario ha iniciado sesión, podemos agregar el producto al carrito
    $id_usuario = $_SESSION['id_usuario'];
       
    // Actualizar el total en la tabla 'historial' para el usuario actual
    $sql_busqueda = "SELECT * FROM carrito WHERE id_usuario = '$id_usuario'";
    $sql_query = mysqli_query($con, $sql_busqueda);
   
    $total = 0;

    while ($row = mysqli_fetch_array($sql_query)) {
        $precio_producto = $row["precio_producto"];
        $cantidad = $row["cantidad"];

        $subtotal = $precio_producto * $cantidad;
        $total += $subtotal;
    }
     
$query = "DELETE FROM carrito WHERE id_usuario = $id_usuario";
$sql_query = mysqli_query($con, $query);

    if($query){
        header("Location: Carrito.php");
    } else {
            echo "Error al comprar.";
        }
}        
    else {
        // El usuario no ha iniciado sesión, no podemos agregar el producto al carrito
        echo "Debe iniciar sesión antes de agregar un producto al carrito.";
    }

?>
