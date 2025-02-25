<?php
require_once '../controlador/usuarios_controller.php';
$controller = new usuariosController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $password = $_POST['password'];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);  // Crea el hash seguro de la contraseña
    $controller->agregarUsuario($nombre, $correo, $hashedPassword);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style/registroStyle.css">
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

    .container {
        width: 100%;
        max-width: 400px;
        /* Limita el ancho del formulario */
        padding: 20px;
        background-color: transparent;
        /* Fondo transparente */
    }

    .logo {
        margin-right: 10px;
        width: 55px;
    }

    h1 {
        color: #ffcd42;
        text-align: center;
        margin-bottom: 40px;
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

    span {
        font-weight: bold;
        color: #1e8449;
    }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark px-5 fixed-top">
        <img class="logo" src="../img/Adobe Express - file.png" alt="">
        <div class="container-fluid">
            <a class="navbar-brand" href="./presentacion.php">Chef<span>IA</span></a>
            <div class=" collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="./lista_recetas.php">Tus Recetas</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <img style="width: 40px;" src="../img/icon.png" alt="icono">
                    <li class="nav-item">
                        <a class="nav-link" href="perfil.php">Mi Perfil </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <h1>Crear Cuenta</h1>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <!-- Campo de correo electrónico -->
            <div class="mb-3">
                <label for="correo" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="correo" name="correo" required>
            </div>
            <!-- Campo de contraseña -->
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <!-- Checkbox para aceptar políticas -->
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="aceptarPoliticas" onclick="toggleSubmit()">
                <label class="form-check-label" for="aceptarPoliticas">Acepto las políticas de privacidad</label>
            </div>
            <button type="submit" class="btn btn-primary" id="btnSubmit" disabled>Agregar Usuario</button>
        </form>
    </div>
    <!-- Script para el chekbox -->
    <script>
    function toggleSubmit() {
        const checkbox = document.getElementById('aceptarPoliticas');
        const submitButton = document.getElementById('btnSubmit');
        submitButton.disabled = !checkbox.checked;
        submitButton.style.opacity = checkbox.checked ? '1' : '0.5';
    }
    </script>
    </div>

</body>