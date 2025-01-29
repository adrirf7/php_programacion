<?php
session_start();
$usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : null;
require_once '../controlador/planes_controller.php';
$controller = new planesController();
$planes = $controller->listarPlanes();


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paquetes</title>
    <!-- Incluye los archivos de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <style>
    .card {
        border-radius: 15px;
        /* Curva de los bordes de la card */
        overflow: hidden;
        /* Evita que el contenido sobresalga de las esquinas */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        /* Sombra para las cards */
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        /* Transiciones suaves */
    }

    .card:hover {
        transform: translateY(-5px);
        /* Efecto al pasar el mouse */
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        /* Efecto de sombra al pasar el mouse */
    }

    .card-body {
        background-color: #f9f9f9;
        /* Fondo claro para el contenido */
        padding: 1.25rem;
        border-bottom-left-radius: 15px;
        /* Curvatura en la parte inferior izquierda */
        border-bottom-right-radius: 15px;
        /* Curvatura en la parte inferior derecha */
    }

    .card-title {
        font-size: 1.25rem;
        font-weight: bold;
        color: #333;

    }

    .card-text {
        color: #555;

        font-size: 1rem;
    }

    .card-text-description {
        margin-top: 20px;
    }

    /* Estilo base para los botones */
    .btn-custom {
        border-radius: 0.25rem;
        padding: 10px 20px;
        font-size: 16px;
        font-weight: 600;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        transition: background-color 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease;
    }

    /* Botón para el Plan Básico */
    .btn-success {
        background-color: #28a745;
        /* Verde */
        border-color: #28a745;
    }

    .btn-success:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }

    .btn-success:focus,
    .btn-success.focus {
        box-shadow: 0 0 0 0.25rem rgba(40, 167, 69, 0.5);
    }

    /* Botón para el Plan Estándar */
    .btn-warning {
        background-color: #ffc107;
        /* Amarillo */
        border-color: #ffc107;
    }

    .btn-warning:hover {
        background-color: #e0a800;
        border-color: #d39e00;
    }

    .btn-warning:focus,
    .btn-warning.focus {
        box-shadow: 0 0 0 0.25rem rgba(255, 193, 7, 0.5);
    }

    /* Botón para el Plan Premium */
    .btn-danger {
        background-color: #dc3545;
        /* Rojo */
        border-color: #dc3545;
    }

    .btn-danger:hover {
        background-color: #c82333;
        border-color: #bd2130;
    }

    .btn-danger:focus,
    .btn-danger.focus {
        box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.5);
    }


    .col-md-4 {
        margin-bottom: 30px;
    }

    /* Ajuste para no cubrir contenido debajo del navbar fijo */
    body {
        padding-top: 50px;
        /* Agregar espacio para que no se cubra con el navbar */
    }

    /* Contenedor principal de la página */
    .container {
        margin-bottom: 100px;
    }
    </style>
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


    <div class="container mt-5" style="margin-bottom: 100px;">
        <h1>StreamWeb: Tu Entretenimiento a un Clic</h1>
        <p>StreamWeb es la plataforma de streaming definitiva para los amantes del deporte, el cine y las series. Accede
            a las competiciones deportivas más emocionantes del mundo, como LaLiga, Premier League, Champions League,
            Serie A, Bundesliga, NBA, NFL, Fórmula 1, y muchos más. Además, disfruta de una amplia selección de
            películas y series populares, tanto clásicas como estrenos. <br>
            <br>
            Con un sistema de suscripción flexible, podrás elegir los paquetes de contenido que más te interesen y
            gestionarlos fácilmente. Sin importar lo que te guste, StreamWeb tiene algo para ti. <br>
            <br>
            ¡Elige tu plan y comienza a disfrutar de todo el entretenimiento que amas ahora!
        </p>
        <h1 class="text-center mb-4">Elige tu Suscripción</h1>
        <div class="row d-flex justify-content-center">
            <?php foreach ($planes as $plan): ?>
            <div class="col-md-4 mb-4 d-flex justify-content-center" style="margin-top: 50px;">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($plan['tipo_plan']); ?></h5>
                        <p class="card-text">Desde:
                            <strong><?php echo number_format($plan['precio_mensual'], 2); ?>€</strong>/mes
                        </p>
                        <p class="card-text"><strong>(<?php echo htmlspecialchars($plan['dispositivos']); ?>
                                Dispositivos)</strong></p>
                        <?php if ($plan['tipo_plan'] == 'Plan Básico'): ?>
                        <a href="#" class="btn btn-success">Suscribirse al Plan Básico</a>
                        <?php elseif ($plan['tipo_plan'] == 'Plan Estándar'): ?>
                        <a href="#" class="btn btn-warning">Suscribirse al Plan Estándar</a>
                        <?php elseif ($plan['tipo_plan'] == 'Plan Premium'): ?>
                        <a href="#" class="btn btn-danger">Suscribirse al Plan Premium</a>
                        <?php endif; ?>

                        <p class="card-text-description">
                            <?php
                                if ($plan['tipo_plan'] == 'Plan Básico') {
                                    echo "El Plan Básico es ideal para quienes disfrutan de un único dispositivo. Con este plan, podrás contratar un solo pack de contenido para disfrutar en tu dispositivo. Perfecto para quienes buscan una opción económica y sencilla para ver su contenido favorito en un solo dispositivo.";
                                } elseif ($plan['tipo_plan'] == 'Plan Estándar') {
                                    echo "El Plan Estándar ofrece hasta dos dispositivos para que puedas disfrutar de tus contenidos favoritos en más de un dispositivo al mismo tiempo. Este plan es ideal para compartir con un amigo o familiar, ya que podrán ver diferentes contenidos simultáneamente en dos dispositivos.";
                                } elseif ($plan['tipo_plan'] == 'Plan Premium') {
                                    echo "El Plan Premium es perfecto para hogares o familias donde todos quieren disfrutar de contenido en varios dispositivos. Permite hasta cuatro dispositivos simultáneamente. Ideal para aquellos que desean acceso completo a todos los paquetes y poder ver contenido en múltiples pantallas al mismo tiempo, sin limitaciones.";
                                }
                                ?>
                        </p>

                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    </div>

    <!-- Incluye los archivos de Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p>&copy; <?php echo date('Y'); ?> Adrian Rodriguez. Todos los derechos reservados.</p>
    </footer>
</body>

</html>