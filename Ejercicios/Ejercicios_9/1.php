<?php

class produto
{
    private $nombre;
    private $precio;
    private $cantidad;

    private function __construct($nombre, $precio, $cantidad)
    {
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->cantidad = $cantidad;
    }

    public function getNombre()
    {
        echo ("El nombre del producto es {$this->nombre}");
    }

    public function getPrecio()
    {
        echo ("El precio del producto es {$this->precio}");
    }
    public function getCantidad()
    {
        echo ("las unidades del producto es {$this->cantidad}");
    }
}

class productoImportado extends producto
{
    private $impuesto_adicional;
    public function __construct($nombre, $precio, $cantidad, $impuesto_adicional)
    {
        parent::__construct($nombre, $precio, $cantidad);
        $this->impuesto_adicional = $impuesto_adicional;
    }
}
