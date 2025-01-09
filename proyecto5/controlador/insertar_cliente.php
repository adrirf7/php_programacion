<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];

    $archivo = "../datos/clientes.csv";
    $idDuplicado = false;

    // Leer todas las líneas del archivo y verificar si el ID está duplicado
    $lineas = file($archivo);
    foreach ($lineas as $linea) {
        $datos = explode(",", trim($linea));
        if ($datos[0] == $id) {
            $idDuplicado = true;
            break;
        }
    }


    // Si el ID no está duplicado, agregar el cliente
    if (!$idDuplicado) {
        $linea = "$id,$nombre,$correo,$telefono\n";
        file_put_contents($archivo, $linea, FILE_APPEND);
        header("Location: ../index.php?opcion=clientes");
        exit();
    } else {
        echo "Error: El ID ya existe. No se puede registrar el cliente.";
    }
}
