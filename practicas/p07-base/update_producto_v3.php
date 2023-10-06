<!DOCTYPE html PUBLIC “-//W3C//DTD XHTML 1.1//EN” 
“http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd”>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

<?php


if (isset($_POST['editarProducto'])) {
    @$link = new mysqli('localhost', 'root', 'Normita1230', 'marketzone');
    if ($link->connect_errno) {
        die('Falló la conexión: ' . $link->connect_error . '<br/>');
    }
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $marca = $_POST['marcas'];
        $modelo = $_POST['modelo'];
        $precio = $_POST['precio'];
        $detalles = $_POST['detalles'];
        $unidades = $_POST['unidades'];
        $imagen = $_POST['imagen'];

        $sql = "UPDATE productos_2 SET nombre = '{$nombre}', marca = '{$marca}', modelo = '{$modelo}', precio = {$precio}, detalles = '{$detalles}', unidades = {$unidades}, imagen = '{$imagen}' WHERE id = {$id}";

    if ($link->query($sql)) {
        echo "Registro editado rey<br>";
        echo 'Producto insertado con ID: ' . $link->insert_id . "<br>";
        echo "Resumen de los datos insertados:<br>";
        echo "Nombre: $nombre<br>";
        echo "Marca: $marca<br>";
        echo "Modelo: $modelo<br>";
        echo "Precio: $precio<br>";
        echo "Detalles: $detalles<br>";
        echo "Unidades: $unidades<br>";
        echo "Imagen: $imagen<br>";
        echo '<a href="http://localhost/tecweb_practicas_PC/practicas/p07-base/get_productos_xhtml_v3.php">Regresar</a>';
    } else {
        echo "Error al insertar en la tabla productos: " . $link->error;
        echo '<a href="http://localhost/tecweb_practicas_PC/practicas/p07-base/get_productos_xhtml_v3.php">Regresar</a>';
    }
    $link->close();
}

?>

</body>
</html>