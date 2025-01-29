<?php
session_start();
// Si no hay un usuario en la sesión, redirige a iniciar sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: miPerfil.php");
    exit();
}
// Datos del usuario
$usuario = $_SESSION['usuario'];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        padding-top: 50px;
    }

    .container {
        margin-bottom: 100px;
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
    <div class="container mt-5">

        <h1>Bienvenido, <?php echo htmlspecialchars($usuario['nombre']); ?></h1>
        <h5>Detalles de la cuenta </h5>
        <p><strong>Nombre completo:</strong> <?php echo htmlspecialchars($usuario['nombre']); ?>
            <?php echo htmlspecialchars($usuario['apellidos']); ?></p>
        <p><strong>Edad:</strong> <?php echo htmlspecialchars($usuario['edad']); ?></p>
        <p><strong>Correo:</strong> <?php echo htmlspecialchars($usuario['correo']); ?></p>

        <a href="editar_perfil.php" class="btn btn-primary">Editar Perfil</a>
        <a href="./actualizar_password.php" class="btn btn-warning">Actualizar Contraseña</a>
        <a href="../modelo/cerrar_sesion.php" class="btn btn-secondary">Cerrar Sesión</a>
        <a href="../modelo/eliminar_usuario.php" class="btn btn-danger">Eliminar Usuario</a>
    </div>
</body>

</html>