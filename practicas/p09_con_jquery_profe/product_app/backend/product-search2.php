<?php
include_once __DIR__.'/database.php';

// SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
$data = array();
$data2 = array(
    'status'  => 'success',
    'message' => 'Búsqueda exitosa, no se encontraron productos similares.'
);

// SE VERIFICA HABER RECIBIDO EL NOMBRE DE BÚSQUEDA
if (isset($_GET['name'])) {
    $search = $_GET['name'];

    // SE REALIZA LA QUERY DE BÚSQUEDA
    $sql = "SELECT * FROM productos_2 WHERE nombre = '$search'";

    $conexion->set_charset("utf8");

    if ($result = $conexion->query($sql)) {
        // SE OBTIENEN LOS RESULTADOS
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        if (!is_null($rows) && count($rows) > 0) {
            // Se encontraron productos similares
            $data2['message'] = 'Se encontraron productos similares.';
            // Puedes incluir aquí la lógica para agregar los productos encontrados a $data si deseas mostrarlos.
        }
        $result->free();
    }

    $conexion->close();
}

// SE HACE LA CONVERSIÓN DE ARRAY A JSON
echo json_encode($data2, JSON_PRETTY_PRINT);
?>
