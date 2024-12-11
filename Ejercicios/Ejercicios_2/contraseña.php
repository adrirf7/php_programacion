<?php

function passwordVerify($password)
{
    if (strlen($password) < 8) {
        return false;
    } elseif (
        preg_match('/[A-Z]/', $password) &&
        preg_match('/[a-z]/', $password) && preg_match('/[0-9]/', $password)
    ) {
        return true;
    }
}

$password = readline("Ingrese contrseña: ");

if (passwordverify($password)) {
    echo "Contraseña valida";
} else {
    echo "La contraseña no cumple con los requisitos";
}