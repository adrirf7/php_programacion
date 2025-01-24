<?php
require_once '../config/conexion.php';

class usuario
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = new Conexion();
    }

    public function iniciarSesion($correo, $password)
    {
        $query = "SELECT id, nombre, apellidos, password FROM usuarios WHERE correo = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows === 1) {
            $usuario = $resultado->fetch_assoc();

            // Verificar la contraseña
            if (password_verify($password, $usuario['password'])) {
                echo "Inicio de sesión exitoso. Bienvenido, " . $usuario['nombre'] . " " . $usuario['apellidos'];
                // Aquí podrías iniciar una sesión con $_SESSION
            } else {
                echo "Contraseña incorrecta.";
            }
        } else {
            echo "Correo no encontrado.";
        }

        $stmt->close();
    }

    public function agregarUsuario($nombre, $apellido, $email, $password, $edad, $plan_base, $duracion_suscripcion)
    {
        $query = "INSERT INTO usuarios (nombre, apellidos, correo, password, edad, plan_base, duracion_suscripcion) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("ssssiss", $nombre, $apellido, $email, $password, $edad, $plan_base, $duracion_suscripcion);

        if ($stmt->execute()) {
            echo "Usuario agregado con éxito.";
        } else {
            echo "Error al agregar Usuario: " . $stmt->error;
        }

        $stmt->close();
    }

    public function obtenerUsuarios()
    {
        $query = "SELECT * FROM usuarios";
        $resultado = $this->conexion->conexion->query($query);
        $usuarios = [];
        while ($fila = $resultado->fetch_assoc()) {
            $usuarios[] = $fila;
        }
        return $usuarios;
    }

    public function obtenerUsuarioPorId($id)
    {
        $query = "SELECT * FROM usuarios WHERE id = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_assoc();
    }

    public function actualizarUsuario($id, $nombre, $apellido, $email, $edad, $plan_base, $duracion_suscripcion)
    {
        $query = "UPDATE socios SET nombre = ?, apellido = ?, email = ?, edad = ?, plan_base = ?, duracion_suscipcion = ? WHERE id_socio = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("sssissi", $nombre, $apellido, $email, $edad, $plan_base, $duracion_suscripcion, $id);

        if ($stmt->execute()) {
            echo "Usuario actualizado con éxito.";
        } else {
            echo "Error al actualizar Usuario: " . $stmt->error;
        }

        $stmt->close();
    }

    public function eliminarUsuario($id)
    {
        $query = "DELETE FROM Usuarios WHERE id = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo "Usuario eliminado con éxito.";
        } else {
            echo "Error al eliminar Usuario: " . $stmt->error;
        }

        $stmt->close();
    }
}