<?php
/*carga de xml desde cadena*/
$doc = new DOMDocument(); //objeto que usa el dom de xml
$doc->loadXML('<root><node/>hola</root>'); //metodo del dom en forma dinamica
echo $doc->saveXML(); //muestra el xml

/*carga de archivo xml*/
$doc2 = new DOMDocument();
$doc2->load('catalogovod.xml');
echo $doc2->saveXML();

$xml= new DOMDocument();
$documento = file_get_contents('catalogovod.xml');
$xml->loadXML($documento, LIBXML_NOBLANKS);
echo $xml->saveXML();
?>
