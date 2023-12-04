<?php
$xmlFile = new DOMDocument;
$xslFile = new DOMDocument;

$xmlFile->load('catalogovod.xml');
$xslFile->load('prueba_estilos.xsl');

$proc = new XSLTProcessor;
$proc->importStylesheet($xslFile);

// Corregir la variable en la función transformToURI y cambiar la extensión del archivo de salida
$proc->transformToURI($xmlFile, 'vod.html');

/*si no funciona, abrir el php.ini y buscar la linea 
;extension=php_xsl.dll
y eliminar el ;
Pero si no aparece, buscar Dynamic Extensions y poner la linea faltante sin el ;*/
?>
