<?php
namespace Webtechnologies\API;

abstract class DataBase{
    protected $conexion;
    protected $response;

    public function __construct($nombreBD) {
        $this->conexion = @mysqli_connect(
            'localhost',
            'root',
            'Normita1230',
            $nombreBD
        );
        $this->response = array();

        if(!$this->conexion) {
            die('¡Base de datos NO conextada!');
        }
    }

    public function obtenerConexion() {
        if($this->conexion){
            return 1;
        }else{
            return 0;
        }
    }

    public function getResponse(){
        echo json_encode($this->response, JSON_PRETTY_PRINT);
    }
}
?>