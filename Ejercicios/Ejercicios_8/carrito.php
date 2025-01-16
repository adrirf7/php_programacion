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
    public function eliminarProducto()
    {
        $nombre = readline("Ingrese el Nombre del producto que desea eliminar: ");

        $producto_encontrado = null;
        foreach ($this->productos as $index => $producto) {
            if ($producto->nombre == $nombre) {
                $producto_encontrado = $index;
                break;
            }
        }

        if ($producto_encontrado !== null) {
            unset($this->productos[$producto_encontrado]);
            echo ("Producto '$nombre' eliminado con exito");
        } else {
            echo ("Producto '$nombre' no encontrado");
        }
    }
    public function mostrarProductos()
    {
        foreach ($this->productos as $producto) {
            echo ("||Nombre: " . $producto->nombre . "||Precio: " . $producto->precio . "||Cantidad: " . $producto->cantidad . "\n");
        }
    }
    public function calcularTotal()
    {
        $total_carrito = 0;
        foreach ($this->productos as $producto) {
            $total_carrito += $producto->precio * $producto->cantidad;
        }
        echo ("El total de tu carrito es de:  $total_carrito");
    }
}

function menu()
{
    $opciones = [
        1 => "Agregar un producto",
        2 => "Eliminar un producto",
        3 => "Monstrar carrito",
        4 => "Mostrar el total del carrito",
        5 => "Salir"
    ];
    $newcarrito = new carrito();
    while (true) {
        echo ("\n----MENU---\n");
        foreach ($opciones as $indice => $valor) {
            echo "-. $indice : $valor\n";
        }
        $user_input = readline("Ingrese la opcion: ");
        echo ("\n");
        if ($user_input == 1) {
            $newcarrito->agregarProducto();
        } elseif ($user_input == 2) {
            $newcarrito->eliminarProducto();
        } elseif ($user_input == 3) {
            echo ($newcarrito->mostrarProductos());
        } elseif ($user_input == 4) {
            $newcarrito->calcularTotal();
        } elseif ($user_input == 5) {
            echo ("Saliendo del programa...");
            break;
        } else {
            echo ("--Error--Ingresa una opcion valida");
        }
    }
}
menu();
