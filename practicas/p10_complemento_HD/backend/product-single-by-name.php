<?php
require_once __DIR__ . '/start.php'; 
use Webtechnologies\Read\Leer;

$buscarNombre = new Leer();
if ($buscarNombre->obtenerConexion()) {
    // Verifica si se envió un parámetro 'data' en el POST
    if (isset($_GET['name'])) {
        $Nombre = $_GET['name'];
        $buscarNombre->singleByName($Nombre);
        $buscarNombre->getResponse();
    }

}else{
    echo json_encode('Sin conexion', JSON_PRETTY_PRINT); 
} 
?>

