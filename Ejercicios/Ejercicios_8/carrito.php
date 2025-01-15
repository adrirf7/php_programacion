<?php

class producto
{
    public $nombre;
    public $precio;
    public $cantidad;

    public function __construct($nombre, $precio, $cantidad)
    {
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->cantidad = $cantidad;
    }
}

class carrito
{
    private $productos = [];

    public function agregarProducto()
    {
        $nombre = readline("Ingrese el Nombre: ");
        $precio = readline("Ingrese el precio: ");
        $cantidad = readline("Ingrese las unidades: ");

        if (!empty($nombre) && is_numeric($precio) && is_numeric($cantidad)) {
            // Creamos un nuevo producto y lo agregamos al carrito
            $producto = new Producto($nombre, $precio, $cantidad);
            $this->productos[] = $producto;
            echo "Producto agregado con exito\n";
        } else {
            echo "Error: Todos los campos deben ser válidos.\n";
        }
    }
    public function mostrarProductos()
    {
        foreach ($this->productos as $producto) {
            echo ("||Nombre: " . $producto->nombre . "||Precio: " . $producto->precio . "||Cantidad: " . $producto->cantidad . "\n");
        }
    }
}
$carrito = new carrito();
$carrito->agregarProducto();
$carrito->mostrarProductos();