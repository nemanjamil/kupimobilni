<?php
/**
 * Created by PhpStorm.
 * User: Nikola Markovic
 * Date: 8.1.2018.
 * Time: 13:07
 */

$log->lwrite('Nema Artikal - ArtikalExtId: ' . $artikalID . ' -Ide insert u bazu. Naziv artikla: '. $naziv);
$log->lwrite('Kategorija: ' . $nazivgrupe);

$db->startTransaction();

$insert_queryArtikal = Array(
    'ArtikalExtId' => $artikalID,
    'KategorijaArtikalId' => $KategorijaArtikalaIdUpit,
    'ArtikalLink' => $ArtLink,
    'ArtikalSifra' => $sifra,
    'ArtikalBarKod' => $barkod,
    'TipKatUnitArt' => 8
);

$idUbacenogart = $db->insert('artikli', $insert_queryArtikal);

$insert_queryNaziv = Array(
    'ArtikalId' => $idUbacenogart,
    'IdLanguage' => 5,
    'OpisArtikla' => $naziv

);

$db->insert('artikalnazivnew', $insert_queryNaziv);

$db->commit();
