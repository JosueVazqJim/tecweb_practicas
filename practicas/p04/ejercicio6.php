<?php
session_start();
?>

<!DOCTYPE html PUBLIC “-//W3C//DTD XHTML 1.1//EN” 
“http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd”>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

<?php
    if (!isset($_SESSION['parqueVehicular'])) {
        $_SESSION['parqueVehicular'] = array();
    }
    if (isset($_POST['registro'])) {
        $matricula = $_POST["matricula"];
        if (array_key_exists($matricula, $_SESSION['parqueVehicular'])) {
            echo "La matrícula $matricula ya está registrada. Por favor, ingresa una matrícula única.";
            echo "<br>";
            echo '<a href="index.php">Registrar otro vehículo</a>';
        } else {
            $marca = $_POST["marca"];
            $modelo = $_POST["modelo"];
            $tipo = $_POST["tipo"];
            $nombre = $_POST["nombre"];
            $ciudad = $_POST["ciudad"];
            $direccion = $_POST["direccion"];

            if (!preg_match("/^[A-Z]{3}[0-9]{4}$/", $matricula)) {
                echo "Formato de matrícula inválido. Debe ser en el formato LLLNNNN (por ejemplo, ABC1234).";
                echo "<br>";
                echo '<a href="index.php">Registrar otro vehículo</a>';
            } else {
                $vehiculoNuevo = array(
                    'Auto' => array(
                        'Marca' => $marca,
                        'Modelo' => $modelo,
                        'Tipo' => $tipo
                    ),
                    'Propietario' => array(
                        'Nombre' => $nombre,
                        'Ciudad' => $ciudad,
                        'Dirección' => $direccion
                    )
                );
        
                // Agregar el nuevo vehículo al parque vehicular (esto podría estar en otro archivo)
                $_SESSION['parqueVehicular'][$matricula] = $vehiculoNuevo;
        
                echo "Vehículo registrado con éxito.";
                echo '<a href="index.php">Registrar otro vehículo</a>';
            }
        }
    }

    if (isset($_POST['verTodos'])) {
        $parqueVehicular = $_SESSION['parqueVehicular'];
        echo "<h3>Lista de todos los autos registrados:</h3>";
        echo "<br>";
        echo '<a href="index.php">Registrar otro vehículo</a>';
        echo '<pre>';
        print_r($parqueVehicular);
        echo '</pre>';
    }

    if (isset($_POST['consultaMatricula'])) {
        $parqueVehicular = $_SESSION['parqueVehicular'];
        $matricula = $_POST['matricula'];
        if (isset($parqueVehicular[$matricula])) {
            echo "<h3>Información del auto con matrícula $matricula:</h3>";
            echo "<br>";
            echo '<a href="index.php">Registrar otro vehículo</a>';
            echo "<br>";
            print_r($parqueVehicular[$matricula]);
        } else {
            echo "<p>No se encontró ningún auto con la matrícula $matricula.</p>";
            echo "<br>";
            echo '<a href="index.php">Registrar otro vehículo</a>';
        }
    }
?>


    
</body>
</html>