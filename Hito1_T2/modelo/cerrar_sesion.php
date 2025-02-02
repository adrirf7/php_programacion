<?php
session_start(); // Asegurar que la sesión está iniciada

// Eliminar todas las variables de sesión
$_SESSION = [];

// Destruir la cookie de sesión si está habilitada
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Finalmente, destruir la sesión
session_destroy();

header("Location: ../vista/miPerfil.php");
exit();