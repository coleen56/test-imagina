<?php
namespace modele;

class Cellule {
    // def des attributs
    private int $x;
    private int $y;

    // constructeur
    public function __construct(int $x, int $y) {
        $this->x = $x;
        $this->y = $y;
    }

    //  getters
    public function getX(): int {
        return $this->x; 
    }

    public function getY(): int {
        return $this->y; 
    }

    public function toString() {
        return "[" . $this->getX() . ";" . $this->getY() . "]";
    }
}
?>