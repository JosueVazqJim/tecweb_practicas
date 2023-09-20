<!DOCTYPE html PUBLIC “-//W3C//DTD XHTML 1.1//EN” 
“http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd”>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<?php
    $data = array();
    if(isset($_GET['tope']))
        $tope = $_GET['tope'];

    if (!empty($tope))
    {
        /** SE CREA EL OBJETO DE CONEXION */
        @$link = new mysqli('localhost', 'root', 'Normita1230', 'marketzone');	

        /** comprobar la conexión */
        if ($link->connect_errno) 
        {
            die('Falló la conexión: '.$link->connect_error.'<br/>');
                /** NOTA: con @ se suprime el Warning para gestionar el error por medio de código */
        }

        /** Crear una tabla que no devuelve un conjunto de resultados si es que esta el id*/
        if ( $result = $link->query("SELECT * FROM productos WHERE unidades <= $tope") ) 
        {
            $row = $result->fetch_all(MYSQLI_ASSOC);
            
            $result->free();
        }

        $link->close();
    }
?>

<body>
    <table class="table">
        <thead class="thead-dark">
            <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Marca</th>
            <th scope="col">Modelo</th>
            <th scope="col">Precio</th>
            <th scope="col">Unidades</th>
            <th scope="col">Detalles</th>
            <th scope="col">Imagen</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php 
                    foreach ($row as $registro) {
                        echo '<tr>';
                        echo '<td>' . $registro['id'] . '</td>';
                        echo '<td>' . $registro['nombre'] . '</td>';
                        echo '<td>' . $registro['unidades'] . '</td>';
                        echo '<td>' . $registro['modelo'] . '</td>';
                        echo '<td>' . $registro['precio'] . '</td>';
                        echo '<td>' . $registro['unidades'] . '</td>';
                        echo '<td>' . $registro['detalles'] . '</td>';
                        echo '<td><img src="' . $registro['imagen'] . '"></td>';
                    }
                ?>
                
            </tr>
        </tbody>
    </table>

</body>
	
</html>