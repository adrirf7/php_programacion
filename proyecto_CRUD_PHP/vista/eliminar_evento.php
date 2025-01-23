<?php
require_once '../controlador/eventosController.php';
$controller = new eventosController();

$id_evento = $_GET['id'];
$controller->eliminarEvento($id_evento);

header('Location: lista_eventos.php');
exit();