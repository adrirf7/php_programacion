<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['telefono'];
    $precio = $_POST['corrreo'];
    $stock = $_POST['direccion'];

    $linea = "$id,$nombre,$precio,$stock\n";
    file_put_contents("../datos/proveedores.csv", $linea, FILE_APPEND);

    header("Location: ../index.php?opcion=articulos");
    exit();
}