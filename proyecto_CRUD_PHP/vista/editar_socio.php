<?php
require_once '../controlador/SociosController.php';
$controller = new SociosController();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id_socio = $_GET['id'];
    $socio = $controller->obtenerSocioPorId($id_socio);

    if (!$socio) {
        die("Error: Socio no encontrado.");
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_socio = $_GET['id'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];


    $controller->actualizarSocio($id_socio, $nombre, $apellido, $email, $telefono, $fecha_nacimiento);
    header("Location: vista/lista_socios.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Socio
    </title>
</head>

<body>
    <h2>Actualizar Socio</h2>
    <form method="POST" action="lista_socios.php">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" required><br><br>

        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="telefono">Teléfono:</label>
        <input type="text" id="telefono" name="telefono" required><br><br>

        <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required><br><br>

        <input type="submit" value="Actualizar Socio">
    </form>

</body>

</html>