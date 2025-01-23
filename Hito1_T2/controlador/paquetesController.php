<?php
require_once '../modelo/class_paquetes.php';

class paquetesController
{
    private $modelo;

    public function __construct()
    {
        $this->modelo = new paquete();
    }
    public function listarPaquetes()
    {
        return $this->modelo->obtenerPaquetes();
    }
}