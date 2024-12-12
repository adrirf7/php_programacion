<?php

function convertirTemperatura($input)
{
    $termino = $input[1];
    $temperatura = $input[0];
    if ($termino == "C") {
        return 5 / 9 * ($temperatura - 32);
    } elseif ($termino == "F") {
        return $temperatura * (9 / 5) + 32;
    } else {
        return null;
    }
}

$entrada = readline("Ingrese la temperatura y 'C' o 'F' para convertirlo: ");
$entrada = str_replace(' ', '', $entrada);
$input = explode(",", $entrada);
if (count($input) == 2 && is_numeric($input[0]) && ($input[1] == "C" || $input[1] == "F")) {
    $resultado = convertirTemperatura($input);

    if ($input[1] == "C") {
        echo "La temperatura en Celsius es: " . round($resultado, 2) . "°C\n";
    } elseif ($input[1] == "F") {
        echo "La temperatura en Fahrenheit es: " . round($resultado, 2) . "°F\n";
    }
} else {
    echo "Entrada inválida. Asegúrese de ingresar un número seguido de 'C' o 'F'.\n";
}