<?php
require_once '../controlador/usuarios_controller.php';
$controller = new usuariosController();

session_start(); // Asegúrate de iniciar la sesión
$id = $_SESSION['usuario']['id_usuario'];
$controller->eliminarUsuario($id);
$_SESSION = [];
// Finalmente, destruir la sesión
session_destroy();
header('Location: ../vista/perfil.php');
exit();