<?php

// UBACUJEMO ARTIKAL NAZIV I CIRILICA
$data = Array(
    'IdArtikalNaziv' => $idArt,
    'ArtNazsrblat' => $model,
    'ArtNazsrb' => $kategorijeDodatna->vice_versa_cySR($model, 'cy')
);
$idNaziv = $db->insert('ArtikalNaziv', $data);


if (!$idNaziv) {
    echo 'insert failed ARIKAL NAZIV : -File je "ubaciArtNazivArtOpis.php" ' . $db->getLastError();
    $db->rollback();
} else {
    echo 'Id artikla kod nas u bazi je : ' . $idArt . '<br>';
    echo 'Vebsop ID je : ' . $idArtDodatna . '<br>';
    echo 'Naziv artikla  : ' . $model . '<br>';
    echo '<br/>';
    $db->commit();
}

// UBACIMO ARTIKAL OPIS ArtikliTekstovi
/*$data = Array(
    'IdArtikliTekstovi' => $idArt,
    'OpisArtikliTekstovisrblat' => $opis,
    'OpisArtikliTekstovisrb' => $opis  //$kategorijeDodatna->vice_versa_cySR($opis,'cy')
);
$idNazivTekst = $db->insert('ArtikliTekstovi', $data);


if (!$idNazivTekst) {
    echo 'insert failed ARIKAL TEKST u bazi ArtikliTekstovi : ' . $db->getLastError();
    $db->rollback();
} else {
    echo 'Id artikla kod nas u bazi je : ' . $idArt . '<br>';
    echo 'Vebsop ID je : ' . $idArtDodatna . '<br>';
    echo 'Naziv artikla  : ' . $model . '<br>';
    echo '<br/>';
    $db->commit();
}*/


?>
