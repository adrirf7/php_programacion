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
    <style>
        .navbar {
            margin-bottom: 0;
        }

        .form-control {
            border-radius: 8px;
            padding: 15px;
            font-size: 16px;
            border: 1px solid #ddd;
            margin-bottom: 20px;
        }

        /* Fondo de la página */
        body {
            background-color: #001717;
            /* Color claro de fondo */
            display: flex;
            justify-content: center;
            /* Centra horizontalmente */
            align-items: center;
            /* Centra verticalmente */
            height: 100vh;
            /* Asegura que ocupe toda la altura de la pantalla */
            margin: 0;
        }

        h1,
        h2 {
            color: white;
        }

        .container {
            width: 100%;
            max-width: 1100px;
            /* Limita el ancho del formulario */
            padding: 20px;
            background-color: transparent;
            /* Fondo transparente */
        }

        p,
        label {
            color: white;
        }

        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            padding: 10px;
            background-color: transparent;
        }

        .btn {
            background-color: #7ba58d;
            border-color: #7ba58d;
            padding: 12px;
            font-size: 18px;
            border-radius: 8px;
            width: 100%;
        }

        .btn:hover {
            background-color: #4f7c62;
            border-color: rgb(60, 88, 72);
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center">Actualiza Tu receta</h2>
        <form method="POST" action="" class="p-4">
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