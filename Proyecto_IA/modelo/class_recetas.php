<?php
require_once '../config/conexion.php';

class recetas
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = new Conexion();
    }
    public function obtenerRecetas($usuario_id)
    {
        $query = "SELECT id, nombre, receta FROM recetas WHERE usuario_id = ?;";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("s", $usuario_id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $recetas = [];
        while ($receta = $resultado->fetch_assoc()) {
            $recetas[] = $receta;
        }
        return $recetas;
    }

    public function agregarReceta($usuario_id, $nombre, $receta)
    {
        $query = "INSERT INTO recetas (usuario_id, nombre, receta) VALUES (?, ?, ?)";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("iss", $usuario_id, $nombre, $receta);

        if ($stmt->execute()) {
            echo "Receta agreagado con exito";
        } else {
            echo "Error al agregar la Receta" . $stmt->error;
        }
        $stmt->close();
    }
    public function actualizarReceta($id_receta, $nombre, $receta)
    {
        $query = "UPDATE recetas SET nombre = ?, receta = ? WHERE id= ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("ssi", $nombre, $receta, $id_receta,);

        if ($stmt->execute()) {
            echo "Receta actualgizado con éxito.";
        } else {
            echo "Error al actualizar la Receta: " . $stmt->error;
        }

        $stmt->close();
    }

    public function eliminarReceta($id_receta)
    {
        $query = "DELETE FROM recetas WHERE id = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("i", $id_receta);

        if ($stmt->execute()) {
            echo "Receta eliminada con éxito.";
        } else {
            echo "Error al eliminar la receta: " . $stmt->error;
        }
        $stmt->close();
    }
}