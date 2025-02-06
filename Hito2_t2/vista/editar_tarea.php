<?php
require_once '../controlador/tareasController.php';
$controller = new tareasController();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id_tarea = $_GET['id'];
    $tarea = $controller->obtenerTarea($id_tarea);
}

// Lógica para actualizar datos del socio (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) {
    $id_tarea = $_GET['id'];
    $titulo = $_POST['titulo'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';
    $fecha_vencimiento = $_POST['fecha_vencimiento'] ?? '';

    // Actualizar datos
    $controller->actualizarTarea($id_tarea, $titulo, $descripcion, $fecha_vencimiento);
    header("Location: ./lista_eventos.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Actualizar Tarea</title>
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center">Actualizar Evento</h2>
        <form method="POST" action="" class="shadow-lg p-4 rounded bg-light">
            <label for="titulo" class="form-label">Titulo de la Tarea:</label>
            <input type="text" id="titulo" name="titulo" class="form-control"
                value="<?php echo htmlspecialchars($tarea['titulo'] ?? ''); ?>" required><br><br>

            <label for="descripcion" class="form-label">Descripcion:</label>
            <input type="text" id="descripcion" name="descripcion" class="form-control"
                value="<?php echo htmlspecialchars($tarea['descripcion'] ?? ''); ?>" required><br><br>

            <label for="fecha_vencimiento" class="form-label">Fecha limite:</label>
            <input type="date" id="lugar" name="fecha_vencimiento" class="form-control"
                value="<?php echo htmlspecialchars($tarea['fecha_vencimiento'] ?? ''); ?>" required><br><br>

            <button type="submit" class="btn btn-primary w-100">Actualizar Tarea</button>
        </form>
    </div>

</body>

</html>