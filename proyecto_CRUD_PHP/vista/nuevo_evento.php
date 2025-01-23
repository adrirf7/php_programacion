<?php
require_once '../controlador/EventosController.php';
$controller = new EventosController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_evento = $_POST['nombre_evento'];
    $fecha = $_POST['fecha'];
    $lugar = $_POST['lugar'];


    $controller->agregarEvento($nombre_evento, $fecha, $lugar);
    header("Location: http://localhost:8080/php_programacion/proyecto_CRUD_PHP/vista/lista_eventos.php");
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
            <label for="nombre" class="form-label">Nombre del Evento:</label>
            <input type="text" id="nombre_evento" name="nombre_evento" class="form-control" required><br><br>

            <label for="apellido" class="form-label">Fecha:</label>
            <input type="date" id="fecha" name="fecha" class="form-control" required><br><br>

            <label for="email" class="form-label">Lugar:</label>
            <input type="text" id="lugar" name="lugar" class="form-control" required><br><br>

            <button type="submit" class="btn btn-primary w-100">Agregar Evento</button>
        </form>
    </div>
</body>

</html>