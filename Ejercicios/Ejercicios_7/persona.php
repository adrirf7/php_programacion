<?php
class persona
{
    public $nombre;
    public $edad;
    public $sexo;

    public function presentar()
    {
        echo ("Buenas, mi nombre es $this->nombre, tengo $this->edad años y soy un(a) $this->sexo");
    }
}

function agregarPersona()
{
    $newpersona = new persona;
    $newpersona->nombre = readline("Ingrese su nombre: ");
    $newpersona->edad = readline("Ingrese su edad: ");
    $newpersona->sexo = readline("Igrese su sexo: ");

    $newpersona->presentar();
}
agregarPersona();
