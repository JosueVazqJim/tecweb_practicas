<!DOCTYPE html PUBLIC “-//W3C//DTD XHTML 1.1//EN” 
“http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd”>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica 4</title>
</head>

<body>
    <?php
        include("p04_funciones.php");
    ?>

    <h2>Ejercicio 1</h2>
    <p>Escribir programa para comprobar si un número es un múltiplo de 5 y 7</p>
    <?php 
        ejercicio1();
    ?>
    
    <h2>Ejercicio 2</h2>
    <p>Crea un programa para la generación repetitiva de 3 números aleatorios hasta obtener una
        secuencia compuesta por: impar, par, impar</p>
    <p>Por ejemplo:</p>
    <table border="1">
        <tr>
            <td>990</td>
            <td>382</td>
            <td>786</td>
        </tr>
        <tr>
            <td>422</td>
            <td>361</td>
            <td>473</td>
        </tr>
        <tr>
            <td>392</td>
            <td>671</td>
            <td>914</td>
        </tr>
        <tr>
            <td style="color: blue;">213</td>
            <td style="color: red">744</td>
            <td style="color: blue;">911</td>
        </tr>
    </table>
    <p>Estos números deben almacenarse en una matriz de Mx3, donde M es el número de filas y
        3 el número de columnas. Al final muestra el número de iteraciones y la cantidad de
        números generados:</p>
    <p>12 números obtenidos en 4 iteraciones</p>
    <form method="post" action="http://localhost/tecweb_practicas_PC/practicas/p04/index.php">
        <input type="submit" name="e2" value="Generar Número Aleatorio">
    </form>
    <?php 
        ejercicio2();
    ?>

    <h2>Ejercicio 3</h2>
    <p>Utiliza un ciclo while para encontrar el primer número entero obtenido aleatoriamente,
        pero que además sea múltiplo de un número dado.</p>
    <ul>
        <li>Crear una variante de este script utilizando el ciclo do-while.</li>
        <li>El número dado se debe obtener vía GET.</li>
    </ul>
    <form action="http://localhost/tecweb_practicas_PC/practicas/p04/index.php" method="get">
        Numero: <input type="text" name="numero"><br>
        <input type="submit" name="e3">
    </form>
    <?php
        ejercicio3();
    ?>

    <h2>Ejercicio 4</h2>
    <p>Crear un arreglo cuyos índices van de 97 a 122 y cuyos valores son las letras de la ‘a’
    a la ‘z’. Usa la función chr(n) que devuelve el caracter cuyo código ASCII es n para poner
    el valor en cada índice. Es decir:</p>
    <ul>
        <li>[97] => a</li>
        <li>[98] => b</li>
        <li>[99] => c</li>
        <li>...</li>
        <li>[122] => z</li>
    </ul>
    <ul>
        <li>Crea el arreglo con un ciclo for</li>
        <li>Lee el arreglo y crea una tabla en XHTML con echo y un ciclo foreach</li>
    </ul>
    <form action="http://localhost/tecweb_practicas_PC/practicas/p04/index.php" method="post">
        <input type="submit" name="e4">
    </form>
    <?php
        ejercicio4();
    ?>

    <h2>Ejercicio 5</h2>
    <p>Usar las variables $edad y $sexo en una instrucción if para identificar una persona de
        sexo “femenino”, cuya edad oscile entre los 18 y 35 años y mostrar un mensaje de
        bienvenida apropiado. Por ejemplo:</p>
    <p>"Bienvenida, usted está en el rango de edad permitido."</p>
    <p>En caso contrario, deberá devolverse otro mensaje indicando el error.</p>
    <ul>
        <li>Los valores para $edad y $sexo se deben obtener por medio de un formulario en HTML.</li>
        <li>Utilizar el la Variable Superglobal $_POST (revisar documentación).</li>
    </ul>
    <form action="ejercicio5.php" method="post">
        <label for="selecgenero">Selecciona un genero:</label>
        <select id="selecgenero" name="genero">
            <option value="masc">Masculino</option>
            <option value="fem">Femenino</option>
        </select>
        <label for="edad">Edad:</label>
        <input type="text" name="edad"><br>
        <input type="submit" name="e5">
    </form>

    <h2>Ejercicio 6</h2>
    <p>Crea en código duro un arreglo asociativo que sirva para registrar el parque vehicular de
    una ciudad. Cada vehículo debe ser identificado por:</p>
    <ul>
        <li>Matricula</li>
        <li>Auto
        <ul>
            <li>Marca</li>
            <li>Modelo(año)</li>
            <li>Tipo (sedan|hachback|camioneta)</li>
        </ul>
        </li>
        <li>Propietario
        <ul>
            <li>Nombre</li>
            <li>Ciudad</li>
            <li>Dirección</li>
        </ul>
        </li>
    </ul>
    <form method="post" action="ejercicio6.php">
        <label for="matricula">Matricula:</label>
        <input type="text" name="matricula"><br>
        <label>Auto</label><br>
        <label for="marca">Marca:</label>
        <input type="text" name="marca"><br>
        <label for="modelo">Modelo:</label>
        <input type="text" name="modelo"><br>
        <label for="tipo">Tipo:</label>
        <select id="tipo" name="tipo">
            <option value="sedan">Sedan</option>
            <option value="hachback">Hachback</option>
            <option value="camioneta">Camioneta</option>
        </select> <br>
        <label>Propietario</label><br>
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre"><br>
        <label for="ciudad">Ciudad:</label>
        <input type="text" name="ciudad"><br>
        <label for="direccion">Direccion:</label>
        <input type="text" name="direccion"><br>
        <input type="submit" name="registro" value="Registrar">
    </form>
    
    <form method="post" action="ejercicio6.php">
        <input type="submit" name="verTodos" value="Ver todos los autos registrados">
    </form>

    <form method="post" action="ejercicio6.php">
        <label for="matricula">Consultar por matrícula:</label>
        <input type="text" id="matricula" name="matricula">
        <input type="submit" name="consultaMatricula" value="Consultar">
    </form>
</body>
</html>