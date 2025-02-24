<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: inicio_sesion.php");
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
        margin-bottom: 200px;
        padding: 12px;
        text-align: center;
    }

    footer {
        position: fixed;
        bottom: 0;
        width: 100%;
        text-align: center;
        padding: 10px;
        background-color: transparent;
    }

    /* Fondo de la página */
    body {
        background-color: #001717;
        /* Color claro de fondo */
        justify-content: center;
        /* Centra horizontalmente */
        align-items: center;
        /* Centra verticalmente */
        height: 100vh;
        /* Asegura que ocupe toda la altura de la pantalla */
        margin: 0;
    }

    h1 {
        color: #ffcd42;
        text-align: center;
        margin-top: 40px;
        margin-bottom: 40px;
    }

    h5,
    p {
        color: white;
        text-align: center;
    }

    .logo {
        margin-right: 10px;
        width: 55px;
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
            <a class="navbar-brand" href="./presentacion.php">Gestor de <span>Recetas</span> </a>
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

    <div class="container mt-5">
        <h1>Bienvenido, <?php echo htmlspecialchars($usuario['nombre']); ?></h1>
        <h5 style="margin-bottom: 50px;">Añade todas las Tareas y Eventos que desees</h5>
        <a href="../modelo/cerrar_sesion.php" class="btn btn-secondary">Cerrar Sesión</a>
        <a href="../modelo/eliminar_usuario.php" class="btn btn-danger"
            onclick="return confirmarEliminacion();">Eliminar
            Usuario</a>

        <script>
        function confirmarEliminacion() {
            // Mostrar la alerta de confirmación
            var resultado = confirm("¿Estás seguro de que quieres eliminar tu cuenta?");

            // Si el usuario acepta, continuar con el enlace; si no, cancelar
            if (resultado) {
                return true;
            } else {
                return false; // Cancela la acción y no hace nada
            }
        }
        </script>
    </div>
    <footer>
        <p>&copy; <?php echo date('Y'); ?> Adrian Rodriguez. Todos los derechos reservados.</p>
    </footer>
</body>