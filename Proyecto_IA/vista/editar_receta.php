<?php
require_once '../controlador/recetas_controller.php';
$controller = new recetasController();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id_receta = $_GET['id'];
    $receta = $controller->obtenerRecetaPorId($id_receta);
}

// Lógica para actualizar datos del socio (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) {
    $id_receta = $_GET['id'];
    $nombre = $_POST['nombre'] ?? '';
    $descripcion = $_POST['receta'] ?? '';
    $recetaConSaltos = nl2br($descripcion); //Volver a añadir los saltos de linea
    // Actualizar datos
    $controller->actualizarReceta($id_receta, $nombre, $recetaConSaltos);
    header("Location: ./lista_recetas.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Actualiza Tu Receta</title>
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center">Actualiza Tu receta</h2>
        <form method="POST" action="" class="shadow-lg p-4 rounded bg-light">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" id="nombre" name="nombre" class="form-control"
                value="<?php echo htmlspecialchars($receta['nombre'] ?? ''); ?>" required><br><br>

            <label for="receta" class="form-label">Receta:</label>
            <textarea class='form-control' rows='20' name='receta'
                required><?php echo htmlspecialchars($receta_texto_plano = strip_tags($receta['receta'] ?? '')); ?></textarea>
            <button type="submit" class="btn btn-primary w-100">Actualizar Receta</button>
        </form>
    </div>

</body>

</html>