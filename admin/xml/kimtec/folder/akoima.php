<?php
if (!$ArtikalId) {
    echo 'Ne postoji Artikal Id';
    die;
}
$update_query = Array(
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

$idUbacenogart = $ArtikalId;
require($documentrootAdmin.'/xml/centralniXml/ubaciNaziveArtNewVendorXMLInsert.php');

$idArti0 = $idUbacenogart;
$opis64deco = $opis64 =  $MarketingDescription;
require($documentrootAdmin . '/xml/centralniXml/opisTekstArtikla.php');

$idArti0 = $idUbacenogart;
$opis64deco = $opis64 =  $TechnicalDescription;
require($documentrootAdmin . '/xml/centralniXml/opisKratakOpisArtikla.php');


$idUbacenogart = $ArtikalId;
require $documentroot . '/admin/xml/kimtec/folder/ubaciSlikuKimtec.php';


$pokazi .= '<strong><br /> UPDATE ID artikla u bazi je : ' . $ArtikalId . ' a iz xml ' . $sifra . '<br /></strong>';
$pokazi .= 'Id artikla kod nas u bazi je  : <a target="_blank" href="' . DPROOTADMIN . '/str/editartikal/' . $ArtikalId . '">' . $ArtikalId . '</a><br>';
$pokazi .= 'URL ARTIKLA <a target="_blank" href="' . DPROOT . '/urlartikla/' . $ArtikalId . '">' . $ArtikalId . '</a><br>';

?>