<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idEliminar = $_POST['id']; // El ID del cliente que quieres eliminar
    $archivoOriginal = "../datos/clientes.csv";
    $archivoTemporal = "../datos/clientes_temp.csv";

    // Abrir el archivo original y el archivo temporal
    $entrada = fopen($archivoOriginal, 'r');
    $salida = fopen($archivoTemporal, 'w');

    // Recorrer cada línea del archivo original
    while (($linea = fgetcsv($entrada)) !== false) {
        // Verificar si el ID actual coincide con el que se va a eliminar
        if ($linea[0] != $idEliminar) {
            // Si no coincide, escribir la línea en el archivo temporal
            fputcsv($salida, $linea);
        }
    }

    // Cerrar los archivos
    fclose($entrada);
    fclose($salida);

    // Reemplazar el archivo original con el archivo temporal
    unlink($archivoOriginal); // Eliminar el archivo original
    rename($archivoTemporal, $archivoOriginal); // Renombrar el temporal

    // Redirigir al usuario
    header("Location: ../index.php?opcion=clientes");
    exit();
}