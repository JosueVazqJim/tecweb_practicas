<?php
    require_once __DIR__ . '/start.php'; 
    use Webtechnologies\Read\Leer;

    $crearProd = new Leer();
    IF($crearProd->obtenerConexion()){
        ECHO 1;
    }
?>