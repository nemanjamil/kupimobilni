<?php
// UBACUJEMO ARTIKAL NAZIV I CIRILICA
$data = Array(
    'IdArtikalNaziv' => $idArt,
    'ArtNazsrblat' => $model,
    'ArtNazsrb' => $kategorijeDodatna->vice_versa_cySR($model, 'cy')
);

$idNaziv = $db->insert('ArtikalNaziv', $data);

if (!$idNaziv) {
    $pokazi .= '<br><div><strong class="bojacrvena" ">Fail INSERT u bazu ->  ARIKAL NAZIV: </strong></div><br>' . $db->getLastError();
    $db->rollback();
} else {
    $pokazi .= 'Id artikla kod nas u bazi je  : <a target="_blank" href="' . DPROOTADMIN . '/str/editartikal/' . $idArt . '">' . $idArt . '</a><br>';
    $pokazi .= 'Vebsop ID je : ' . $idArtDodatna . '<br>';
    $pokazi .= 'Naziv artikla  : ' . $model . '<br>';
    $pokazi .= '<br/>';
    $db->commit();
}

?>