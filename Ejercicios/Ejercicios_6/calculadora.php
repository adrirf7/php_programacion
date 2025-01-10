<?php

class calculadora
{
    public function sumar($num, $num1)
    {
        return $num + $num1;
    }

    public function restar($num, $num1)
    {
        return $num - $num1;
    }

    public function multiplicar($num, $num1)
    {
        return $num * $num1;
    }

    public function dividir($num, $num1)
    {
        if ($num == 0) {
            return "Error--Dividir por 0";
        } else {
            return $num / $num1;
        }
    }
}

function calcular()
{
    $num = readline("Escribe el primer numero: ");
    $num1 = readline("Escribe el segundo numero: ");

    if (is_numeric($num & $num1)) {
        $newcalculadora = new calculadora;
        echo ("$num + $num1 = {$newcalculadora->sumar($num,$num1)}\n");
        echo ("$num - $num1 = {$newcalculadora->restar($num,$num1)}\n");
        echo ("$num * $num1 = {$newcalculadora->multiplicar($num,$num1)}\n");
        echo ("$num / $num1 = {$newcalculadora->dividir($num,$num1)}\n");
    } else {
        echo ("--Syntax ERROR--");
    }
}

calcular();
