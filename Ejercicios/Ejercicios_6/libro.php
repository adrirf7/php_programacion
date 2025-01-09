<?php

//Clase Libro

class libro
{
    public $titulo;
    public $autor;
    public $paginas;

    public function mostrarInfo()
    {
        echo "Este libro se titula '{$this->titulo}', fue escrito por {$this->autor} y tiene {$this->paginas} paginas\n";
    }
}

function libro1()
{
    $libro = new libro();
    $libro->titulo = "El Principito";
    $libro->autor = "Antoine de Saint-Exupéry";
    $libro->paginas = "96";

    $libro->mostrarInfo();
}