<?php

class tarea
{
    public $nombre;
    public $descripcion;
    public $fecha_limite;
    public bool $estado = false;

    public function marcarCompletado(): void
    {
        $this->estado = !$this->estado;
        echo "--Tarea actualizada con éxito: Estado -> " . ($this->estado ? "Completada" : "Pendiente") . "--\n";
    }

    public function editarDescipcion(): void
    {
        $this->descripcion = readline("Escribe una nueva descipcion: ");
    }

    public function mostrarTarea(): void
    {
        if ($this->estado == true) {
            echo ("\nTarea: '{$this->nombre}'|| descripcion: {$this->descripcion}|| Fecha limite: {$this->fecha_limite}|| Estado: completado\n");
        } else {
            echo ("\nTarea: '{$this->nombre}'|| descripcion: {$this->descripcion}|| Fecha limite: {$this->fecha_limite}|| Estado: Pendiente\n");
        }
    }
}
function cargarTareasDePrueba(): array
{
    $tarea1 = new Tarea;
    $tarea1->nombre = "Comprar víveres";
    $tarea1->descripcion = "Ir al supermercado y comprar alimentos";
    $tarea1->fecha_limite = "2025-01-15";

    $tarea2 = new Tarea;
    $tarea2->nombre = "Estudiar para el examen";
    $tarea2->descripcion = "Revisar los temas del capítulo 5 al 8";
    $tarea2->fecha_limite = "2025-01-16";

    $tarea3 = new Tarea;
    $tarea3->nombre = "Reunión de trabajo";
    $tarea3->descripcion = "Participar en la reunión semanal del equipo";
    $tarea3->fecha_limite = "2025-01-17";

    $tarea4 = new Tarea;
    $tarea4->nombre = "Enviar correo";
    $tarea4->descripcion = "Enviar un correo importante al cliente";
    $tarea4->fecha_limite = "2025-01-15";

    return [$tarea1, $tarea2, $tarea3, $tarea4];
}

function mainFuncion(): void
{
    $tareas = cargarTareasDePrueba();

    while (true) {
        echo "\n-----MENÚ DE TAREAS-----\n";
        foreach ($tareas as $indice => $tarea) {
            echo ($indice + 1) . ". {$tarea->nombre}\n";
        }
        echo (count($tareas) + 1) . ". Salir\n";

        $opcion = (int)readline("Selecciona una tarea por su número: ");
        if ($opcion > 0 && $opcion <= count($tareas)) {
            $tareaSeleccionada = $tareas[$opcion - 1];
            submenuTarea($tareaSeleccionada);
        } elseif ($opcion == count($tareas) + 1) {
            echo "Saliendo del programa...\n";
            break;
        } else {
            echo "Opción no válida. Intenta de nuevo.\n";
        }
    }
}

function submenuTarea(Tarea $tarea): void
{
    $opciones = [
        1 => "Marcar tarea como completada",
        2 => "Editar descipcion",
        3 => "Mostrar Tarea",
        4 => "Salir"
    ];
    while (true) {
        echo ("\n-----MENU-----\n");
        foreach ($opciones as $indice => $valor) {
            echo "-. $indice : $valor\n";
        }
        $opcion = (int)readline("Elige la opcion: ");
        switch ($opcion) {
            case 1:
                $tarea->marcarCompletado();
                break;
            case 2:
                $tarea->editarDescipcion();
                break;
            case 3:
                $tarea->mostrarTarea();
                break;
            case 4:
                echo "Saliendo del programa...\n";
                return;
            default:
                echo "Opción no válida. Intenta de nuevo.\n";
        }
    }
}

mainFuncion();