<?php
namespace Webtechnologies\Create;
require_once __DIR__ . '/../../start.php';
use Webtechnologies\API\DataBase;

class Crear extends DataBase{
    public function __construct($nombreBD = 'marketzone'){
        parent::__construct($nombreBD);
    }

    public function add($Producto){
        $this->response = [
            'status' => 'error',
            'message' => 'Ya ecsiste un producto con ese nombre'
        ];
        $sql = "SELECT * FROM productos_2 WHERE nombre = '{$Producto->nombre}' AND eliminado = 0";
	    $result = $this->conexion->query($sql);
        if ($result->num_rows == 0) {
            $this->conexion->set_charset("utf8");
            $sql = "INSERT INTO productos_2 VALUES (null, '{$Producto->nombre}', '{$Producto->marca}', '{$Producto->modelo}', {$Producto->precio}, '{$Producto->detalles}', {$Producto->unidades}, '{$Producto->imagen}', 0)";
            if($this->conexion->query($sql)){
                $this->response['status'] =  "success";
                $this->response['message'] =  "Producto agregado";
            } else {
                $this->response['message'] = "ERROR: No se ejecutó";
            }
        $result->free();
        $this->conexion->close();    
        }
    }
}
?>