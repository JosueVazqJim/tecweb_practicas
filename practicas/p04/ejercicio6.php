<!DOCTYPE html PUBLIC “-//W3C//DTD XHTML 1.1//EN” 
“http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd”>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
<?php
    include("ejercicio6_registros.php");

    // Aquí procesas las consultas
    if (isset($_POST['matricula'])) {
        $matricula = $_POST['matricula'];
        if (isset($parqueVehicular[$matricula])) {
            echo "<h3>Información del auto con matrícula $matricula:</h3>";
            print_r($parqueVehicular[$matricula]);
        } else {
            echo "<p>No se encontró ningún auto con la matrícula $matricula.</p>";
        }
    }

    if (isset($_POST['verTodos'])) {
        echo "<h3>Lista de todos los autos registrados:</h3>";
        foreach ($parqueVehicular as $matricula => $infoAuto) { /* Cada elemento consiste en una matrícula 
            (clave) y la información del auto y propietario asociada (valor).*/
            echo "<h4>Matrícula: $matricula</h4>";
            print_r($infoAuto);
            echo "<br>";
        }
    }
?>
    
</body>
</html>