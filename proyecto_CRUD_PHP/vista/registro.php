<?php
require_once '../controlador/usuarios_controller.php';
$controller = new usuariosController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = $_POST['correo'];
    $password = $_POST['password'];
    $rol = $_POST['rol'];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);  // Crea el hash seguro de la contraseña

    $controller->agregarUsuario($correo, $hashedPassword, $rol);
    header("Location: perfil.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Listado de Socios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style/registroStyle.css">
    <style>
    body {
        padding-top: 50px;
    }

    .container {
        margin-bottom: 200px;
    }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-5 fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="">Club Deportivo</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="./lista_socios.php">Socios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="./lista_eventos.php">Eventos</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <img style="width: 40px;" src="../img/icon.png" alt="icono">
                    <?php if (isset($_SESSION['usuario'])): ?>
                    <!-- Usuario autenticado: muestra Mi Perfil -->
                    <li class="nav-item">
                        <a class="nav-link" href="perfil.php">Mi Perfil
                            (<?php echo htmlspecialchars($_SESSION['usuario']['correo']); ?>)</a>
                    </li>
                    <?php else: ?>
                    <!-- Usuario no autenticado: redirige a iniciar sesión -->
                    <li class="nav-item">
                        <a class="nav-link" href="perfil.php">Mi Perfil</a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="card">
        <h3>Formulario de Registro de Usuario</h3>
        <form action="" method="POST">
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
            <!-- Campo de rol -->
            <div class="mb-3">
                <label for="rol">Selecciona un rol:</label>
                <select id="rol" name="rol">
                    <option value="admin">Administrador</option>
                    <option value="user">Usuario</option>
                </select>
                <br><br>
            </div>
            <!-- Botón de agregar usuario -->
            <button type="submit" class="btn btn-primary">Agregar Usuario</button>
        </form>
    </div>

</body>