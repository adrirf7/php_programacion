<?php
session_start();
$usuario = $_SESSION['usuario'];

require_once '../controlador/SociosController.php';
$controller = new SociosController();
$socios = $controller->listarSocios();

// Verificar si el usuario tiene el rol de "admin"
$isAdmin = isset($usuario['rol']) && $usuario['rol'] === 'admin';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Listado de Socios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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

    <div class="container mt-5" style="margin-bottom: 100px;">
        <h1 class="text-center">Socios Registrados</h1>
        <table class="table table-responsive shadow-lg table-scripted mt-4">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Fecha de Nacimiento</th>
                    <?php if ($isAdmin): ?>
                    <th>Acciones</th>
                    <?php endif; ?>
                </tr>
            </thead>

            <?php foreach ($socios as $socio): ?>
            <tr>
                <td><?= $socio['id_socio'] ?></td>
                <td><?= $socio['nombre'] ?></td>
                <td><?= $socio['apellido'] ?></td>
                <td><?= $socio['email'] ?></td>
                <td><?= $socio['telefono'] ?></td>
                <td><?= $socio['fecha_nacimiento'] ?></td>
                <?php if ($isAdmin): ?>
                <td>
                    <a href="editar_socio.php?id=<?= $socio['id_socio'] ?>" class="btn btn-sm btn-primary">Editar</a>
                    <a href="eliminar_socio.php?id=<?= $socio['id_socio'] ?>" class="btn btn-sm btn-danger">Eliminar</a>
                </td>
                <?php endif; ?>
            </tr>
            <?php endforeach; ?>
        </table>
        <br>
        <?php if ($isAdmin): ?>
        <a href="alta_socio.php" class="btn btn-success mt-3">Agregar un nuevo socio</a>
        <?php endif; ?>
    </div>
    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p>&copy; <?php echo date('Y'); ?> Adrian Rodriguez. Todos los derechos reservados.</p>
    </footer>
</body>

</html>