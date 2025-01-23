<?php
require_once '../controlador/SociosController.php';
$controller = new SociosController();
$socios = $controller->listarSocios();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Listado de Socios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="">Club Deportivo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="lista_socios.php">Socios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="lista_eventos.php">Eventos</a>
                    </li>
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
                    <th>Acciones</th>
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
                <td>
                    <a href="editar_socio.php?id=<?= $socio['id_socio'] ?>" class="btn btn-sm btn-primary">Editar</a>
                    <a href="eliminar_socio.php?id=<?= $socio['id_socio'] ?>" class="btn btn-sm btn-danger">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <br>
        <a href="alta_socio.php" class="btn btn-success mt-3">Agregar un nuevo socio</a>
    </div>
    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p>&copy; <?php echo date('Y'); ?> Adrian Rodriguez. Todos los derechos reservados.</p>
    </footer>
</body>

</html>