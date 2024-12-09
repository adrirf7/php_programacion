<?php

function adivinarNumero($user)
{
    while 
        $num = rand(1, 101);
        if ($user == $num) {
            echo "Adivinaste";
        } elseif ($user > $num) {
            echo "Mas bajo";
        } else {
            echo "Mas alto";
        }
}

$user = (int)readline("Adivina el numero secreto: ");
adivinarNumero($user);