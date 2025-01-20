<?php
require_once '../controlador/SociosController.php';
$controller = new SociosController();

$id = $_GET['id'];
$controller->eliminarSocio($id);

header('Location: lista_socios.php');
exit();
