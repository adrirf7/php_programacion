<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: inicio_sesion.php");
    exit();
}

require_once '../controlador/tareasController.php';
$controller = new tareasController();
$tareas = $controller->obtenerTareasPorId($_SESSION['usuario']['id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_tarea = intval($_POST['id_tarea']);
    if (isset($_POST['completar_tarea'])) {
        $controller->cambiarEstadoTarea($id_tarea, 'completada');
    } elseif (isset($_POST['descompletar_tarea'])) {
        $controller->cambiarEstadoTarea($id_tarea, 'pendiente');
    }
    header("Location: lista_tareas.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Listado de Tareas</title>
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
            <a class="navbar-brand" href="">Gestor de Tareas</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="./lista_tareas.php">Tus Eventos</a>
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
    <div class="container mt-5" style="margin-bottom: 200px;">
        <h1 class="text-center">Proximas Tareas</h1>
        <table class="table table-responsive shadow-lg table-striped mt-4">
            <thead class="table-dark">
                <tr>
                    <th>✅</th>
                    <th>Titulo</th>
                    <th>Descripcion</th>
                    <th>Estado</th>
                    <th>Tiempo Restante</th>
                    <th>Fecha Limite</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <?php foreach ($tareas['pendientes'] as $tarea): ?>
                <tr>
                    <td>
                        <form method="POST" action="">
                            <input type="hidden" name="id_tarea" value="<?= $tarea['id'] ?>" onchange="this.form.submit()">
                            <input type="hidden" name="completar_tarea" value="1">
                            <input type="checkbox" onchange="this.form.submit()">
                        </form>
                    </td>
                    <td><?= $tarea['titulo'] ?></td>
                    <td><?= $tarea['descripcion'] ?></td>
                    <td><?= $tarea['estado'] ?></td>
                    <td><?= $tarea['dias_restantes'] ?> dias</td>
                    <td><?= $tarea['fecha_vencimiento'] ?></td>
                    <td>
                        <a href="./editar_tarea.php?id=<?= $tarea['id'] ?>" class="btn btn-sm btn-primary">Editar</a>
                        <a href="./eliminar_tarea.php?id=<?= $tarea['id'] ?>" class="btn btn-sm btn-danger"
                            onclick="return confirmarEliminacion();">Eliminar</a>
                        <script>
                            function confirmarEliminacion() {
                                // Mostrar la alerta de confirmación
                                var resultado = confirm("¿Estás seguro de que quieres eliminar Esta tarea?");

                                if (resultado) {
                                    return true;
                                } else {
                                    return false;
                                }
                            }
                        </script>
                    </td>
                </tr>
            <?php endforeach ?>
        </table>
        <br>
        <a href="./nueva_tarea.php" class="btn btn-success mt-3">Agregar un nuevo Evento</a>
        <h1 class="text-center">Tareas Completadas</h1>
        <table class="table table-responsive shadow-lg table-striped mt-4">
            <thead class="table-success">
                <tr>
                    <th>❌</th>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Fecha Completada</th>
                </tr>
            </thead>
            <?php foreach ($tareas['completadas'] as $tarea): ?>
                <tr>
                    <td>
                        <form method="POST" action="">
                            <input type="hidden" name="id_tarea" value="<?= $tarea['id'] ?>">
                            <input type="hidden" name="descompletar_tarea" value="1">
                            <input type="checkbox" onchange="this.form.submit()">
                        </form>
                    </td>
                    <td><?= $tarea['titulo'] ?></td>
                    <td><?= $tarea['descripcion'] ?></td>
                    <td><?= $tarea['fecha_vencimiento'] ?></td>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p>&copy; <?php echo date('Y'); ?> Adrian Rodriguez. Todos los derechos reservados.</p>
    </footer>
</body>

</html>