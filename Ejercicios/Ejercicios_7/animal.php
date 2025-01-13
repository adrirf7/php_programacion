<?php
class animal
{
    public $especie;

    public function emitirSonido()
    {
        if ($this->especie == "perro") {
            echo "guau, guau";
        } elseif ($this->especie == "gato") {
            echo "miau, miau";
        } else {
            echo "-no hay sonido establecido para esta especie-";
        }
    }
}

class perro extends animal
{
    public $raza;

    public function presentarPerro()
    {
        echo ("Hola, soy un perro de la raza $this->raza, ");
    }
}

function agregarPerro()
{
    $newperro = new perro;
    $newperro->especie = "perro";
    $newperro->raza = "border collie";
    $newperro->presentarPerro();
    $newperro->emitirSonido();
}
agregarPerro();
