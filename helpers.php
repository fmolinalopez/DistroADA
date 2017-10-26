<?php
// Funcion que convierte los elementos de un array a un string,
// separando con comas cada elemento.
function arrayToString($array){
    $string = "";
    foreach ($array as $item => $value){
        $string = $string . $value . ", ";
    }
    return trim($string, ', ');
}