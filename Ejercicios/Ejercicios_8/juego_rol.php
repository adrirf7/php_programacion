<?php

class personaje
{
    public $nombre;
    public $nivel;
    public $puntos_vida;
    public $puntos_ataque;

    public function __construct($nombre, $nivel, $puntos_vida, $puntos_ataque)
    {
        $this->nombre = $nombre;
        $this->nivel = $nivel;
        $this->puntos_vida = $puntos_vida;
        $this->puntos_ataque = $puntos_ataque;
    }

    public function atacar(personaje $objetivo)
    {
        if ($objetivo->puntos_vida > 0 && $this->puntos_vida > 0) {
            $damage = $this->puntos_ataque;
            $objetivo->puntos_vida -= $damage;
            $objetivo->puntos_vida = max(0, $objetivo->puntos_vida);

            echo "{$this->nombre} ataca a {$objetivo->nombre} causando {$damage} de daño. Vida restante de {$objetivo->nombre}: {$objetivo->puntos_vida}\n";
        } else {
            echo "{$objetivo->nombre} ya está derrotado.\n";
        }
    }
    public function curarse()
    {
        $curacion = 20;
        $this->puntos_vida += $curacion;
        $this->puntos_vida = min(100, $this->puntos_vida); // Máximo 100 de vida
        echo "{$this->nombre} se cura y restaura {$curacion} puntos de vida. Vida actual: {$this->puntos_vida}\n";
    }

    public function subirNivel()
    {
        $this->nivel++;
        $this->puntos_ataque += 10;
        $this->puntos_vida += 20;
        echo "{$this->nombre} sube al nivel {$this->nivel}. Puntos de ataque aumentan a {$this->puntos_ataque}. Vida aumentada a {$this->puntos_vida}\n";
    }
}
$guerrero = new personaje("Guerrero", nivel: 1, puntos_vida: 150, puntos_ataque: 20);
$mago = new Personaje("Mago", nivel: 1, puntos_vida: 50, puntos_ataque: 50);
$arquero = new Personaje("Arquero", nivel: 1, puntos_vida: 70, puntos_ataque: 35);

$guerrero->atacar($mago);
$mago->atacar($guerrero);
$mago->curarse();
$guerrero->atacar($mago);
$mago->atacar($guerrero);
$mago->subirNivel();
$mago->atacar($arquero);
$mago->curarse();
$arquero->atacar($mago);
$guerrero->atacar($mago);
$arquero->atacar($mago);
$arquero->subirNivel();
