<!DOCTYPE html PUBLIC “-//W3C//DTD XHTML 1.1//EN” 
“http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd”>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

<?php


if (isset($_POST['registroProducto'])) {
    @$link = new mysqli('localhost', 'root', 'Normita1230', 'marketzone');
    if ($link->connect_errno) {
        die('Falló la conexión: ' . $link->connect_error . '<br/>');
    }

    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $precio = $_POST['precio'];
    $detalles = $_POST['detalles'];
    $unidades = $_POST['unidades'];
    $imagen = $_POST['imagen'];
    
    /* primero checa que no esten vacios los campos*/
    if (empty($nombre) || empty($marca) || empty($modelo) || empty($precio) || empty($detalles) || empty($unidades) || empty($imagen)) {
        echo "Error: Todos los campos son obligatorios.";
        echo '<a href="formulario_productos.php">Regresar</a>';
    }
    else{
        /* is_numeric($precio) verifica si el valor de $precio es numérico 
        !preg_match('/^\d+(\.\d+)?$/', $precio) analiza la expresion regularde $precio*/
        if (!is_numeric($precio) || !preg_match('/^\d+(\.\d+)?$/', $precio)) {
            echo "Error: El precio debe ser un número válido con punto decimal (por ejemplo, 10.99).";
            echo '<a href="formulario_productos.php">Regresar</a>';
        } 
        /*comprueba que unidades es un entero*/
        elseif (!ctype_digit($unidades)) {
            echo "Error: Las unidades deben ser un número entero.";
            echo '<a href="formulario_productos.php">Regresar</a>';
        }  
        else{
            // Validar longitud de campos nombre, marca, modelo, detalles e imagen de acuerdo a la base de datos
            if (strlen($nombre) > 100 || strlen($marca) > 25 || strlen($modelo) > 25 || strlen($detalles) > 250 || strlen($imagen) > 100) {
                echo "Error: Uno o más campos exceden la longitud permitida.";
                echo '<a href="formulario_productos.php">Regresar</a>';
            } 
            else{
                $sql = "INSERT INTO productos VALUES (null, '{$nombre}', '{$marca}', '{$modelo}', {$precio}, '{$detalles}', {$unidades}, '{$imagen}', 0)";

                if ($link->query($sql)) {
                    echo "Nuevo registro creado rey<br>";
                    echo 'Producto insertado con ID: ' . $link->insert_id . "<br>";
                    echo "Resumen de los datos insertados:<br>";
                    echo "Nombre: $nombre<br>";
                    echo "Marca: $marca<br>";
                    echo "Modelo: $modelo<br>";
                    echo "Precio: $precio<br>";
                    echo "Detalles: $detalles<br>";
                    echo "Unidades: $unidades<br>";
                    echo "Imagen: $imagen<br>";
                    echo '<a href="formulario_productos.php">Regresar</a>';
                } else {
                    echo "Error al insertar en la tabla productos: " . $link->error;
                    echo '<a href="formulario_productos.php">Regresar</a>';
                }
                $link->close();
            }
            
        }
    }
}

?>

</body>
</html>