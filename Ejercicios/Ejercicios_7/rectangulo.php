<?php
class rectangulo
{
    public $base;
    public $altura;

    public function calcularArea($base, $altura)
    {
        return $base * $altura;
    }
}

function rectangulo()
{
    $base = 10;
    $altura = 5;
    $newrectangulo = new rectangulo;
    echo ("El area del rectangulo de $base X $altura es: {$newrectangulo->calcularArea($base,$altura)}");
}
rectangulo();
