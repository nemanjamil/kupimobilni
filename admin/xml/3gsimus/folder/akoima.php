<?php
if (!$ArtikalId) {
    echo 'Ne postoji Artikal Id';
    die;
}
$update_query = Array(
    //'ArtikalNaziv' => $naziv,
    'ArtikalVPCena' => $vpCena,
    'ArtikalMPCena' => $vpCena,
    'ArtikalMarzaId' => $marzaid,
    'ArtikalAktivan' => 1,
    'ArtikalStanje' => $stanje

);

$db->where('ArtikalId', $ArtikalId);
if ($db->update('artikli', $update_query)) {
    $pokazi .= '<br>'.$db->count . ' records were updated<br>';
} else {
    echo '<br>update failed: ' . $db->getLastError().'<br>';
    die;
}

require(DCROOTADMIN.'/xml/centralniXml/ubaciNaziveArtNewVendorXMLUpdate.php');



/*$folderslika = substr($ArtikalId, 0, 2);
$lokPodaic = $common->locationslika($ArtikalId);
$lokslifol = DCROOT . $lokPodaic;
$pokazi .= '<strong><br/> $lokslifol: ' . $lokslifol . '<br/></strong>';
$idArt = $ArtikalId;
require(DCROOT.'/obradi/dodatnaObradi/obrisiSlikeBazaDodatna.php');

$idUbacenogart = $ArtikalId;
require 'ubacislike.php';*/


$pokazi .= '<strong><br/> UPDATE ID artikla u bazi je : ' . $ArtikalId . ', a iz xml ' . $sifra . '<br/></strong>';
$pokazi .= 'Id artikla kod nas u bazi je  : <a target="_blank" href="' . DPROOTADMIN . '/str/editartikal/' . $ArtikalId . '">' . $ArtikalId . '</a><br>';
$pokazi .= 'Artikal: <a target="_blank" href="' . DPROOT . '/proizvod/' . $ArtikalId . '">' . $ArtikalId . '</a><br>';

?>