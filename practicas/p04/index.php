<!DOCTYPE html PUBLIC “-//W3C//DTD XHTML 1.1//EN”
“http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd”>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica 4</title>
</head>
<body>
    <h2>Ejercicio 1</h2>
    <p>Escribir programa para comprobar si un número es un múltiplo de 5 y 7</p>
    <?php
        if(isset($_GET['numero']))
        {
            $num = $_GET['numero'];
            if ($num%5==0 && $num%7==0)
            {
                echo '<h3>R= El número '.$num.' SÍ es múltiplo de 5 y 7.</h3>';
            }
            else
            {
                echo '<h3>R= El número '.$num.' NO es múltiplo de 5 y 7.</h3>';
            }
        }
        unset($num);
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
    <form method="post">
        <input type="submit" name="generar" value="Generar Número Aleatorio">
    </form>

    <?php
        if (isset($_POST['generar'])) {
            // Función para generar un número aleatorio entre 1 y 100
            function generarNumeroAleatorio() {
                return rand(100, 999);
            }

            $secuencia = false;
            $iteraciones = 0;
            $matrizIteraciones = [];

            // Genera números aleatorios y verifica la secuencia
            do {
                $numero1 = generarNumeroAleatorio();
                $numero2 = generarNumeroAleatorio();
                $numero3 = generarNumeroAleatorio();

                if ($numero1 % 2 != 0 && $numero2 % 2 == 0 && $numero3 % 2 != 0) {
                    $secuencia = true;
                }

                $matrizIteraciones[] = [$numero1, $numero2, $numero3];
                $iteraciones++;

            } while (!$secuencia); // Repite hasta encontrar al menos una secuencia

            // Muestra la matriz de iteraciones
            echo '<table border="1">';
                /*se inicia el bucle foreach que recorre cada elemento de la matriz y cada elemento de la matriz es una fila*/
                foreach ($matrizIteraciones as $fila) {
                    echo '<tr>'; /*Esto marca el comienzo de una nueva fila en la tabla.*/
                    foreach ($fila as $numero) { /*al recorrer cada fila, se sacan los numeros y se ponen como elementos*/
                        echo '<td>' . $numero . '</td>'; /*se vancreando celdas y se le va poniendo su numero*/
                    }
                    echo '</tr>';
                }
            echo '</table>';

            // Muestra el número de iteraciones y la cantidad de números generados
            echo '<p>Número de Iteraciones: ' . $iteraciones . '</p>';
            echo '<p>Cantidad de Números Generados: ' . ($iteraciones * 3) . '</p>';
        }
        unset($secuencia, $iteraciones, $matrizIteraciones, $numero1, $numero2, $numero3, $fila, $numero);
    ?>

    <h2>Ejercicio 3</h2>
    <p>Utiliza un ciclo while para encontrar el primer número entero obtenido aleatoriamente,
        pero que además sea múltiplo de un número dado.</p>
    <ul>
        <li>Crear una variante de este script utilizando el ciclo do-while.</li>
        <li>El número dado se debe obtener vía GET.</li>
    </ul>

    <form action="index.php" method="get">
        Numero: <input type="text" name="numero"><br>
        <input type="submit" name="e3">
    </form>
    <?php 
        if (isset($_POST['e3'])) {
            $num = $_GET["numero"];
            $bandera = false;
            $numeroAleatorio = null;

            while(!$bandera){
                $numeroAleatorio = rand(0, 1000);

                // Verificar si el número aleatorio es múltiplo del número dado
                if ($numeroAleatorio % $num == 0) {
                    $bandera = true;
                }
            }
            echo "El primer múltiplo de $num obtenido aleatoriamente es: $numeroAleatorio";
            unset($num, $bandera, $numeroAleatorio);
        }
    ?>

    <h4>Variante con do-while</h4>
    <?php 
        if (isset($_POST['e3'])) {
            $num = $_GET["numero"];
            $bandera = false;
            $numeroAleatorio = null;

            do {
                $numeroAleatorio = rand(0, 1000);
            
                // Verificar si el número aleatorio es múltiplo del número dado
                if ($numeroAleatorio % $num == 0) {
                    $bandera = true;
                }
            } while (!$bandera);
            echo "El primer múltiplo de $num obtenido aleatoriamente es: $numeroAleatorio";
            unset($num, $bandera, $numeroAleatorio);
        }  
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

    <?php
        $arreglo = [];

        for($i = 97; $i <= 122; $i++){
            $letra = chr($i);
            $arreglo[$i] = $letra;
        }
        echo '<table border="1">';
            echo '<tr><th>Índice</th> <th>Valor</th></tr>';

            foreach ($arreglo as $indice => $valor) {
                /*se va recorriendo el arreglo, y se toman el indice y su valor correspondiente*/
                echo '<tr>';
                echo '<td>' . $indice . '</td>';
                echo '<td>' . $valor . '</td>';
                echo '</tr>';
            }

        echo '</table>';

        unset($arreglo, $i, $letra, $indice, $valor);
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

    <form method="post">
        <label for="selecgenero">Selecciona un genero:</label>
        <select id="selecgenero" name="genero">
            <option value="masc">Masculino</option>
            <option value="fem">Femenino</option>
        </select>
        Edad: <input type="text" name="edad"><br>
        <input type="submit" name="e5">
    </form>

    <?php
        if (isset($_POST['e5'])) {
            $genero = $_POST['genero'];
            $edad = $_POST['edad'];

            if ($genero === "fem" && $edad >= 18 && $edad <= 35) {
                echo "Bienvenida, usted está en el rango de edad permitido.";
            } else {
                echo "Usted no cumple con el perfil.";
            }
            unset($edad, $genero);
        }
    ?>

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

    <?php
        $parqueVehicular = [];
        $matricula = '';
           


        for ($i = 1000; $i <= 1015; $i++) {
            $matricula = 'ABC' . $i;
            /*este ciclo evita que se repitan matriculas*/
            /*while (isset($parqueVehicular[$matricula])) 
                $matricula = generarMatricula();
            }*/
        
            $marca = 'Marca' . $i;
            $modelo = 2020 + $i;
            $tipo = ($i % 3 == 0) ? 'hatchback' : (($i % 2 == 0) ? 'sedan' : 'camioneta');
        
            $nombre = 'Propietario' . $i;
            $ciudad = 'Ciudad' . $i;
            $direccion = 'Dirección' . $i;
        

            $parqueVehicular[$matricula] = array(
                'Matricula' => $matricula,
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
        }
        echo '<pre>';
            print_r($parqueVehicular);
            echo '</pre>';
    ?>

    <form method="post">
        <label for="matricula">Consultar por matrícula:</label>
        <input type="text" id="matricula" name="matricula">
        <input type="submit" name="consultaMatricula" value="Consultar">
    </form>
    <form method="post">
        <input type="submit" name="verTodos" value="Ver todos los autos registrados">
    </form>
    <?php
        // Aquí procesas las consultas
        if (isset($_POST['consultaMatricula'])) {
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