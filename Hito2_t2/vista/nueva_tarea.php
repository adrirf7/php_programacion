<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: inicio_sesion.php");
    exit();
}
require_once '../controlador/tareasController.php';
$controller = new tareasController();
$usuario_id = $_SESSION['usuario']['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $fecha_vencimiento = $_POST['fecha_vencimiento'];

    $controller->agregarTarea($usuario_id, $titulo, $descripcion, $fecha_vencimiento);
    header("Location: ./lista_tareas.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Agregar Socio</title>
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center">Agregar Nuevo Evento</h2>
        <form method="POST" action="" class="shadow-lg p-4 rounded bg-light" style="margin-top: 30px;">
            <label for="titulo" class="form-label">Titulo:</label>
            <input type="text" id="titulo" name="titulo" class="form-control" required><br><br>

            <label for="descripcion" class="form-label">Descripcion:</label>
            <input type="text" id="descripcion" name="descripcion" class="form-control" required><br><br>

            <label for="fecha_vencimiento" class="form-label">Fecha Limite:</label>
            <input type="date" id="fecha_vencimiento" name="fecha_vencimiento" class="form-control" required><br><br>

            <button type="submit" class="btn btn-primary w-100">Agregar Evento</button>
        </form>
    </div>
</body>

</html>