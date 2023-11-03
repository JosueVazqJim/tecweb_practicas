<?php
require_once __DIR__ . '/API/Productos.php'; 
use PRACTICA10\PRODUCTOS\Productos as Productos;
$conexionProd = new Productos();
if ($conexionProd->obtenerConexion()) {
    // Verifica si se envió un parámetro 'data' en el POST
    if (isset($_POST['data'])) {
        // Decodifica la cadena JSON en un objeto PHP
        //$producto = json_decode($_POST['data']);
        $Producto = json_decode( json_encode($_POST['data']) );

        // Agrega el producto a la base de datos
        $conexionProd->add($Producto);
        $conexionProd->getResponse();
    }
}else{
    echo json_encode('Sin conexion', JSON_PRETTY_PRINT); 
} 
?>
