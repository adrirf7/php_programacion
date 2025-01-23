<?php
require_once '../config/conexion.php';

class paquete
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = new Conexion();
    }
    public function obtenerPaquetes()
    {
        $query = "SELECT nombre, precio, imagen FROM paquetes";
        $resultado = $this->conexion->conexion->query($query);
        $paquetes = [];
        while ($fila = $resultado->fetch_assoc()) {
            $paquetes[] = $fila;
        }
        return $paquetes;
    }
}