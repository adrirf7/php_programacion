<?php
require_once '../controlador/SociosController.php';
$controller = new SociosController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];


    $controller->agregarSocio($nombre, $apellido, $email, $telefono, $fecha_nacimiento);
    header("Location: http://localhost:8080/php_programacion/proyecto_CRUD_PHP/vista/lista_socios.php");
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
        <h2 class="text-center">Agregar Nuevo Socio</h2>
        <form method="POST" action="" class="shadow-lg p-4 rounded bg-light" style="margin-top: 30px;">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" id="nombre" name="nombre" class="form-control" required><br><br>

            <label for="apellido" class="form-label">Apellido:</label>
            <input type="text" id="apellido" name="apellido" class="form-control" required><br><br>

            <label for="email" class="form-label">Correo Electrónico:</label>
            <input type="email" id="email" name="email" class="form-control" required><br><br>

            <label for="telefono" class="form-label">Teléfono:</label>
            <input type="text" id="telefono" name="telefono" class="form-control" required><br><br>

            <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento:</label>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="form-control" required><br><br>

            <button type="submit" class="btn btn-primary w-100">Agregar socio</button>
        </form>
    </div>
</body>

</html>