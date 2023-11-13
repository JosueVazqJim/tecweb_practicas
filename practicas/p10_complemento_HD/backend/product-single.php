<?php
require_once __DIR__ . '/start.php'; 
use Webtechnologies\Read\Leer;

$buscarSimple= new Leer();
if ($buscarSimple->obtenerConexion()) {
    if( isset($_POST['id']) ) {
        $Id = $_POST['id'];
        $buscarSimple->single($Id);
        $buscarSimple->getResponse();
    }
}else{
    echo json_encode('Sin conexion', JSON_PRETTY_PRINT); 
} 
?>