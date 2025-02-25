<?php
require_once '../controlador/usuarios_controller.php';
$controller = new usuariosController();

session_start(); // Inicia la sesión PHP

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = $_POST['correo'];
    $password = $_POST['password'];

    // Intenta iniciar sesión y guarda los datos del usuario en la sesión si es exitoso
    $usuario = $controller->iniciarSesion($correo, $password);
    if ($usuario) {
        $_SESSION['usuario'] = $usuario; // Guarda los datos del usuario en la sesión
        header("Location: perfil.php"); // Redirige al perfil
        exit();
    } else {
        $error = "Credenciales incorrectas. Inténtalo de nuevo.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
    <!-- Link a Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
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
        margin-bottom: 20px;
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
        <div class="container-fluid">
            <img class="logo" src="../img/Adobe Express - file.png" alt="">
            <a class="navbar-brand" href="./presentacion.php">Chef<span>IA</span></a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="./lista_recetas.php">Tus Recetas</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <img style="width: 40px;" src="../img/icon.png" alt="icono">
                    <li class="nav-item">
                        <a class="nav-link" href="perfil.php">Mi Perfil</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <h1>Iniciar Sesión</h1>
        <form action="" method="POST">
            <!-- Campo de correo -->
            <div class="mb-3">
                <label for="correo" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="correo" name="correo" required>
            </div>
            <!-- Campo de contraseña -->
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <!-- Botón de inicio de sesión -->
            <button type="submit" class="btn w-100">Iniciar Sesión</button>
        </form>
        <div class="text-center mt-3">
            <p class="mb-0">¿No tienes cuenta? <a href="registro.php">Regístrate aquí</a></p>
        </div>
    </div>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> Adrian Rodriguez. Todos los derechos reservados.</p>
    </footer>
    <!-- Link a Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>