<?php
namespace PRACTICA10\PRODUCTOS;

require_once __DIR__.'/DataBase.php';
use PRACTICA10\DATABASE\DataBase as DataBase;


class Productos extends DataBase{
    private $response;

    public function __construct($nombreBD='marketzone'){
        parent::__construct($nombreBD);
        $this->response = array();
    }

    public function obtenerConexion() {
        if($this->conexion){
            return 1;
        }else{
            return 0;
        }
    }

    public function add($Producto){
        $this->response = {
            'status'  => 'error',
            'message' => 'Ya existe un producto con ese nombre'
        }
        $sql = "SELECT * FROM productos_2 WHERE nombre = '{$Producto->nombre}' AND eliminado = 0";
	    $result = $this->conexion->query($sql);
        if ($result->num_rows == 0) {
            $this->conexion->set_charset("utf8");
            $sql = "INSERT INTO productos_2 VALUES (null, '{$Producto->nombre}', '{$Producto->marca}', '{$Producto->modelo}', {$Producto->precio}, '{$Producto->detalles}', {$Producto->unidades}, '{$Producto->imagen}', 0)";
            if($this->conexion->query($sql)){
                $this->response['status'] =  "success";
                $this->response['message'] =  "Producto agregado";
            } else {
                $this->response['message'] = "ERROR: No se ejecuto ";
            }
        }else{
        }

        $result->free();
        // Cierra la conexion
        $this->conexion->close();
    }

    public function getResponse(){
        echo json_encode($response, JSON_PRETTY_PRINT);
    }
}
?>