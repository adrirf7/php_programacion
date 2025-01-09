<?php

class vehiculo
{
    public $marca;

    public function encender()
    {
        echo "El coche {$this->marca} se esta encendiendo...\n";
    }
}

class coche extends vehiculo
{
    public $modelo;

    public function encender()
    {
        echo "El coche {$this->marca} {$this->modelo} se esta encendiendo...\n";
    }
}

function agregarCoche()
{
    $newcoche = new coche();
    $newcoche->marca = "ford";
    $newcoche->modelo = "focus";

    $newcoche->encender();
}
agregarCoche();