<?php
require_once __DIR__ . '/API/Productos.php'; 
use PRACTICA10\PRODUCTOS\Productos as Productos;
$conexionProd = new Productos();
if ($conexionProd->obtenerConexion()) {
    // Verifica si se envió un parámetro 'data' en el POST
    if( isset($_POST['id']) ) {
        $Producto = json_decode( json_encode($_POST['data']) );
        $conexionProd->edit($producto);
        $conexionProd->getResponse();
    }
}else{
    echo json_encode('Sin conexion', JSON_PRETTY_PRINT); 
} 
?>