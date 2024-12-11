<?php

function generarNombreCompleto()
{
    $nombres = [
        "Carlos",
        "María",
        "Juan",
        "Ana",
        "Luis",
        "Sofía",
        "José",
        "Elena",
        "Pedro",
        "Lucía",
        "Fernando",
        "Carmen",
        "Diego",
        "Paula",
        "Miguel",
        "Laura",
        "Jorge",
        "Valeria",
        "Manuel",
        "Daniela"
    ];
    $apellidos = [
        "García",
        "Martínez",
        "López",
        "Hernández",
        "González",
        "Rodríguez",
        "Pérez",
        "Sánchez",
        "Ramírez",
        "Flores",
        "Torres",
        "Díaz",
        "Vázquez",
        "Castro",
        "Morales",
        "Ortiz",
        "Silva",
        "Ríos",
        "Reyes",
        "Molina"
    ];

    $indice_nombre = rand(0, 20);
    $indice_apellido = rand(0, 20);

    echo ($nombres[$indice_nombre] . " " .
        $apellidos[$indice_apellido]);
}
generarNombreCompleto();