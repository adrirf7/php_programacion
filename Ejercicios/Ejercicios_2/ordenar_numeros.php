<?php

function generarArray()
{
    $numeros = [];
    $tamaño = 10;
    while (count($numeros) < $tamaño) {
        $num = rand(1, 100);
        if (!in_array($num, $numeros)) {
            $numeros[] = $num;
        }
    }
    foreach ($numeros as $numero) {
        echo $numero . " ";
    }
    return $numeros;
}

function ordenarArray()
{
    $numeros = generarArray();
    sort($numeros);
    echo "\n";
    foreach ($numeros as $numero) {
        echo $numero . " ";
    }
}


ordenarArray();