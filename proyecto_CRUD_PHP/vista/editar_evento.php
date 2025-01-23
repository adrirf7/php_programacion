<?php
require_once '../controlador/eventosController.php';
$controller = new eventosController();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id_evento = $_GET['id'];
    $evento = $controller->obtenerEventoPorId($id_evento);
}

// Lógica para actualizar datos del socio (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) {
    $id_evento = $_GET['id'];

    $nombre_evento = $_POST['nombre_evento'] ?? '';
    $fecha = $_POST['fecha'] ?? '';
    $lugar = $_POST['lugar'] ?? '';

    // Actualizar datos
    $controller->actualizarEvento($id_evento, $nombre_evento, $fecha, $lugar);
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
    <title>Actualizar Evento</title>
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center">Actualizar Evento</h2>
        <form method="POST" action="" class="shadow-lg p-4 rounded bg-light">
            <label for="nombre_evento" class="form-label">Nombre del Evento:</label>
            <input type="text" id="nombre_evento" name="nombre_evento" class="form-control"
                value="<?php echo htmlspecialchars($evento['nombre_evento'] ?? ''); ?>" required><br><br>

            <label for="fecha" class="form-label">Fecha:</label>
            <input type="date" id="fecha" name="fecha" class="form-control"
                value="<?php echo htmlspecialchars($evento['fecha'] ?? ''); ?>" required><br><br>

            <label for="lugar" class="form-label">Lugar:</label>
            <input type="text" id="lugar" name="lugar" class="form-control"
                value="<?php echo htmlspecialchars($evento['lugar'] ?? ''); ?>" required><br><br>

            <button type="submit" class="btn btn-primary w-100">Actualizar Evento</button>
        </form>
    </div>

</body>

</html>