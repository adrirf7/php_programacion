<?php

function generarTabla()
{
    while (true) {
        try {
            $input = readline("Ingrese un numero: ");
            if (!is_numeric($input)) {
                throw new Exception("--Error-- Ingrese un numero\n");
            } elseif ($num1 = intval($input) <= 0) {
                throw new Exception("--Error-- El numero debe ser mayor a 0\n");
            } elseif (!is_int($num1 = intval($input))) {
                throw new Exception("--Error-- El numero debe ser entero\n");
            } else {
                for ($i = 0; $i <= 10; $i++) {
                    echo $i . "x" . $num1 . "=" . ($num1 * $i) . "\n";
                }
                break;
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage() . "\n";
        }
    }
}

$resultado = generarTabla();
echo $resultado;