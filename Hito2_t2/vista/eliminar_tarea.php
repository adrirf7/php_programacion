<?php
require_once '../controlador/tareasController.php';
$controller = new tareasController();

$id_tarea = $_GET['id'];
$controller->eliminarTarea($id_tarea);

header('Location: ./lista_tareas.php');
exit();