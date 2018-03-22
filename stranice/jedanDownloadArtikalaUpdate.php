<?php

echo '</br>';
echo '<b class="bojaljubsvetank" >Selektovan artikli - ArtikalLink: <a href="'.$linkIzUpita.'" target="_blank">' . $linkIzUpita . '</a>  -Ide update u bazu</b>';
echo '</br>';
echo '<b class="bojaljubsvetank">Kategorija: ' . $nazivgrupe . '</b>';
echo '</br>';

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


