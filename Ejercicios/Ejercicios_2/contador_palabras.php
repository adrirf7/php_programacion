<?php
function contarPalabras()
{
    $texto = (string)readline("Ingrese un texto: ");
    $palabras = str_word_count($texto, 1);

    $contador_palabras = 0;
    for ($i = 0; $i < count($palabras); $i++) {

        $contador_palabras++;
    }
    echo ("En tu texto hay $contador_palabras palabras");
}
contarPalabras();
