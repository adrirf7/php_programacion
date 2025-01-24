<?php
require_once '../controlador/usuarios_controller.php';
$controller = new usuariosController();
$usuarios = $controller->listarUsuarios();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Listado de Socios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-5">
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
                    <!-- Alinea a la derecha -->
                    <img style="width: 40px;" src="../img/icon.png" alt="perfil">
                    <li class="nav-item">
                        <a class="nav-link" href="miPerfil.php">Mi Perfil</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    </nav>
    <div class="container mt-5" style="margin-bottom: 100px;">
        <h1 class="text-center">Usuarios Registrados</h1>
        <table class="table table-responsive shadow-lg table-scripted mt-4">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <th>Edad</th>
                    <th>Plan Base</th>
                    <th>Duracion de Suscripcion</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <?php foreach ($usuarios as $usuario): ?>
            <tr>
                <td><?= $usuario['id'] ?></td>
                <td><?= $usuario['nombre'] ?></td>
                <td><?= $usuario['apellidos'] ?></td>
                <td><?= $usuario['correo'] ?></td>
                <td><?= $usuario['edad'] ?></td>
                <td><?= $usuario['plan_base'] ?></td>
                <td><?= $usuario['duracion_suscripcion'] ?></td>
                <td>
                    <a href="editar_usuario.php?id=<?= $usuario['id'] ?>" class="btn btn-sm btn-primary">Editar</a>
                    <a href="eliminar_usuario.php?id=<?= $usuario['id'] ?>" class="btn btn-sm btn-danger">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <br>
    </div>
    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p>&copy; <?php echo date('Y'); ?> Adrian Rodriguez. Todos los derechos reservados.</p>
    </footer>
</body>

</html>