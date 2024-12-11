<?php
function calculadora()
{
    $entradas = verificarEntradas();
    if (!$entradas) {
        return false; // Si hubo un error en verificarEntradas, detener
    }
    [$num1, $operador, $num2] = $entradas;

    if ($operador == "+") {
        return $num1 + $num2;
    } elseif ($operador == "-") {
        return $num1 - $num2;
    } elseif ($operador == "*") {
        return $num1 * $num2;
    } elseif ($operador == "/") {
        if ($num2 == 0) {
            return "--Error-- No se puede dividir por 0";
        }
    } else {
        return "--Error-- Operador no valido";
    }
}

function verificarEntradas()
{
    try {
        $entrada1 = readline("Ingrese un número: ");
        $operador = readline("Ingrese la operación (+, -, *, /): ");
        $entrada2 = readline("Ingrese otro número: ");

        // Validar que las entradas sean números
        if (!is_numeric($entrada1) || !is_numeric($entrada2)) {
            throw new Exception("--Error-- Solo se puede operar con números");
        }

        $num1 = floatval($entrada1);
        $num2 = floatval($entrada2);

        // Validar que el operador sea válido
        if (!in_array($operador, ["+", "-", "*", "/"])) {
            throw new Exception("--Error-- Operador no válido");
        }

        return [$num1, $operador, $num2];
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage() . "\n";
        return false; // Retornar falso si hay un error
    }
}

while (true) {
    $resultado = calculadora();
    if ($resultado != false) {
        echo "resultado = $resultado\n";
    }
}