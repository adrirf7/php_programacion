<?php
require_once '../modelo/class_tareas.php';

class tareasController
{
    private $modelo;
    public function __construct()
    {
        $this->modelo = new tareas();
    }
    public function agregarTarea($usuario_id, $titulo, $descripcion, $fecha_vencimiento)
    {
        $this->modelo->agregarTarea($usuario_id, $titulo, $descripcion, $fecha_vencimiento);
    }

    public function obtenerTareasPorId($id_tarea)
    {
        return $this->modelo->obtenerTareasPorId($id_tarea);
    }

    public function obtenerTarea($usuario_id)
    {
        return $this->modelo->obtenerTarea($usuario_id);
    }

    public function actualizarTarea($id_tarea, $titulo, $descripcion, $fecha_vencimiento)
    {
        $this->modelo->actualizarTarea($id_tarea, $titulo, $descripcion, $fecha_vencimiento);
    }

    public function eliminarTarea($id_evento)
    {
        $this->modelo->eliminarTarea($id_evento);
    }

    public function cambiarEstadoTarea($id_tarea, $estado)
    {
        $this->modelo->cambiarEstadoTarea($id_tarea, $estado);
    }
    public function estadisticasTareas($usuario_id)
    {
        $this->modelo->estadisticasTareas($usuario_id);
    }
}
