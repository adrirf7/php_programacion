<?php
require_once '../controlador/usuarios_controller.php';
$controller = new usuariosController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellidos'];
    $email = $_POST['correo'];
    $password = $_POST['password'];
    $edad = $_POST['edad'];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);  // Crea el hash seguro de la contraseña

    // Asignamos valores predeterminados a los campos opcionales
    $plan_base = Null;
    $duracion_suscripcion = Null;

    // Llamamos al método para agregar el usuario
    $controller->agregarUsuario($nombre, $apellido, $email, $hashedPassword, $edad, $plan_base, $duracion_suscripcion);

    // Redirigimos a la lista de usuarios
    header("Location: lista_usuarios.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Usuario</title>
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
        /* Para que se acomode bien el footer */
    }

    .card {
        margin-top: 100px;
        margin-bottom: 100px;
        border-radius: 15px;
        width: 100%;
        max-width: 450px;
        padding: 30px;
        background-color: white;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card h3 {
        text-align: center;
        font-weight: bold;
        margin-bottom: 25px;
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
        <h3>Formulario de Registro de Usuario</h3>
        <form action="" method="POST">
            <!-- Campo de nombre -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <!-- Campo de apellidos -->
            <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos</label>
                <input type="text" class="form-control" id="apellidos" name="apellidos" required>
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
            <!-- Campo de edad -->
            <div class="mb-3">
                <label for="edad" class="form-label">Edad</label>
                <input type="number" class="form-control" id="edad" name="edad" required min="1">
            </div>
            <!-- Botón de agregar usuario -->
            <button type="submit" class="btn btn-primary">Agregar Usuario</button>
        </form>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; <?php echo date('Y'); ?> Adrian Rodriguez. Todos los derechos reservados.</p>
    </footer>

    <!-- Link a Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>