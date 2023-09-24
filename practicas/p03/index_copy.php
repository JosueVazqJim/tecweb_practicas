<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Document</title>
</head>
<body>
    <h2>Ejercicio 1</h2>
    <p>Determina cuál de las siguientes variables son válidas y explica por qué:</p>
    <p>$_myvar, $_7var, myvar, $myvar, $var7, $_element1, $house*5</p>
    <?php
        //aqui va mi codigo php
        $_myvar;
        $_7var;
        //myvar; //invalida
        $myvar;
        $var7;
        $_element1;
        //$house*5; //invalida

        echo '<ul>';
        echo '<li>$_myvar es valida porque inicia con guion bajo.</li>';
        echo '<li>$_7var es valida porque inicia con guion bajo.</li>';
        echo '<li>$myvar es valida porque inicia con una letra.</li>';
        echo '<li>$var7 es valida porque inicia con una letra.</li>';
        echo '<li>$_element1 es valida porque inicia con un guion bajo.</li>';

        echo '</ul>';

        unset($_myvar, $_7var, $myvar, $var7, $_element1)
    ?>

    <h2>Ejercicio 2</h2>
    <p>Proporcionar los valores de $a, $b, $c como sigue:</p>
    <ul>
        <li>$a = “ManejadorSQL”;</li>
        <li>$b = 'MySQL’;</li>
        <li>$c = &amp;a;</li>
    </ul>
    <p>a. Ahora muestra el contenido de cada variable</p>
    <?php
        unset($a, $b, $c);
        $a = "ManejadorSQL";
        $b = 'MySql';
        $c = &$a;

        echo "\$a: $a";
        echo '<br>';
        echo "\$b: $b";
        echo '<br>';
        echo "\$c: $c";
    ?>
    <p>b. Agrega al código actual las siguientes asignaciones:</p>
    <ul>
        <li>$a = “PHP server”;</li>
        <li>$c = &amp;a;</li>
    </ul>
    <?php
        $a = "PHP server";
        $b = &$a;
    ?>
    <p>c. Vuelve a mostrar el contenido de cada uno</p>
    <?php
        echo "\$a: $a";
        echo '<br>';
        echo "\$b: $b";
        echo '<br>';
        echo "\$c: $c";
        unset($a, $b, $c); /*eliminar de la memoria*/
    ?>
    <p>d. Describe en y muestra en la página obtenida qué ocurrió en el segundo bloque de
    asignaciones</p>
    <p>En el punto a, el uso de comillas no es tan importante en este ejemplo,
        pero el uso &amp; es que apunta a la direccion de memoria de la variable a. 
        Entonces si se modifica a se modifica por consecuente b.
    </p>

    
    <h2>Ejercicio 3</h2>
    <p>3. Muestra el contenido de cada variable inmediatamente después de cada asignación,
    verificar la evolución del tipo de estas variables (imprime todos los componentes de los
    arreglo):</p>
    <ul>
        <li>$a = “PHP5”;</li>
        <li>$z[] = &amp;a;</li>
        <li>$b = “5a version de PHP”;</li>
        <li>$c = $b*10;</li>
        <li>$a .= $b;</li>
        <li>$b *= $c;</li>
        <li>$z[0] = “MySQL”;</li>
    </ul>
    <p>Evolucion</p>
    <?php
        $a = "PHP5";
        echo "Primera asignacion \$a = \"PHP5\"; <br>";
        echo "\$a: $a"; /*solo se le agrega una cadena a $a */
        echo '<br><br>';

        $z[] = &$a; /*z es una arreglo, en su primer espacio que es 0 almacena la direccion de memoria
        de la variale $a*/
        echo "Segunda asignacion \$z[] = &\$a; <br>";
        echo "\$z[]:"; print_r($z); /*print_r($z); muestra todos los componentes del arreglo*/
        echo '<br>';
        echo "\$a: $a";
        echo '<br><br>';

        $b = "5a version de PHP"; /*solo se le agrega una cadena a $b */
        echo "Tercer asignacion \$b = \"5a version de PHP\"; <br>";
        echo "\$b: $b";
        echo '<br>';

        @$c = $b*10; /*en $c se le trata de asignar el resultado de la operacion de tratar de convertir 
        lo que tiene $b a numero y multiplicarlo por 10. $b inicia con un 5, entonces ese es el numero que agarra
        y multiplica*/
        echo "Cuarta asignacion \$c = \$b*10; <br>";
        echo "\$c: $c";
        echo '<br>';
        echo "\$b: $b";
        echo '<br><br>';

        $a .= $b; /*Concatena lo que hay en $a con $b*/
        echo "Quinta asignacion \$a .= \$b; <br>";
        echo "\$a: $a";
        echo '<br>';
        echo "\$b: $b";
        echo '<br>';

        @$b *= $c; /*Vuelve a tratar de hacer una conversion pero se toma el 5 de $b y lo multiolica por el 50 de 
        $cS*/
        echo "Sexta asignacion \$b *= \$c; <br>";
        echo "\$b: $b";
        echo '<br>';
        echo "\$c: $c";
        echo '<br><br>';

        $z[0] = "MySQL"; /*Se cambia lo que habia en la posicion 0 de $z, tenia la direccion de $a, pero
        tambien $a se modifico por lo mismo*/
        echo "Septima asignacion \$z[0] = \"MySQL\"; <br>";
        echo "\$z[]: ";
        print_r($z);
        echo '<br>';
        echo "\$a: $a";
        echo '<br>s';
        unset($a, $b, $c, $z);
    ?>

    <h2>Ejercicio 4</h2>
    <p>Lee y muestra los valores de las variables del ejercicio anterior, pero ahora con la ayuda de  la matriz $GLOBALS o del modificador 
    global de PHP.</p>
    <?php
        $a = "PHP5";
        echo "Primera asignacion \$a = \"PHP5\"; <br>";
        echo "\$a: " . $GLOBALS['a'];
        echo '<br><br>';
        
        $z[] = &$a;
        echo "Segunda asignacion \$z[] = &\$a; <br>";
        echo "\$z[]: ";
        print_r($z);
        echo '<br>';
        echo "\$a: " . $GLOBALS['a'];
        echo '<br><br>';
        
        $b = "5a version de PHP";
        echo "Tercer asignacion \$b = \"5a version de PHP\"; <br>";
        echo "\$b: " . $GLOBALS['b'];
        echo '<br>';
        
        @$c = $b * 10;
        echo "Cuarta asignacion \$c = \$b*10; <br>";
        echo "\$c: " . $GLOBALS['c'];
        echo '<br>';
        echo "\$b: " . $GLOBALS['b'];
        echo '<br><br>';
        
        $a .= $b;
        echo "Quinta asignacion \$a .= \$b; <br>";
        echo "\$a: " . $GLOBALS['a'];
        echo '<br>';
        echo "\$b: " . $GLOBALS['b'];
        echo '<br>';
        
        @$b *= $c;
        echo "Sexta asignacion \$b *= \$c; <br>";
        echo "\$b: " . $GLOBALS['b'];
        echo '<br>';
        echo "\$c: " . $GLOBALS['c'];
        echo '<br><br>';
        
        $z[0] = "MySQL";
        echo "Septima asignacion \$z[0] = \"MySQL\"; <br>";
        echo "\$z[]: ";
        print_r($z);
        echo '<br>';
        echo "\$a: " . $GLOBALS['a'];
        echo '<br>';
        
        unset($a, $b, $c, $z);
    ?>

    <h2> Ejercicio 5 </h2>
    <p>5. Dar el valor de las variables $a, $b, $c al final del siguiente script: </p>

    <ul>
        <li>$a = “7 personas”; </li> <!--se le da una cadena a $a-->
        <li>$b = (integer) $a; </li> <!--en $b se trata de almacenar el valor de la conversion de $a a entero. $b = 7-->
        <li>$a = “9E3”; </li> <!--cambia el valor de $a a otra cadena 9E3-->
        <li>$c = (double) $a; </li> <!--en $c se trata de almacenar el valor de la conversion de 9E3 a un float. 9E3 es la notacion
        cientifica de 9000-->
    </ul>

    <ul>
        <li>Para $a, su valor final es 9E3.</li>
        <li>Para $b, su valor final es 7. Luego de convertir a entero la cadena inicial de $a que es "7 perosnas".</li>
        <li>Para $c, su valor final es 9000, pues trata de convertir la cadena 9E3(notacion cientifica) a un double.</li>
    </ul>

    <h2>Ejercicio 6</h2>
    <p>Dar y comprobar el valor booleano de las variables $a, $b, $c, $d, $e y $f y muéstralas usando la función var_dump(). </p>
    <p>Después investiga una función de PHP que permita transformar el valor booleano de $c y $e  en uno que se pueda mostrar con un echo: </p>
    <ul>
        <li>$a = "0";</li> 
        <li>$b = "TRUE";</li>
        <li>$c = FALSE;</li>
        <li>$d = ($a OR $b);</li>
        <li>$e = ($a AND $c);</li>
        <li>$f = ($a XOR $b);</li>
    </ul>
    <?php
        $a = "0"; /* */
        $b = "TRUE";
        $c = "FALSE";
        $d = ($a OR $b); /*$a es una cadena no vacia, tampoco $b, pero se supone que php toma a $b como un 
        booleano true*/
        $e = ($a AND $c); /*Esto mismo pasa aca, $a tiene algo dentro, es true, pero $c dice explicitamente
        false, por lo tanto $e es un booleano falso*/
        $f = ($a XOR $b); 

        echo "\$a = \"0\" es: ";
        if(is_bool($a)){
            echo "Booleano \t| ";
        }
        else{
            echo "No Booleano \t| ";
        }
        var_dump($a);
        echo "<br>";

        echo "\$b = \"TRUE\" es: ";
        if(is_bool($b)){
            echo "Booleano \t| ";
        }
        else{
            echo "No Booleano \t| ";
        }
        var_dump($b);
        echo "<br>";

        echo "\$c = \"FALSE\" es: ";
        if(is_bool($c)){
            echo "Booleano \t| ";
        }
        else{
            echo "No Booleano \t| ";
        }
        var_dump($c);
        echo "<br>";

        echo "\$d = (\$a OR \$b) es: ";
        if(is_bool($d)){
            echo "Booleano \t| ";
        }
        else{
            echo "No Booleano \t| ";
        }
        var_dump($d);
        echo "<br>";

        echo "\$e = (\$a AND \$c) es: ";
        if(is_bool($e)){
            echo "Booleano \t| ";
        }
        else{
            echo "No Booleano \t| ";
        }
        var_dump($e);
        echo "<br>";

        echo "\$f = (\$a XOR \$b) es: ";
        if(is_bool($f)){
            echo "Booleano \t| ";
        }
        else{
            echo "No Booleano \t| ";
        }
        var_dump($f);
        echo "<br><br>";

        echo "Para convertir \$c y a \$e a valores que se puedan mostrar con un echo, se usa la funcion
        settype, y se les cambia a integer <br>";
        settype($c, "integer");
        settype($e, "integer");
        echo "settype(\$c, \"integer\"): $c <br>";
        echo "settype(\$e, \"integer\"): $e <br>";
        echo "Ambos dan 0 pues son FALSE. FALSE corresponde a 0 y TRUE a 1 <br>";

        unset($a, $b, $c, $d, $e, $f);
    ?>

    <h2>Ejercicio 7</h2>
    <p>7. Usando la variable predefinida $_SERVER, determina lo siguiente: </p>
    <ol>
        <li>La versión de Apache y PHP,</li>
        <li>El nombre del sistema operativo (servidor),</li> 
        <li>El idioma del navegador (cliente).</li>
    </ol>
    <?php
        echo "a. Version de Apache y PHP: <br> \$_SERVER['SERVER_SIGNATURE']" .$_SERVER['SERVER_SIGNATURE'];
        echo "b. nombre del sistema operativo (servidor): <br> \$_SERVER['SERVER_NAME'] <br>" .$_SERVER['SERVER_NAME']. "<br>";
        echo "c. idioma del navegador del cliente: <br> \$_SERVER['HTTP_ACCEPT_LANGUAGE'] <br>" .$_SERVER['HTTP_ACCEPT_LANGUAGE']. "<br>";
    ?>
    <p>
        <a href="http://validator.w3.org/check?uri=referer"><img
        src="http://www.w3.org/Icons/valid-xhtml11" alt="Valid XHTML 1.1" height="31" width="88" /></a>
    </p>
</body>
</html>