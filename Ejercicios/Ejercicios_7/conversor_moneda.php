<?php
class conversorMoneda
{
    public $euros;
    public $dolares;

    public function conversor($opcion)
    {
        if ($opcion == 1) {
            return number_format($this->dolares * 0.98098999, 2);
        } elseif ($opcion == 2) {
            return number_format($this->euros / 0.98098999, 2);
        }
    }
}

function convertir()
{

    $opciones = [
        1 => "Dolares a Euros",
        2 => "Euros a Dolares",
    ];
    foreach ($opciones as $indice => $valor) {
        echo "-. $indice : $valor\n";
    }

    $opcion = readline("Elije una opcion: ");
    $conversorMoneda = new conversorMoneda;


    if ($opcion == 1) {
        $dolares = $conversorMoneda->dolares = readline("Ingrese el valor en dolares: ");
        if (is_numeric($dolares)) {
            echo "\n{$dolares}$ equivale a {$conversorMoneda->conversor($opcion)}€\n";
        } else {
            echo "--Error--Ingrese un valor numerico";
        }
    } elseif ($opcion == 2) {
        $euros = $conversorMoneda->euros = readline("Ingrese el valor en euros: ");
        if (is_numeric($euros)) {
            echo "\n{$euros}$ equivale a {$conversorMoneda->conversor($opcion)}$\n";
        } else {
            echo "--Error--Ingrese un valor numerico";
        }
    } else {
        echo "--Opcion Invalida";
    }
}
convertir();
