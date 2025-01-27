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
        $query = "SELECT id, nombre, apellidos, correo, edad, password FROM usuarios WHERE correo = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows === 1) {
            $usuario = $resultado->fetch_assoc();
            var_dump($usuario);

            if (password_verify($password, $usuario['password'])) {
                // Almacenar los datos del usuario en la sesión
                session_start(); // Asegúrate de que la sesión esté iniciada
                $_SESSION['usuario'] = [
                    'id' => $usuario['id'],
                    'nombre' => $usuario['nombre'],
                    'apellidos' => $usuario['apellidos'],
                    'correo' => $usuario['correo'],
                    'edad' => $usuario['edad'],
                ];

                // Redirigir al perfil
                header("Location: perfil.php");
                exit();
            } else {
                // Contraseña incorrecta
                echo "Contraseña incorrecta.";
                return false;
            }
        }
        // Correo no encontrado
        echo "Correo no encontrado.";
        return false;
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