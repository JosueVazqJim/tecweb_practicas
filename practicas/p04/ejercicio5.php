<!DOCTYPE html PUBLIC “-//W3C//DTD XHTML 1.1//EN” 
“http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd”>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
<?php
    if (isset($_POST['e5'])) {
        if (isset($_POST['edad']) && isset($_POST['genero'])) {
            $genero = $_POST['genero'];
            $edad = $_POST['edad'];

            if ($genero === "fem" && $edad >= 18 && $edad <= 35) {
                echo "Bienvenida, usted está en el rango de edad permitido.";
                echo "<br>";
                echo '<a href="index.php">Regresar</a>';
            } else {
                echo "Usted no cumple con el perfil.";
                echo "<br>";
                echo '<a href="index.php">Regresar</a>';
            }
            unset($edad, $genero);
        }
    }
?>
    
</body>
</html>