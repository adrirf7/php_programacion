<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: miPerfil.php");
    exit();
}
// Datos del usuario
$usuario = $_SESSION['usuario'];
$edad_usuario = $usuario['edad']; // Asumiendo que la edad está guardada en la sesión.
$plan_usuario = $usuario['plan_base']; // El tipo de plan (por ejemplo, Básico).

require_once '../controlador/usuarios_Controller.php';
$controller = new usuariosController();

// Recuperar el plan de la URL
$plan_base = isset($_GET['plan']) ? $_GET['plan'] : null;
$duracion_suscripcion = isset($_POST['duracion_suscripcion']) ? $_POST['duracion_suscripcion'] : null;

// Lista de planes y precios
$planes = [
    'Plan Básico' => 9.99,
    'Plan Estándar' => 13.99,
    'Plan Premium' => 17.99
];

// Verificar que el plan recibido existe en la lista
$plan_precio = isset($planes[$plan_base]) ? $planes[$plan_base] : 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los paquetes seleccionados desde el carrito
    $paquetes_seleccionados = json_decode($_POST['paquetes']); // Paquetes adicionales seleccionados por el usuario

    // Actualizar el plan y la duración del usuario en la base de datos
    $controller->actualizarPlanes($usuario['id'], $plan_base, $duracion_suscripcion);

    // Actualizar los paquetes seleccionados en la base de datos
    foreach ($paquetes_seleccionados as $paquete_id) {
        $controller->agregarPaquete($usuario['id'], $paquete_id);
    }

    // Redirigir a la página de perfil
    header("Location: perfil.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra_planes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding-top: 50px;
        }

        .container {
            margin-bottom: 100px;
        }

        .card {
            cursor: pointer;
            transition: transform 0.3s ease-in-out;
        }

        .card:hover {
            transform: scale(1.05);
            /* Efecto al pasar el ratón */
        }

        .card img {
            width: 100%;
            /* Asegura que la imagen ocupe todo el ancho de la card */
            height: 200px;
            /* Ajusta la altura de la imagen para que todas las cards sean del mismo tamaño */
            object-fit: cover;
            /* Hace que la imagen se recorte y mantenga su proporción sin distorsionarse */
        }

        .carrito-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .carrito-item button {
            border: none;
            background-color: transparent;
            color: red;
            cursor: pointer;
        }

        #carrito {
            max-height: 300px;
            overflow-y: auto;
        }

        /* Estilo del botón para eliminar */
        .carrito-item button {
            font-size: 1.2em;
        }

        .card-body {
            padding: 15px;
            /* Da un poco de espacio alrededor del contenido */
            text-align: center;
            /* Centra el texto en la card */
        }

        .card-title {
            font-size: 1.25em;
            margin-bottom: 10px;
            /* Espacio debajo del título */
        }

        .card-text {
            font-size: 1em;
            color: #777;
            /* Color más suave para la descripción */
        }

        /* Media query para asegurar que las cards se vean bien en pantallas pequeñas */
        @media (max-width: 768px) {
            .card {
                margin-bottom: 15px;
            }

            .card img {
                height: 150px;
                /* Ajusta la altura de las imágenes en pantallas pequeñas */
            }

            .carrito-item {
                flex-direction: column;
                align-items: flex-start;
            }
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
        <h2 class="text-center">Elige la Duración de tu Suscripción</h2>
        <form method="POST" action="" class="mt-4">
            <input type="hidden" name="plan_base" value="<?php echo htmlspecialchars($plan_base); ?>">

            <div class="mb-3">
                <label for="plan_base_display" class="form-label">Tipo de Plan:</label>
                <input type="text" id="plan_base_display" class="form-control"
                    value="<?php echo htmlspecialchars($plan_base); ?>" disabled>
            </div>

            <div class="mb-3">
                <label for="duracion_suscripcion" class="form-label">Duración:</label>
                <select name="duracion_suscripcion" id="duracion_suscripcion" class="form-select" required>
                    <option value="Mensual">Mensual</option>
                    <option value="Anual">Anual</option>
                </select>
            </div>

            <div class="row" id="paquetes_container">
                <h3 class="text-center">Elige tus Paquetes Adicionales</h3>

                <!-- Card Pack Infantil (Siempre visible) -->
                <div class="col-md-4 mb-3">
                    <div class="card" id="card_pack_infantil" data-pack="Pack Infantil" data-price="4.99">
                        <img src="../img/infantil.jpg" class="card-img-top" alt="Pack Infantil">
                        <div class="card-body">
                            <h5 class="card-title">Pack Infantil</h5>
                            <p class="card-text">Contenidos exclusivos para niños.</p>
                        </div>
                    </div>
                </div>

                <!-- Card Pack Deporte (Visible solo si la duración es anual) -->
                <div class="col-md-4 mb-3" id="card_pack_deporte" style="display: none;">
                    <div class="card" data-pack="Pack Deporte" data-price="6.99">
                        <img src="../img/deportes.avif" class="card-img-top" alt="Pack Deporte">
                        <div class="card-body">
                            <h5 class="card-title">Pack Deporte</h5>
                            <p class="card-text">Para los amantes del deporte.</p>
                        </div>
                    </div>
                </div>

                <!-- Card Pack Cine (Visible para todos) -->
                <div class="col-md-4 mb-3">
                    <div class="card" id="card_pack_cine" data-pack="Pack Cine" data-price="7.99">
                        <img src="../img/cine.jpg" class="card-img-top" alt="Pack Cine">
                        <div class="card-body">
                            <h5 class="card-title">Pack Cine</h5>
                            <p class="card-text">Películas y series exclusivas.</p>
                        </div>
                    </div>
                </div>
            </div>

            <h3 class="text-center mt-5">Carrito de Compra</h3>
            <div id="carrito" class="mb-4">
                <?php if ($plan_base): ?>
                    <div class="carrito-item">
                        <span><?php echo htmlspecialchars($plan_base); ?> -
                            <?php echo number_format($plan_precio, 2); ?>€</span>
                    </div>
                <?php endif; ?>
            </div>
            <h3 class="text-center mt-3" id="total">Total: 0.00€</h3>
            <!-- Este es el lugar donde se mostrará el total -->
            <button type="submit" class="btn btn-primary w-100">Comprar</button>
            <input type="hidden" name="paquetes" id="paquetes_seleccionados">
        </form>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        <script>
            var plan_precio = <?php echo $plan_precio; ?>; // Precio del plan base
            var edad_usuario = <?php echo $edad_usuario; ?>;
            var plan_usuario = "<?php echo $plan_usuario; ?>";
            var selectedPacks = []; // Paquetes seleccionados
            var maxPacks = (plan_usuario === "Básico") ? 1 : Infinity; // Limitar paquetes si es Plan Básico

            window.onload = function() {
                // Si el usuario es menor de edad, solo mostrar el "Pack Infantil"
                if (edad_usuario < 18) {
                    document.getElementById('card_pack_infantil').style.display = 'block';
                    document.getElementById('card_pack_deporte').style.display = 'none';
                    document.getElementById('card_pack_cine').style.display = 'none';
                } else {
                    document.getElementById('card_pack_infantil').style.display = 'block';
                    document.getElementById('card_pack_deporte').style.display = 'block';
                    document.getElementById('card_pack_cine').style.display = 'block';
                }

                // Limitar paquetes si el plan es "Básico"
                var cards = document.querySelectorAll('.card');
                cards.forEach(function(card) {
                    card.addEventListener('click', function() {
                        var pack = this.getAttribute('data-pack');
                        var price = parseFloat(this.getAttribute('data-price'));

                        // Verificar si el paquete ya está en el carrito
                        if (!selectedPacks.some(item => item.pack === pack)) {
                            if (selectedPacks.length < maxPacks) {
                                selectedPacks.push({
                                    pack: pack,
                                    price: price
                                });
                                addToCarrito(pack, price);
                                this.classList.add(
                                    'disabled'); // Deshabilitar visualmente el paquete una vez añadido
                            }
                        }
                    });
                });

                // Verificar si la duración seleccionada es "Anual" o "Mensual"
                var duracion_suscripcion = document.getElementById('duracion_suscripcion');
                var cardPackDeporte = document.getElementById('card_pack_deporte');

                // Si la duración es "Anual", mostrar el Pack Deporte, si no, ocultarlo
                if (duracion_suscripcion.value === 'Anual') {
                    cardPackDeporte.style.display = 'block'; // Mostrar el Pack Deporte si es Anual
                } else {
                    cardPackDeporte.style.display = 'none'; // Ocultar el Pack Deporte si es Mensual
                }

                // Añadir un evento que se active cuando cambien la duración
                duracion_suscripcion.addEventListener('change', function() {
                    if (this.value === 'Anual') {
                        cardPackDeporte.style.display = 'block'; // Mostrar el Pack Deporte si es Anual
                    } else {
                        cardPackDeporte.style.display = 'none'; // Ocultar el Pack Deporte si es Mensual
                    }

                    // Actualizar el total al cambiar la duración
                    var duracion = this.value;
                    actualizarTotal(duracion);
                });

                // Calcular el total inicial con solo el precio del plan base
                var duracion = duracion_suscripcion.value;
                actualizarTotal(duracion);
            };

            // Función para actualizar el total en función de los paquetes seleccionados y la duración
            function actualizarTotal(duracion) {
                var total = plan_precio; // Iniciar el total con el precio del plan base

                // Sumamos el precio de cada paquete en el carrito
                selectedPacks.forEach(function(item) {
                    total += item.price; // Sumamos el precio de los paquetes adicionales
                });

                // Si la duración es anual, multiplicamos por 12
                if (duracion === 'Anual') {
                    total *= 12;
                }

                // Actualizamos el total en el HTML
                document.getElementById('total').textContent = "Total: " + total.toFixed(2) + "€";
            }

            // Función para añadir paquetes al carrito
            function addToCarrito(pack, price) {
                var carrito = document.getElementById('carrito');
                var newItem = document.createElement('div');
                newItem.classList.add('carrito-item');
                newItem.innerHTML = `<span>${pack} - ${price.toFixed(2)}€</span>
        <button onclick="removeFromCarrito('${pack}', ${price})">Eliminar</button>`;
                carrito.appendChild(newItem);

                // Actualizamos el total
                var duracion = document.getElementById('duracion_suscripcion').value;
                actualizarTotal(duracion);
            }

            // Función para eliminar paquetes del carrito
            function removeFromCarrito(pack, price) {
                var carrito = document.getElementById('carrito');
                var items = carrito.getElementsByClassName('carrito-item');

                // Buscar el paquete en el carrito y eliminarlo
                for (var i = 0; i < items.length; i++) {
                    if (items[i].innerText.includes(pack)) {
                        carrito.removeChild(items[i]);
                        // Eliminar el paquete y su precio de selectedPacks
                        selectedPacks = selectedPacks.filter(item => item.pack !== pack);
                        break;
                    }
                }

                // Rehabilitar el paquete visualmente
                var packElement = document.querySelector(`[data-pack='${pack}']`);
                if (packElement) {
                    packElement.classList.remove('disabled'); // Rehabilitar el paquete visualmente
                }

                // Actualizamos el total
                var duracion = document.getElementById('duracion_suscripcion').value;
                actualizarTotal(duracion);
            }

            // Para permitir que los paquetes se vuelvan a agregar después de ser eliminados, hemos agregado este código:
            function habilitarPaquete(pack) {
                var packElement = document.querySelector(`[data-pack='${pack}']`);
                if (packElement) {
                    packElement.classList.remove('disabled'); // Rehabilitar el paquete visualmente
                }
            }
            // Event listener cuando la duración cambie
            document.getElementById('duracion_suscripcion').addEventListener('change', function() {
                var duracion = this.value;
                // Actualiza el total cuando la duración cambie (Anual o Mensual)
                actualizarTotal(duracion);
            });
        </script>
    </div>
    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p>&copy; <?php echo date('Y'); ?> Adrian Rodriguez. Todos los derechos reservados.</p>
    </footer>
</body>

</html>