<?php
require_once '../config/conexion.php';

class tareas
{
    private $conexion;
    public function __construct()
    {
        $this->conexion = new conexion();
    }
    public function agregarTarea($usuario_id, $titulo, $descripcion, $fecha_vencimiento)
    {
        $query = "INSERT INTO tareas (usuario_id, titulo, descripcion, fecha_vencimiento) VALUES (?, ?, ?, ?)";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("isss", $usuario_id, $titulo, $descripcion, $fecha_vencimiento);

        if ($stmt->execute()) {
            echo "evento agreagado con exito";
        } else {
            echo "Error al agregar el evento" . $stmt->error;
        }
        $stmt->close();
    }

    public function obtenerTareasPorId($usuario_id)
    {
        $query = "SELECT id, titulo, descripcion, estado, DATE_FORMAT(fecha_vencimiento, '%d/%m/%Y') AS fecha_vencimiento, DATEDIFF(fecha_vencimiento, CURDATE()) AS dias_restantes FROM tareas WHERE usuario_id = ? ORDER BY estado DESC, fecha_vencimiento ASC;";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("s", $usuario_id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $tareas = [
            'pendientes' => [],
            'completadas' => []
        ];

        while ($tarea = $resultado->fetch_assoc()) {
            if ($tarea['estado'] === 'completada') {
                $tareas['completadas'][] = $tarea;
            } else {
                $tareas['pendientes'][] = $tarea;
            }
        }

        return $tareas;
    }

    public function obtenerTarea($id_tarea)
    {
        $query = "SELECT * FROM tareas WHERE id = ?;";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("i", $id_tarea);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_assoc();
    }


    public function actualizarTarea($id_tarea, $titulo, $descripcion, $fecha_vencimiento)
    {
        $query = "UPDATE tareas SET titulo = ?, descripcion = ?, fecha_vencimiento = ? WHERE id= ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("sssi", $titulo, $descripcion, $fecha_vencimiento, $id_tarea,);

        if ($stmt->execute()) {
            echo "Evento actualgizado con éxito.";
        } else {
            echo "Error al actualizar el evento: " . $stmt->error;
        }

        $stmt->close();
    }
    public function eliminarTarea($id_tarea)
    {
        $query = "DELETE FROM tareas WHERE id = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("i", $id_tarea);

        if ($stmt->execute()) {
            echo "Evento eliminado con éxito.";
        } else {
            echo "Error al eliminar el evento: " . $stmt->error;
        }

        $stmt->close();
    }
    public function cambiarEstadoTarea($id_tarea, $estado)
    {
        $query = "UPDATE tareas SET estado = ? WHERE id = ?;";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("si", $estado, $id_tarea);

        if ($stmt->execute()) {
            echo "Tarea Actualizada con exito";
        } else {
            echo "Error al Actualizar la tarea: " . $stmt->error;
        }

        $stmt->close();
    }

    public function estadisticasTareas($usuario_id)
    {

        echo '<br>id de usuario en estadisticastareas: ' . $usuario_id . '<br>';

        $query = "SELECT 
                    COALESCE(SUM(CASE WHEN t.estado = 'pendiente' THEN 1 ELSE 0 END), 0) AS tareas_pendientes, 
                    COALESCE(SUM(CASE WHEN t.estado = 'completada' THEN 1 ELSE 0 END), 0) AS tareas_completadas 
                  FROM tareas t 
                  WHERE t.usuario_id = ?;";

        if (!$stmt = $this->conexion->conexion->prepare($query)) {
            error_log("Error en la preparación de la consulta: " . $this->conexion->conexion->error);
            return ["tareas_pendientes" => 0, "tareas_completadas" => 0];
        }

        $stmt->bind_param("i", $usuario_id);

        if (!$stmt->execute()) {
            error_log("Error al ejecutar la consulta: " . $stmt->error);
            $stmt->close();
            return ["tareas_pendientes" => 0, "tareas_completadas" => 0];
        }

        $resultado = $stmt->get_result();
        $datos = $resultado ? $resultado->fetch_assoc() : ["tareas_pendientes" => 0, "tareas_completadas" => 0];

        // Asegurar que los valores sean enteros
        $datos['tareas_pendientes'] = (int) ($datos['tareas_pendientes'] ?? 0);
        $datos['tareas_completadas'] = (int) ($datos['tareas_completadas'] ?? 0);

        $stmt->close();
        var_dump($datos);
        return $datos;
    }
}
