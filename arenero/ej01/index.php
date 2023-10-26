<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        require_once __DIR__ . '/Persona.php';/*llama una vez este archivo*/
        $perl = new Persona;
        $perl->inicializar('Fulano');
        $perl->mostrar();

        $perl2 = new Persona;
        $perl2->inicializar('Mengano');
        $perl2->mostrar();
    ?>
</body>
</html>