<?php

class producto
{
    public $nombre;
    public $precio;

    public function mostrarDetalles()
    {
        echo "Este producto es {$this->nombre} y vale {$this->precio}";
    }
}

class electrodomestico extends producto
{
    public $consumo;

    public function mostrarDetalles()
    {
        echo "\nEste electrodomestico es un(a) {$this->nombre}, cuesta {$this->precio}€ y consume {$this->consumo}Kwh\n";
    }
}

$electrodomestico = new electrodomestico;
$electrodomestico->nombre = "lavadora";
$electrodomestico->precio = 250;
$electrodomestico->consumo = 150;

$electrodomestico->mostrarDetalles();
