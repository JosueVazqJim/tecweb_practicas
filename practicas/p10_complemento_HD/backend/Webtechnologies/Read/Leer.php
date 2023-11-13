<?php
namespace Webtechnologies\Read;
require_once __DIR__ . '/../../start.php';
use Webtechnologies\API\DataBase;

class Leer extends DataBase{
    public function __construct($nombreBD = 'marketzone'){
        parent::__construct($nombreBD);
    }

    public function list(){
        // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
        $sql = "SELECT * FROM productos_2 WHERE eliminado = 0";
        $result = $this->conexion->query($sql);
        // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
        if ($result) {
            // SE OBTIENEN LOS RESULTADOS
            $rows = $result->fetch_all(MYSQLI_ASSOC);

            if(!is_null($rows)) {
                // SE CODIFICAN A UTF-8 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
                foreach($rows as $num => $row) {
                    foreach($row as $key => $value) {
                        $this->response[$num][$key] = utf8_encode($value);
                    }
                }
            }
            $result->free();
        } else {
            die('Query Error');
        }
        $this->conexion->close();
    }

    public function search($Coincidencia){
        $sql = "SELECT * FROM productos_2 WHERE (id = '{$Coincidencia}' OR nombre LIKE '%{$Coincidencia}%' OR marca LIKE '%{$Coincidencia}%' OR detalles LIKE '%{$Coincidencia}%') AND eliminado = 0";
        if ( $result = $this->conexion->query($sql) ) {
            // SE OBTIENEN LOS RESULTADOS
            $rows = $result->fetch_all(MYSQLI_ASSOC);

            if(!is_null($rows)) {
                // SE CODIFICAN A UTF-8 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
                foreach($rows as $num => $row) {
                    foreach($row as $key => $value) {
                        $this->response[$num][$key] = utf8_encode($value);
                    }
                }
            }
            $result->free();
        } else {
            die('Query Error: ');
        }
        $this->conexion->close();
    }

    public function single($Id){ /*ESTE SE USA JUNTO CON EL DE EDITAR, PRIMERO SE USA ESTE PRRA ONSULTAR EL REGISTRO A EDITAR */
        // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
        if ( $result = $this->conexion->query("SELECT * FROM productos_2 WHERE id = {$Id}") ) {
            // SE OBTIENEN LOS RESULTADOS
            $row = $result->fetch_assoc();

            if(!is_null($row)) {
                // SE CODIFICAN A UTF-8 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
                foreach($row as $key => $value) {
                    $this->response[$key] = utf8_encode($value);
                }
            }
            $result->free();
        } else {
            die('Query Error: ');
        }
        $this->conexion->close();
    }

    public function singleByName($Nombre){ /*este se usa cuando se quiereagregar un nuevo producto, y busca en la bD si hay coincidencias*/
        $this->response = [
            'status'  => 'success',
            'message' => 'Búsqueda exitosa, no se encontraron productos similares.'
        ];
        // SE REALIZA LA QUERY DE BÚSQUEDA
        $sql = "SELECT * FROM productos_2 WHERE nombre = '$Nombre'";
        $this->conexion->set_charset("utf8");
        if ($result = $this->conexion->query($sql)) {
            // SE OBTIENEN LOS RESULTADOS
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            if (!is_null($rows) && count($rows) > 0) {
                // Se encontraron productos similares
                $this->response['message'] = 'Se encontraron productos similares.';
            }
            $result->free();
        }
        $this->conexion->close();
    }
}
?>