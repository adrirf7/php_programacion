<?php

function adivinarNumero()
{
    $num = rand(1, 101); // Generar numero aleatorio 
    do {
        $input = readline("Adivina el numero secreto entre el 1 y el 100: "); // intento del usuario
        if (!is_numeric($input)) { // verifica si el input es un valor numerico
            echo "Ingrese un valor numerico\n";
            continue;
        }
        $user = (int)$input; // convierte el valor del usuario a un valor entero
        if ($user > 100) { //Comprueba que el valor del usuario este dentro del rango
            echo "Ingrese un numero dentro del rango valido\n";
            continue;
        }
        if ($user == $num) {
            echo "Adivinaste\n";
        } elseif ($user > $num) {
            echo "Mas bajo\n";
        } else {
            echo "Mas alto\n";
        }
    } while ($user != $num);
}
adivinarNumero();
