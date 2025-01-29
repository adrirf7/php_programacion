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
                    'password' => $usuario['password'],
                    'edad' => $usuario['edad'],
                    'plan_base' => $usuario['plan_base'],
                    'duracion_suscripcion' => $usuario['duracion_suscripcion']
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

    public function actualizarUsuario($id, $nombre, $apellidos, $email, $edad)
    {
        $query = "UPDATE usuarios SET nombre = ?, apellidos = ?, correo = ?, edad = ? WHERE id = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("sssis", $nombre, $apellidos, $email, $edad, $id);

        if ($stmt->execute()) {
            echo "Usuario actualizado con éxito.";
            // Actualizar los datos en la sesión
            $_SESSION['usuario']['nombre'] = $nombre;
            $_SESSION['usuario']['apellidos'] = $apellidos;
            $_SESSION['usuario']['correo'] = $email;
            $_SESSION['usuario']['edad'] = $edad;
        } else {
            echo "Error al actualizar Usuario: " . $stmt->error;
        }

        $stmt->close();
    }

    public function actualizarPassword($id, $password_nueva)
    {
        $query = "UPDATE usuarios SET password = ? WHERE id = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("ss", $password_nueva, $id);

        if ($stmt->execute()) {
            echo "Contraseña actualizada con éxito.";
        } else {
            echo "Error al actualizar la contraseña.";
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