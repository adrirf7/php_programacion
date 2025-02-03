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
        $query = "SELECT id_usuario, correo, password, rol FROM usuarios WHERE correo = ?";
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
                    'id_usuario' => $usuario['id_usuario'],
                    'correo' => $usuario['correo'],
                    'password' => $usuario['password'],
                    'rol' => $usuario['rol'],
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

    public function agregarUsuario($correo, $password, $rol)
    {
        $query = "INSERT INTO usuarios (correo, password, rol) VALUES (?, ?, ?)";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("sss", $correo, $password, $rol);

        if ($stmt->execute()) {
            echo "Usuario agregado con éxito.";
        } else {
            echo "Error al agregar Usuario: " . $stmt->error;
        }

        $stmt->close();
    }

    public function eliminarUsuario($id)
    {
        $query = "DELETE FROM usuarios WHERE id_usuario = ?";
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