<?php
namespace Webtechnologies\Update;
require_once __DIR__ . '/../../start.php';
use Webtechnologies\API\DataBase;

class Actualizar extends DataBase{
    public function __construct($nombreBD = 'marketzone'){
        parent::__construct($nombreBD);
    }

    public function edit($Producto){
        $this->response = [
            'status' => 'error',
            'message' => 'La consulta falló'
        ];
        
        // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
        $sql =  "UPDATE productos_2 SET nombre='{$Producto->nombre}', marca='{$Producto->marca}',";
        $sql .= "modelo='{$Producto->modelo}', precio={$Producto->precio}, detalles='{$Producto->detalles}',"; 
        $sql .= "unidades={$Producto->unidades}, imagen='{$Producto->imagen}' WHERE id={$Producto->id}";
        $this->conexion->set_charset("utf8");
        if ( $this->conexion->query($sql) ) {
            $this->response['status'] =  "success";
            $this->response['message'] =  "Producto actualizado";
        }
        $this->conexion->close();
    }
}
?>