<?php

echo '</br>';
echo '<b class="bojacrvenaosn">Nema Artikal - ArtikalExtId: ' . $artikalID . ' -Ide insert u bazu.</b> Naziv artikla:<i class="bojazelena">'.$naziv.'</i>';
echo '</br>';
echo '<b class="bojacrvenaosn">Kategorija: ' . $nazivgrupe . '</b>';
echo '</br>';

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
