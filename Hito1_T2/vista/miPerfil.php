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
    /* Fondo de la página */
    body {
        background-color: #f4f6f9;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        padding-top: 80px;
        /* Espacio para la navbar */
        flex-direction: column;
        /* Asegura que el pie de página esté al fondo */
    }

    .card {
        margin-top: 50px;
        border-radius: 12px;
        width: 100%;
        max-width: 400px;
        padding: 30px;
        background-color: white;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card h3 {
        text-align: center;
        font-weight: bold;
        margin-bottom: 20px;
        color: #333;
    }

    .form-control {
        border-radius: 8px;
        padding: 15px;
        font-size: 16px;
        border: 1px solid #ddd;
        margin-bottom: 20px;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        padding: 12px;
        font-size: 18px;
        border-radius: 8px;
        width: 100%;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }

    .text-center a {
        color: #007bff;
        text-decoration: none;
    }

    .text-center a:hover {
        text-decoration: underline;
    }

    .mt-3 {
        margin-top: 15px;
    }

    .navbar {
        margin-bottom: 0;
    }

    footer {
        background-color: #343a40;
        color: white;
        padding: 10px;
        text-align: center;
        width: 100%;
        margin-top: auto;
        /* Asegura que el footer se quede abajo */
    }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-5 fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="./index.php">StreamWeb</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="lista_usuarios.php">Usuarios</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <?php if (isset($_SESSION['usuario'])): ?>
                    <!-- Usuario autenticado: muestra Mi Perfil -->
                    <li class="nav-item">
                        <a class="nav-link" href="perfil.php">Mi Perfil
                            (<?php echo htmlspecialchars($_SESSION['usuario']['nombre']); ?>)</a>
                    </li>
                    <?php else: ?>
                    <!-- Usuario no autenticado: redirige a iniciar sesión -->
                    <li class="nav-item">
                        <a class="nav-link" href="miPerfil.php">Mi Perfil</a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="card">
        <h3>Iniciar Sesión</h3>
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
            <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
        </form>
        <div class="text-center mt-3">
            <p class="mb-0">¿No tienes cuenta? <a href="registro.php">Regístrate aquí</a></p>
            <p class="mt-2"><a href="#">¿Olvidaste tu contraseña?</a></p>
        </div>
    </div>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> Adrian Rodriguez. Todos los derechos reservados.</p>
    </footer>

    <!-- Link a Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>