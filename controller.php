<?php

function csvToArray($fichier) {
    $ret = [];
    if (($handle = fopen($fichier, "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
            $ret[] = $data;
        }
        fclose($handle);
    }
    return $ret;
}

$fichier = "champs-de-menhirs.csv";

$champs = csvToArray($fichier);

?>