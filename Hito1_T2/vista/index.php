<?php
require_once '../controlador/paquetesController.php';
$controller = new paquetesController();
$paquetes = $controller->listarPaquetes();
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
        margin-top: 30px;
        display: flex;
        flex-direction: column;
        height: 100%;
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .card-img-top {
        object-fit: cover;
        height: 200px;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }

    .card-body {
        flex-grow: 1;
        padding: 1.25rem;
        background-color: #f9f9f9;
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

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .btn-primary:focus,
    .btn-primary.focus {
        box-shadow: 0 0 0 0.25rem rgba(38, 143, 255, 0.5);
    }

    .col-md-4 {
        margin-bottom: 30px;
    }
    </style>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
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
                    <li class="nav-item">
                        <a class="nav-link" href="miPerfil.php">Mi Perfil</a>
                    </li>
                </ul>
            </div>
        </div>

    </nav>
    <div class="container my-5">
        <h1 class="text-center mb-4">Paquetes Disponibles</h1>
        <div class=" row">

            <?php foreach ($paquetes as $paquete): ?>
            <div class="col-md-4 mb-4">
                <div class="card" style="width: 18rem;">
                    <!-- Actualiza la ruta de la imagen usando el nombre de la imagen desde la base de datos -->
                    <img src="../img/<?php echo htmlspecialchars($paquete['imagen']); ?>" class="card-img-top img-fluid"
                        alt="Imagen del paquete">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($paquete['nombre']); ?></h5>
                        <p class="card-text">
                            <?php
                                if ($paquete['nombre'] == 'Deporte') {
                                    echo "Todo el fútbol y el deporte que te apasiona, al alcance de tu mano. Vive cada momento con intensidad.";
                                } elseif ($paquete['nombre'] == 'Cine') {
                                    echo "Disfruta de las mejores películas y estrenos, desde la comodidad de tu hogar. ¡La magia del cine está aquí!";
                                } elseif ($paquete['nombre'] == 'Infantil') {
                                    echo "Diversión y entretenimiento para los más pequeños, con contenido educativo y de entretenimiento adecuado para su edad.";
                                }
                                ?>
                        </p>
                        <p class="card-text">Precio: $<?php echo number_format($paquete['precio'], 2); ?></p>
                        <a href="#" class="btn btn-primary">Ver más</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>

        </div>
    </div>

    <!-- Incluye los archivos de Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>