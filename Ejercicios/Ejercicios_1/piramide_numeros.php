<?php
function generarPiramide()
{
    // Bucle para obtener la altura de la pirámide del usuario
    while (true) {
        $input = readline("Ingrese la altura de la piramide: ");

        // Validación: Verifica si el input es un valor numérico
        if (!is_numeric($input)) {
            echo "Ingrese un valor numérico\n";
            continue;
        }

        $altura = (int)$input; // Convierte el input a un número entero
        break;
    }

    // Bucle para construir cada fila de la pirámide
    for ($i = 0; $i < $altura; $i++) {
        $indent = $altura - $i - 1; // Calcula los espacios a la izquierda
        $bloque = 2 * $i + 1;       // Calcula el número de "0" en la fila actual

        echo str_repeat(" ", $indent); // Imprime los espacios a la izquierda
        echo str_repeat("0", $bloque); // Imprime los "0" correspondientes
        echo ("\n"); // Salto de línea para la siguiente fila
    }
}

generarPiramide();
