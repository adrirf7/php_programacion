<?php

class circulo
{
    public $radio;

    public function calcularArea()
    {
        $area = ($this->radio ** 2) * 3.1416;
        echo "El area del circulo es: $area\n";
    }
}
function pedirCirculo()
{
    $circulo = new circulo();
    $circulo->radio = readline("Escribe el area: ");

    $circulo->calcularArea();
}
pedirCirculo();