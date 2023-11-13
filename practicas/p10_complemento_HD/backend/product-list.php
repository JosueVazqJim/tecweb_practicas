<?php
require_once __DIR__ . '/start.php'; 
use Webtechnologies\Read\Leer;

$listarProds = new Leer();
if ($listarProds->obtenerConexion()) {
    $listarProds->list();
    $listarProds->getResponse();
    
}else{
    echo json_encode('Sin conexion', JSON_PRETTY_PRINT); 
} 
?>
