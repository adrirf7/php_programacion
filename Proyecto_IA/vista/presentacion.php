<?php
session_start();
$usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : null;
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style/presentacionStyle.css">
    <title>Inicio</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark px-5 fixed-top">
        <div class="container-fluid">
            <!-- Logo -->
            <a class="navbar-brand d-flex align-items-center" href="./presentacion.php">
                <img class="logo img-fluid me-2" src="../img/Adobe Express - file.png" alt="Logo_receta"
                    style="width: 40px;">
                Chef<span>IA</span>
            </a>

            <!-- Botón Hamburguesa -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menú -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="./lista_recetas.php">Tus Recetas</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto d-flex align-items-center">
                    <li class="nav-item">
                        <img class="img-fluid me-2" style="width: 40px;" src="../img/icon.png" alt="icono">
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="perfil.php">Mi Perfil
                            (<?php echo htmlspecialchars($_SESSION['usuario']['correo']); ?>)
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <div class="carrusel">
            <div class="carrusel-imagenes">
                <img src="../img/receta1.jpg" alt="Imagen 1">
                <img src="../img/receta 2.jpg" alt="Imagen 2">
                <img src="../img/receta3.jpg" alt="Imagen 3">
                <img src="../img/receta4.webp" alt="Imagen 4">
            </div>

        </div>
        <div class="presentacion">
            <img class="logo" src="../img/Adobe Express - file.png" alt="">
            <h1>Chef<span>IA</span></h1>
        </div>
        <p>¡Bienvenido a tu Gestor de Recetas con IA!
            ¿Quieres crear recetas únicas de forma fácil y rápida? Aquí puedes hacerlo con la ayuda de inteligencia
            artificial. <br>
            <br>
            🔹 <span>Genera</span> recetas personalizadas en segundos: solo ingresa el plato que desees y la IA te
            sugerira una receta deliciosa. <br>
            🔹 <span>Guarda</span> tus recetas en tu cuenta para tenerlas siempre a la mano. <br>
            🔹 <span>Accede</span> a tu lista de recetas en cualquier momento y organízalas como prefieras. <br>
            🔹 <span>Edita</span> y mejora tus recetas según tu gusto o elimina las que ya no necesites. <br>
            <br>
            ¡Empieza ahora y deja que la IA te ayude a innovar en la cocina! 🍲🔥
        </p>
        <div class="grid">
            <h2 class="text-center">Algunas de nuestras Recetas</h2>
            <div class="grid-recetas" id="recetas-container">
                <!-- Aquí se cargarán las recetas dinámicamente -->
            </div>
        </div>

    </div>

    <footer class="text-white text-center py-3 mt-5">
        <p style="color: white;">&copy; <?php echo date('Y'); ?> Adrian Rodriguez. Todos los derechos reservados.</p>
    </footer>

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

    const carrusel = document.querySelector('.carrusel-imagenes');
    let contador = 0;
    const totalImagenes = carrusel.children.length;

    function moverCarrusel() {
        // Deslizar las imágenes
        contador++;

        if (contador === totalImagenes) {
            contador = 0; // Resetea el contador cuando llega al final
        }

        // Mover el carrusel hacia la siguiente imagen
        carrusel.style.transform = `translateX(-${contador * 100}%)`;
    }
    // Iniciar el deslizamiento cada 3 segundos
    setInterval(moverCarrusel, 3000); // Cambia la imagen cada 3 segundos

    // Función para cargar las recetas desde el archivo JSON
    fetch('../assets/recetas.json')
        .then(response => response.json())
        .then(data => {
            // Seleccionamos el contenedor donde vamos a insertar las recetas
            const container = document.getElementById('recetas-container');

            // Iteramos sobre las recetas y las agregamos al grid
            data.forEach(receta => {
                // Creamos un div para cada receta
                const recetaDiv = document.createElement('div');
                recetaDiv.classList.add('receta-card');

                // Insertamos la imagen, el título y la descripción
                recetaDiv.innerHTML = `
                        <img src="${receta.imagen}" alt="${receta.nombre}">
                        <h3>${receta.nombre}</h3>
                        <p>${receta.descripcion}</p>
                    `;

                // Agregamos la receta al contenedor del grid
                container.appendChild(recetaDiv);
            });
        })
        .catch(error => console.error('Error al cargar el JSON:', error));
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>