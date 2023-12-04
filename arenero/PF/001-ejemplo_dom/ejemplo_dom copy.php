<?php

$dom = new DOMDocument;
$dom->load('ejemplo.xml');

// Obtener todos los elementos 'contact'
$contacts = $dom->getElementsByTagName('contact');

// Iterar sobre la lista de elementos 'contact'
foreach ($contacts as $contact) {
    // Imprimir el valor del elemento 'contact'
    echo $contact->nodeValue, PHP_EOL;

    // Crear y agregar un nuevo elemento 'extra'
    $extra = $dom->createElement('extra');
    $extra = $contact->appendChild($extra);
}

// Guardar el documento modificado en un nuevo archivo o sobrescribir el existente
$dom->save('nuevo_ejemplo.xml');



?>