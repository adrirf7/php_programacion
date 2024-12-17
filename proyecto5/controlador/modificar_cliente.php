<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];

    $archivo = "../datos/clientes.csv";
    $tempArchivo = "../datos/temp_clientes.csv";
    $modificado = false;

    // Abrir el archivo original y uno temporal para escribir
    $lectura = fopen($archivo, "r");
    $escritura = fopen($tempArchivo, "w");

    if ($lectura && $escritura) {
        while (($linea = fgetcsv($lectura)) !== false) {
            // Verificar si la línea contiene el cliente a modificar
            if ($linea[0] == $id) {
                // Escribir la línea modificada
                $linea[1] = $nombre;
                $linea[2] = $correo;
                $linea[3] = $telefono;
                $modificado = true;
            }
            // Escribir la línea (modificada o no) en el archivo temporal
            fputcsv($escritura, $linea);
        }
        fclose($lectura);
        fclose($escritura);

        // Reemplazar el archivo original con el temporal
        if ($modificado) {
            rename($tempArchivo, $archivo);
        } else {
            unlink($tempArchivo);
        }

        // Redirigir a la página principal con un parámetro de éxito
        header("Location: ../index.php?opcion=clientes&modificado=" . ($modificado ? "1" : "0"));
        exit();
    } else {
        // Error al abrir archivos
        echo "Error al abrir el archivo de datos.";
    }
} else {
    // Si no se accede mediante POST
    echo "Método no permitido.";
}
