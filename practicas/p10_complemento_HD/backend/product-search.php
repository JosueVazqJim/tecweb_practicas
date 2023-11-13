<?php
require_once __DIR__ . '/start.php'; 
use Webtechnologies\Read\Leer;

$buscarProd = new Leer();
if ($buscarProd->obtenerConexion()) {
    if( isset($_GET['search']) ) {
        $Coincidencia = $_GET['search'];
        $buscarProd->search($Coincidencia);
        $buscarProd->getResponse();
    } 
}else{
    echo json_encode('Sin conexion', JSON_PRETTY_PRINT); 
} 
?>
