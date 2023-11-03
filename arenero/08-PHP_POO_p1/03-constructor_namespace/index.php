<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        use EJEMPLOS\POO\Cabecera2 as Cabecera;
        /*Estás importando el espacio de nombres EJEMPLOS\POO\Cabecera2 y asignando un alias Cabecera. A partir 
        de ese punto en tu archivo, puedes utilizar Cabecera en lugar de EJEMPLOS\POO\Cabecera2 para crear instancias de 
        las clases definidas en ese espacio de nombres. */
        require_once __DIR__ . '/Cabecera.php';

        $cab1 = new Cabecera('El rincón del Programador', 'center', 'https://wwww.twitter.com');
        $cab1->graficar();
    ?>

</body>
</html>