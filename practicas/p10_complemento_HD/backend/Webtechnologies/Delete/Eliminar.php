<?php
namespace Webtechnologies\Delete;
require_once __DIR__ . '/../../start.php';
use Webtechnologies\API\DataBase;

class Eliminar extends DataBase{
    public function __construct($nombreBD = 'marketzone'){
        parent::__construct($nombreBD);
    }

    public function delete($Id){
        $this->response = [
            'status' => 'error',
            'message' => 'ERROR: No se ejecuto'
        ];
        // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
        $sql = "UPDATE productos_2 SET eliminado=1 WHERE id = {$Id}";
        if ( $this->conexion->query($sql) ) {
            $this->response['status'] =  "success";
            $this->response['message'] =  "Producto eliminado";
        }
        $this->conexion->close();
    }
}
?>