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

function generarSelect($listaValores, $seleccionado, $name, $multiple = false){
    $salida = "";

    if ( !is_array($seleccionado)){
        $seleccionado = explode(",", $seleccionado);
    }

    if ($multiple){
        $name = $name . "[]";
        $salida .="<select class='form-control' name='$name' id='$name' multiple>";
    }else{
        $salida .="<select class='form-control' name='$name' id='$name'>";
    }

    foreach ($listaValores as $valor){
        if (in_array($valor, $seleccionado)){
            $salida .="<option value='{$valor}' selected>{$valor}</option>";
        }else {
            $salida .="<option value='{$valor}'>{$valor}</option>";
        }
    }

    $salida .="</select>";

    return $salida;
}