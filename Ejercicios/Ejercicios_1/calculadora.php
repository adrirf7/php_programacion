<?php
function menu()
{
    echo "Seleccione una operación:\n";
    echo "1. Suma\n";
    echo "2. Resta\n";
    echo "3. Multiplicación\n";
    echo "4. División\n";
    echo "5. Salir\n";
}

function operaciones($option, $sum1, $sum2)
{
    switch ($option) {
        case 1:
            return $sum1 + $sum2;

        case 2:
            return $sum1 - $sum2;

        case 3:
            return $sum1 * $sum2;

        case 4:
            if ($sum2 != 0) {
                return $sum1 / $sum2;
            } else {
                return "--ERROR--Division por cero";
            }
        default:
            return "Opcion no valida";
    }
}

do {
    menu();
    $option = (int)readline("Ingrese una opcion: ");

    if ($option >= 1 && $option <= 4) {
        $sum1 = (float)readline("Ingrese el primer nuemro: ");
        $sum2 = (float)readline("Ingrese el segundo nuemro: ");
        $resultado = operaciones($option, $sum1, $sum2);

        echo "Resultado: $resultado\n";
    } elseif ($option == 5) {
        echo "Saliendo del programa...";
    } else {
        echo "Ingrese una opcion valida";
    }
} while ($option != 5);