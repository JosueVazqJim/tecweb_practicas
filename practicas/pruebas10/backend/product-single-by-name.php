<?php
require_once __DIR__ . '/API/Productos.php'; 
use PRACTICA10\PRODUCTOS\Productos as Productos;
$conexionProd = new Productos();
if ($conexionProd->obtenerConexion()) {
    // Verifica si se envió un parámetro 'data' en el POST
    if (isset($_GET['name'])) {
        $Nombre = $_GET['name'];
        $conexionProd->singleByName($Nombre);
        $conexionProd->getResponse();
    }

}else{
    echo json_encode('Sin conexion', JSON_PRETTY_PRINT); 
} 
?>

