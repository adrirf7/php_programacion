<?php

class empleado
{
    private $nombre;
    private $sueldo;
    private $experiencia;

    // Constructor que inicializa las propiedades de la clase empleado
    public function __construct($nombre, $sueldo, $experiencia)
    {
        $this->nombre = $nombre;
        $this->sueldo = $sueldo;
        $this->experiencia = $experiencia;
    }

    // Calcula el bonus basado en la experiencia
    public function calcularBonus()
    {
        $bonus = 0.05; // El 5% se aplica por cada 2 años de experiencia
        $periodos = floor($this->experiencia / 2); // Divide la experiencia entre 2 años
        return $this->sueldo * $bonus * $periodos; // Calcula el bonus en función del sueldo
    }

    // Muestra los detalles del empleado
    public function mostrarDetalles()
    {
        echo ("Nombre: {$this->nombre} || Sueldo: {$this->sueldo} || Bonus: {$this->calcularBonus()}\n");
    }
}

class consultor extends empleado
{
    private $horas_por_proyecto;

    // Constructor que también inicializa las horas por proyecto
    public function __construct($nombre, $sueldo, $experiencia, $horas_por_proyecto)
    {
        parent::__construct($nombre, $sueldo, $experiencia); // Llama al constructor de la clase base
        $this->horas_por_proyecto = $horas_por_proyecto; // Inicializa las horas trabajadas en proyectos
        $this->sueldo = $sueldo;
    }

    // Sobrescribe calcularBonus para basarse en horas por proyecto en lugar de experiencia
    public function calcularBonus()
    {
        $bonus = 0.05; // El 5% se aplica por cada 100 horas trabajadas
        $periodos = floor($this->horas_por_proyecto / 100); // Calcula los periodos de 100 horas
        return $this->sueldo * $bonus * $periodos; // Calcula el bonus basado en las horas
    }
}

// Ejemplo de uso
$empleado = new empleado("Adrian", "2000", 20);
$empleado->mostrarDetalles(); // Muestra los detalles del empleado

$consultor = new consultor("Juan", "1200", 14, 400);
$consultor->mostrarDetalles(); // Muestra los detalles del consultor