<?php
if (!$ArtikalId) {
    echo 'Ne postoji Artikal Id';
    die;
}
$update_query = Array(
    //'ArtikalNaziv' => $naziv,
    'ArtikalVPCena' => $cenan,
    'ArtikalMPCena' => $cenan,
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

require($documentrootAdmin.'/xml/centralniXml/ubaciNaziveArtNewVendorXMLUpdate.php');



$pokazi .= '<strong><br/> UPDATE ID artikla u bazi je : ' . $ArtikalId . ', a iz xml ' . $sifra . '<br/></strong>';
$pokazi .= 'Id artikla kod nas u bazi je  : <a target="_blank" href="' . DPROOTADMIN . '/str/editartikal/' . $ArtikalId . '">' . $ArtikalId . '</a><br>';
$pokazi .= 'Artikal: <a target="_blank" href="' . DPROOT . '/proizvod/' . $ArtikalId . '">' . $ArtikalId . '</a><br>';

?>