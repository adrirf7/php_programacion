<?php
require_once '../controlador/recetas_controller.php';
$controller = new recetasController();

$id_receta = $_GET['id'];
$controller->eliminarReceta($id_receta);

header('Location: ./lista_recetas.php');
exit();