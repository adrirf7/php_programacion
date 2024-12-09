<?php

function generarTabla($num1)
{
    for ($i = 0; $i <= 10; $i++) {
        echo $i . "x" . $num1 . "=" . ($num1 * $i) . "\n";
    }
}

$num1 = (int)readline("Ingrese un numero: ");
$resultado = generarTabla($num1);
echo $resultado;