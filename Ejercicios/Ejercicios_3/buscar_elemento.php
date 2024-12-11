<?php
function buscarElemento($array, $elemento)
{
    $posicion = array_search($elemento, $array);

    if ($posicion === false) {
        throw new Exception("El elemento $elemento, no fue encontrado");
    }
    return $posicion;
}
try {
    $array = ["Juan", "Ana", "Luis", "Maria", "Carlos", "Lucia", "Pedro", "Elena"];
    $input = readline("Ingrese el nombre que deseas buscar: ");
    echo "La poscion de $input es: " . buscarElemento($array, $input) . "\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}