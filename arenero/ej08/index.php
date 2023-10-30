<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        require_once __DIR__ . '/Operacion.php';
        $sum1 = new Suma; /*se inicializa valor1 y valor2 con 0*/
        $sum1->setValor1(10);/*usa metoo de superclase*/
        $sum1->setValor2(5);
        $sum1->operar();/*usa su propio metodo*/
        echo '10 + 5 = ' .$sum1->getResultado() . '<br>';
        
        $res1 = new Resta; /*se inicializa valor1 y valor2 con 0*/
        $res1->setValor1(10);/*usa metoo de superclase*/
        $res1->setValor2(5);
        $res1->operar();/*usa su propio metodo*/
        echo '10 - 5 = ' .$res1->getResultado();
    ?>
</body>
</html>