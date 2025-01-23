<?php
require_once '../modelo/class_evento.php';

class eventosController
{
    private $modelo;
    public function __construct()
    {
        $this->modelo = new evento();
    }
    public function agregarEvento($nombre_evento, $fecha, $lugar)
    {
        $this->modelo->agregarEvento($nombre_evento, $fecha, $lugar);
    }

    public function listarEventos()
    {
        return $this->modelo->obetenerEventos();
    }

    public function obtenerEventoPorId($id_evneto)
    {
        return $this->modelo->obtenerEventoPorId($id_evneto);
    }

    public function actualizarEvento($id_evento, $nombre_evento, $fecha, $lugar)
    {
        $this->modelo->actualizarEvento($id_evento, $nombre_evento, $fecha, $lugar);
    }

    public function eliminarEvento($id_evento)
    {
        $this->modelo->eliminarEvento($id_evento);
    }
}