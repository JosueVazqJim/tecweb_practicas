<?php
require_once __DIR__ . '/start.php';
use Webtechnologies\Create\Crear;

$crearProd = new Crear();
if ($crearProd->obtenerConexion()) {
    // Verifica si se envió un parámetro 'data' en el POST
    if (isset($_POST['data'])) {
        // data se convierte a un string json y luego a un objeto PHP
        $Producto = json_decode( json_encode($_POST['data']) );
        // Agrega el producto a la base de datos
        $crearProd->add($Producto);
        $crearProd->getResponse();
    }
}else{
    echo json_encode('Sin conexion', JSON_PRETTY_PRINT); 
} 
?>
