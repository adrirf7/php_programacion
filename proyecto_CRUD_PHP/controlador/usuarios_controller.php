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

    public function agregarUsuario($correo, $password, $rol)
    {
        $this->modelo->agregarUsuario($correo, $password, $rol);
    }

    public function eliminarUsuario($id)
    {
        $this->modelo->eliminarUsuario($id);
    }
}