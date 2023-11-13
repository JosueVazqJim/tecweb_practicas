<?php
require_once __DIR__ . '/start.php';
use Webtechnologies\Update\Actualizar;

$actualizarProd = new Actualizar();
if ($actualizarProd->obtenerConexion()) {
    // Verifica si se envió un parámetro 'data' en el POST
    if( isset($_POST['data']) ) {
        // data se convierte a un string json y luego a un objeto PHP
        $Producto = json_decode( json_encode($_POST['data']) );
        $actualizarProd->edit($Producto);
        $actualizarProd->getResponse();
    }
}else{
    echo json_encode('Sin conexion', JSON_PRETTY_PRINT); 
} 
?>