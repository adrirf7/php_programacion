<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $direccion = $_POST['direccion'];

    $linea = "$id,$telefono,$correo,$direccion\n";
    file_put_contents("../datos/proveedores.csv", $linea, FILE_APPEND);

    header("Location: ../index.php?opcion=proveedores");
    exit();
}
