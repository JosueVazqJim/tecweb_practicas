<!DOCTYPE html PUBLIC “-//W3C//DTD XHTML 1.1//EN” 
“http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd”>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
<?php
    function ejercicio1() {
        if(isset($_GET['numero'])){
            $num = $_GET['numero'];
            if ($num%5==0 && $num%7==0){
                echo '<h3>R= El número '.$num.' SÍ es múltiplo de 5 y 7.</h3>';
            }
            else{
                echo '<h3>R= El número '.$num.' NO es múltiplo de 5 y 7.</h3>';
            }
        }
        unset($num);
    }

    function ejercicio2(){
        if (isset($_POST['e2'])) {
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
    }

    function ejercicio3(){
        if (isset($_GET['e3'])) {
            if(isset($_GET['numero'])){
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

                echo "<h4><h4>Variante con do-while</h4>";
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
            }else{
                echo"no hay";
            }
            
        }
    }

    function ejercicio4(){
        if (isset($_POST['e4'])) {
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
        }
    }
?>
    
</body>
</html>