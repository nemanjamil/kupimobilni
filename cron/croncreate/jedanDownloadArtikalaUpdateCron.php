<?php
/**
 * Created by PhpStorm.
 * User: Nikola Markovic
 * Date: 8.1.2018.
 * Time: 13:06
 */


$log->lwrite('Selektovan artikli - ArtikalLink: : ' . $linkIzUpita .'  -Ide update u bazu');
$log->lwrite('Kategorija: ' . $nazivgrupe);

$db->startTransaction();

$update_queryArtikal = Array(
    'ArtikalExtId' => $artikalID,
    'KategorijaArtikalId' => $KategorijaArtikalaIdUpit,
    'ArtikalLink' => $ArtLink,
    'ArtikalSifra' => $sifra,
    'ArtikalBarKod' => $barkod,
    'TipKatUnitArt' => 8

);

$db->where('ArtikalId', $ArtikalIdUpit);
$db->update('artikli', $update_queryArtikal);


$Update_queryNaziv = Array(
    'OpisArtikla' => $naziv

);

$db->where('ArtikalId', $ArtikalIdUpit);
$db->where('IdLanguage', 5);
$db->update('artikalnazivnew', $Update_queryNaziv);


$db->commit();


