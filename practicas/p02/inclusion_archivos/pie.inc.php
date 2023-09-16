<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<body>
<hr/>
    <?php
    echo "<div><h1 style=\"border-width:3;border-style:groove; background-color:
    #ffcc99;\"> Final de la página PHP Vínculos útiles : <a href=\"php.net\">php.net</a>
    &nbsp; <a href=\"mysql.org\">mysql.org</a></h1>";
    echo "Nombre del archivo ejecutado: ", $_SERVER['PHP_SELF'],"&nbsp;&nbsp; &nbsp;";
    echo "Nombre del archivo incluido: ", __FILE__ ,"</div>";
    ?>
</body>
</html>