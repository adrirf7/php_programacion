<?php

session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: inicio_sesion.php");
    exit();
}
require_once '../controlador/recetas_controller.php';
$controller = new recetasController();
$recetas = $controller->obtenerRecetas($_SESSION['usuario']['id']);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Listado de Eventos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style/listaStyle.css">
    <script>
        window.onscroll = function() {
            changeNavbarOnScroll()
        };

        function changeNavbarOnScroll() {
            var navbar = document.querySelector('.navbar'); // Seleccionamos la navbar
            if (window.scrollY > 50) { // Si el usuario ha hecho scroll más de 50px
                navbar.classList.add('navbar-scrolled'); // Añadir la clase para el color de fondo
            } else {
                navbar.classList.remove('navbar-scrolled'); // Eliminar la clase si vuelve al principio
            }
        }
    </script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark px-5 fixed-top">
        <div class="container-fluid">
            <img class="logo" src="../img/Adobe Express - file.png" alt="Logo_receta">
            <a class="navbar-brand" href="./presentacion.php">Gestor de Recetas</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="./lista_recetas.php">Tus Recetas</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <img style="width: 40px;" src="../img/icon.png" alt="icono">
                    <li class="nav-item">
                        <a class="nav-link" href="perfil.php">Mi Perfil
                            (<?php echo htmlspecialchars($_SESSION['usuario']['correo']); ?>)</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-5" style="margin-bottom: 100px;">
        <h1 class="text-center">RECETAS</h1>
        <table class="table table-responsive shadow-lg table-striped mt-4"
            style="border-radius: 10px; overflow: hidden;">
            <thead class="table-dark">
                <tr>
                    <th>Nº</th>
                    <th>Nombre</th>
                    <th>Receta</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($recetas as $receta): ?>
                    <tr>
                        <td><?= $receta['id'] ?></td>
                        <td><?= $receta['nombre'] ?></td>
                        <td><?= $receta['receta'] ?></td>
                        <td>
                            <a href="editar_receta.php?id=<?= $receta['id'] ?>" class="btn btn-sm botones_tabla"
                                style="background: #924f1b">Editar</a>
                            <a href="eliminar_receta.php?id=<?= $receta['id'] ?>" class="btn btn-sm botones_tabla"
                                style="background: #2a0308">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <br>
        <a href="agregar_receta.php" class="btn btn-success mt-3">Agregar una nueva Receta</a>
    </div>
    <footer class="text-white text-center py-3 mt-5">
        <p style="color: #FFCD42;">&copy; <?php echo date('Y'); ?> Adrian Rodriguez. Todos los derechos reservados.</p>
    </footer>
</body>

</html>