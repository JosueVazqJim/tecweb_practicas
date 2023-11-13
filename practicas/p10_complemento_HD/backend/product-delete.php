<?php
require_once __DIR__ . '/start.php';
use Webtechnologies\Delete\Eliminar;

$borrarProd = new Eliminar();
if ($borrarProd->obtenerConexion()) {
    // Verifica si se envió un parámetro 'id' en el POST
    if( isset($_POST['id']) ) {
        $Id = $_POST['id'];
        $borrarProd->delete($Id);
        $borrarProd->getResponse();
    }
}else{
    echo json_encode('Sin conexion', JSON_PRETTY_PRINT); 
} 
?>