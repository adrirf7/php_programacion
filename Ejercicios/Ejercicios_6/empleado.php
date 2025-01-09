<?php
class empleado
{
    public $nombre;
    public $sueldo;

    public function mostrarDetalles()
    {
        echo "El empleado {$this->nombre}, recibe un sueldo de {$this->sueldo}€/mes. \n";
    }
}

class gerente extends empleado
{
    public $departamento;

    public function mostrarDetalles()
    {
        echo "El Gerente {$this->nombre}, recibe un sueldo de {$this->sueldo}€/mes. Pertenece al departamento {$this->departamento}. \n";
    }
}

function agregarEmpleado()
{
    $newempleado = new empleado();
    $newempleado->nombre = "Adrian Rodriguez";
    $newempleado->sueldo = "2000";
}