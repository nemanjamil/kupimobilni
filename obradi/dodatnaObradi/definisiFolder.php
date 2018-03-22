<?php

// definisemo lokaciju na sajtu gde ce biti slika
$folderslika = substr($idArt, 0, 2);
$lok = $common->locationslika($idArt);

// ova dva su ista
//$likacijadoslikedir = $documentroot . "/p/$folderslika/$idArt";
$lokslifol = DCROOT . $lok;

$pokazi .= '<li>likacijadoslikedir : ' . $likacijadoslikedir . '</li>';




// AKO NEMAMO FOLDER GDE UBACUJEMO SLIKE onda ih pravimo
if (!is_dir($documentroot . "/p/$folderslika")) {
    mkdir($documentroot . "/p/$folderslika", 0775, true);
}
if (!is_dir($documentroot . "/p/$folderslika/$idArt")) {
    mkdir($documentroot . "/p/$folderslika/$idArt", 0775, true);
}




?>