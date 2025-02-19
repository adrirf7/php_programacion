<?php
require_once '../modelo/class_recetas.php';

class recetasController
{
    private $modelo;

    public function __construct()
    {
        $this->modelo = new recetas();
    }
    public function obtenerRecetas($usuario_id)
    {
        $this->modelo->obtenerRecetas($usuario_id);
    }

    public function agregarReceta($usuario_id, $nombre, $receta)
    {
        $this->modelo->agregarReceta($usuario_id, $nombre, $receta);
    }

    public function actualizarReceta($id_receta, $nombre, $receta)
    {
        $this->modelo->actualizarReceta($id_receta, $nombre, $receta);
    }

    public function eliminarReceta($id_receta)
    {
        $this->modelo->eliminarReceta($id_receta);
    }
}