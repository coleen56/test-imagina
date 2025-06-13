<?php
require_once 'modele/Cellule.php';
use modele\Cellule;

$fichier = "champs-de-menhirs.csv";
// conversion données du fichier csv en array
$champs = csvToArray($fichier);
// cellule du départ : coin inférieur gauche
$start = new Cellule(9,0);

// fonction qui prend en paramètre un lien de fichier CSV et convertit son contenu en array
function csvToArray(String $fichier) {
    $ret = [];
    if (($handle = fopen($fichier, "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
            $ret[] = $data;
        }
        fclose($handle);
    }
    return $ret;
}

// fonction qui prend en paramètre une cellule et retourne ses voisines vides sous forme d'un array (hors voisines en diagonales)
function getCasesVoisinesVides(Cellule $cell) {
    global $champs;
    $x = $cell->getX();
    $y = $cell->getY();
    // valeur d'une case à -1 permet de la déclarer "visitée) donc non vide et pas un menhir
    $champs[$x][$y] = -1;
    $voisinesVides = [];
    // balayage vertical des cases voisines en excluant la case actuelle
    for($i = $x-1; $i <= $x+1; $i++) {
        if(array_key_exists($i, $champs) && $champs[$i][$y] == 0 && $x != $i) {
            $voisinesVides[] = new Cellule($i, $y);
        }
    }
    // balayage horizontal des cases voisines en excluant la case actuelle
    for($i = $y-1; $i <= $y+1; $i++) {
        if(array_key_exists($i, $champs[$x]) && $champs[$x][$i] == 0 && $y != $i) {
            $voisinesVides[] = new Cellule($x, $i);
        }
    }
    return $voisinesVides;
}


function getNiveauPropagation() {
    global $start;
    $cellulesTouchees[] = $start;
    // compte le nombre de niveaux
    $compteur = 0;
    // on boucle tant qu'il y a des cellules touchées par celles d'avant
    while(!empty($cellulesTouchees)) {
        $compteur++;
        // variable annexe pour stocker les valeurs tout en réinitialisant les cellules touchées pour stocker les nouvelles
        $currentCells = $cellulesTouchees;
        $cellulesTouchees = [];
        // pour chaque cellule on cherche ses voisines vides et on les ajoute a la liste
        foreach($currentCells as $curCell) {
            $cellulesTouchees = array_merge($cellulesTouchees, getCasesVoisinesVides($curCell));
        }
    }
    return $compteur;
}
?>