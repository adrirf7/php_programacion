<?php
session_start(); // Inicia la sesión PHP

$nombre = '';
$receta = '';

// Verificamos si se ha enviado el formulario para consultar la receta
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["nombre"]) && !isset($_POST["guardar_receta"])) {
    // Sanitizamos las entradas
    $nombre = htmlspecialchars($_POST["nombre"]);

    // Hacemos la petición a la IA si se ingresó el nombre de la receta
    if (!empty($nombre)) {
        $puerto = '1234'; // Cambia este puerto según sea necesario
        $url = "http://localhost:$puerto/v1/chat/completions";

        // Datos que se envían a la IA
        $datos = array(
            "model" => "llama-3.2-1b-instruct",
            "messages" => array(
                array("role" => "system", "content" => "Responde siempre en español y como un libro de recetas, sin mensajes introductorios ni conclusivos."),
                array("role" => "user", "content" => "Dame los pasos detallados para preparar la receta de $nombre. No pongas ninguna introducción ni despedida, solo los pasos de la receta."),
            ),
            "temperature" => 0.7,
            "max_tokens" => -1,
            "stream" => false
        );

        $jsonDatos = json_encode($datos);

        // Inicializamos cURL
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDatos);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonDatos)
        ));

        // Ejecutamos la solicitud
        $respuesta = curl_exec($ch);
        curl_close($ch);

        if ($respuesta) {
            $data = json_decode($respuesta, true);
            if (isset($data['choices'][0]['message']['content'])) {
                $receta = htmlspecialchars($data['choices'][0]['message']['content']);
            } else {
                $receta = "Error: No se recibió una respuesta válida.";
            }
        } else {
            $receta = "Error en la conexión con la IA.";
        }
    }
}

// Verificamos si se ha enviado el formulario para guardar la receta
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["guardar_receta"])) {
    $nombre = htmlspecialchars($_POST["nombre"]);
    $receta = htmlspecialchars($_POST["receta"]);

    // Guardar la receta en la base de datos utilizando el controlador
    if (!empty($nombre) && !empty($receta)) {
        require_once '../controlador/recetas_controller.php';
        $controller = new recetasController();
        $recetaConSaltos = nl2br($receta); //Añadir saltos de linea
        $controller->agregarReceta($_SESSION['usuario']['id'], $nombre, $recetaConSaltos); // Guardamos la receta
        header("Location: ./lista_recetas.php");
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Receta con IA</title>
    <!-- Enlazamos el CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../style/agregarStyle.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark px-5 fixed-top">
        <div class="container-fluid">
            <img class="logo" src="../img/Adobe Express - file.png" alt="Logo_receta">
            <a class="navbar-brand" href="./presentacion.php">Chef<span>IA</span> </a>
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
        <div class="card">
            <div class="card-header">
                <h2 class="text-center">Añade Tu Receta con IA</h2>
            </div>
            <div class="card-body">
                <!-- Formulario para solicitar la receta -->
                <form action="" method="post" id="formulario">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre de la receta:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Consultar Receta</button>
                </form>

                <!-- Spinner de espera con fondo oscuro y mensaje -->
                <div id="overlay" class="overlay"></div>
                <div id="spinner" class="spinner-wrapper">
                    <div class="spinner-border text-primary" role="status"></div>
                    <p class="loading-text">Tenga paciencia se esta generando la receta...</p>
                </div>

                <?php
                if (!empty($receta)) {
                    echo "<h3 class='mt-4'>Pasos para preparar la receta: $nombre</h3>";
                    echo "<textarea class='form-control' rows='10' name='receta' required>$receta</textarea>";

                    echo "<form action='' method='post' class='mt-3'>
                            <input type='hidden' name='nombre' value='$nombre'>
                            <input type='hidden' name='receta' value='$receta'>
                            <input type='hidden' name='guardar_receta' value='true'>
                            <button type='submit' class='btn btn-success'>Guardar Receta</button>
                          </form>";
                }
                ?>
            </div>
        </div>
    </div>

    <script>
    document.getElementById('formulario').onsubmit = function() {
        document.getElementById('spinner').style.display = 'block';
        document.getElementById('overlay').style.display = 'block';
    };
    </script>
</body>

</html>