<?php
require_once '../modelo/class_usuario.php';

class usuariosController
{
    private $modelo;

    public function __construct()
    {
        $this->modelo = new usuario();
    }
    public function iniciarSesion($correo, $password)
    {
        $this->modelo->iniciarSesion($correo, $password);
    }

    public function agregarUsuario($nombre, $correo, $password)
    {
        $this->modelo->agregarUsuario($nombre, $correo, $password);
    }

    public function eliminarUsuario($id)
    {
        $this->modelo->eliminarUsuario($id);
    }
}