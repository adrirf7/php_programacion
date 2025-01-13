<?php

class banco
{
    public $titular;
    public $saldo;
    public $tipoCuenta;

    public function depositar($deposito)
    {
        return $this->saldo += $deposito;
    }
    public function retirar($retirada)
    {
        return $this->saldo -= $retirada;
    }
    public function mostrarInfo()
    {
        return "{$this->titular}, titular de la cuenta de tipo {$this->tipoCuenta} dispone de {$this->saldo}€";
    }
}

function agregarCuenta()
{
    $opciones = [
        1 => "ingresar",
        2 => "retirar",
        3 => "salir"
    ];

    $newcuenta = new banco;
    $newcuenta->titular = readline("Nombre del titular de la cuenta: ");
    $newcuenta->tipoCuenta = readline("Tipo de cuenta: ");
    $newcuenta->saldo = readline("Saldo de su cuenta: ");

    while (true) {
        foreach ($opciones as $indice => $valor) {
            echo "-. $indice : $valor\n";
        }
        $opcion = readline("Elije una opcion: ");

        if ($opcion == 1) {
            $deposito = readline("Dinero a ingresar: ");
            $newcuenta->depositar($deposito);
        } elseif ($opcion == 2) {
            $retirada = readline("Dinero a retirar: ");
            $newcuenta->retirar($retirada);
        } elseif ($opcion == 3) {
            echo ($newcuenta->mostrarInfo());
            break;
        }
    }
}

agregarCuenta();
