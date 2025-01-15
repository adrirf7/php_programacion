<?php
require_once 'class_conexion.php';

$conexion = new Conexion();

if ($conexion->conexion) {
    echo "Conexión exitosa al club deportivo.";
} else {
    echo "Error al conectar.";
}

$conexion->cerrar();