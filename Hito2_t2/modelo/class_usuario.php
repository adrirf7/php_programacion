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
        $query = "SELECT id, nombre, correo, password FROM usuarios WHERE correo = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows === 1) {
            $usuario = $resultado->fetch_assoc();
            if (password_verify($password, $usuario['password'])) {
                // Almacenar los datos del usuario en la sesión
                session_start();
                $_SESSION['usuario'] = [
                    'id' => $usuario['id'],
                    'nombre' => $usuario['nombre'],
                    'correo' => $usuario['correo'],
                    'password' => $usuario['password'],
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
    public function agregarUsuario($nombre, $correo, $password)
    {
        // Verificar si el correo ya está registrado
        $queryVerificar = "SELECT id FROM usuarios WHERE correo = ?";
        $stmtVerificar = $this->conexion->conexion->prepare($queryVerificar);
        $stmtVerificar->bind_param("s", $correo);
        $stmtVerificar->execute();
        $stmtVerificar->store_result();

        if ($stmtVerificar->num_rows > 0) {
            $stmtVerificar->close();
            echo "<script>alert('El correo ya está registrado.');</script>";
            return false;
        }
        $stmtVerificar->close();

        // Insertar nuevo usuario
        $queryInsertar = "INSERT INTO usuarios (nombre, correo, password) VALUES (?, ?, ?)";
        $stmtInsertar = $this->conexion->conexion->prepare($queryInsertar);
        $stmtInsertar->bind_param("sss", $nombre, $correo, $password);

        if ($stmtInsertar->execute()) {
            $stmtInsertar->close();
            header("Location: perfil.php");
            return true; // Usuario agregado con éxito
        }

        $stmtInsertar->close();
        return "Error en la inserción";
    }

    public function eliminarUsuario($id)
    {
        $query = "DELETE FROM usuarios WHERE id = ?";
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
