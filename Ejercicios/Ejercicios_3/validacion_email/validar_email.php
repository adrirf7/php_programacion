<?php
ini_set('log_errors', 1); // Habilitar el registro de errores
ini_set('error_log', 'C:\xampp\htdocs\php_programacion\Ejercicios\Ejercicios_3\validacion_email\errores.log'); // Especificar el archivo de log

function validarEmail($email)
{
    try {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Formato inválido de correo electrónico: $email");
        } else {
            return "Correo valido";
        }
    } catch (Exception $e) {
        error_log("Error: " . $e->getMessage() . "\n");
        return "Error en la validación del correo: consulta el archivo log.";
    }
}

$email = readline("Ingresa tu direccion de email: ");
$resultado = validarEmail($email);
echo $resultado . "\n";