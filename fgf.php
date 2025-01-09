<?php
class mascota
{
    public $nombre;
    public $tipo;

    public function presentar()
    {
        echo "Hola mi nombre es {$this->nombre} y soy un {$this->tipo}. \n";
    }

    public function emitirSonido()
    {
        if ($this->tipo == "perro") {
            echo "guau guau\n";
        } elseif ($this->tipo == "gato") {
            echo "miau miau\n";
        } else {
            echo "este animal no tiene sonido predefinido\n";
        }
    }
}

$miperro = new mascota();
$miperro->nombre = "toby";
$miperro->tipo = "perro";

$miperro->presentar();
$miperro->emitirSonido();

$migato = new mascota();
$migato->nombre = "gato";
$migato->tipo = "gato";

$migato->presentar();
$migato->emitirSonido();

$usermascota = new mascota();
$usermascota->nombre = readline("Escribe el nombre de tu mascota: ");
$usermascota->tipo = readline("Escribe el tipo de mascota: ");


$usermascota->presentar();
$usermascota->emitirSonido();