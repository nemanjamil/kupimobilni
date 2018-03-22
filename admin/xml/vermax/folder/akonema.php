<?php

$db->where("ArtikalLink", $url_artikla);
$dlima = $db->getOne("artikli");
if ($dlima['ArtikalId']) {
    $url_artikla = $url_artikla . '-' . rand();
}


if (!$sifra) {
    echo 'Nema sifre';
    die;
}

$pokazi .= '<div style="background-color: lightgrey">';

$db->startTransaction();

$insert_query = Array(
    //'ArtikalNaziv' => $naziv,
    'KategorijaArtikalId' => $nedefinisanoRazno,
    'ArtikalBrendId' => $brend_code,
    'ArtikalVPCena' => $cenan,
    'ArtikalMPCena' => $cenan,
    'ArtikalBarKod' => $ean,
    'ArtikalKomitent' => $vendor,
    $codetip => $sifra,
    //'ArtikalNaAkciji' => $ArtikalNaAkciji,
    'ArtikalMarzaId' => $marzaid,
    'ArtikalLink' => $url_artikla,
    'ArtikalAktivan' => 1,
    'ArtikalStanje' => $stanje,
    'TipKatUnitArt' => $TipKatUnitArt,
    'MinimalnaKolArt' => $MinimalnaKolArt
);

$idUbacenogart = $db->insert('artikli', $insert_query);

if (!$idUbacenogart) {
    echo $db->getLastError();
    echo $pokazi;
    die;
}
require($documentrootAdmin.'/xml/centralniXml/ubaciNaziveArtNewVendorXMLInsert.php');


if (!$idTekstNew) {
    $pokazi .= '<br><div><strong class="bojacrvena">Fail INSERT u bazu ->  ARIKAL NAZIV : /var/www/masine/admin/xml/'.$folder.'/folder/akonema.php linija 45 </strong></div><br>' . $db->getLastError();
    $db->rollback();
    echo $pokazi;
    die;
} else {
    $pokazi .= 'Id artikla kod nas u bazi je  : <a target="_blank" href="' . DPROOTADMIN . '/str/editartikal/' . $idUbacenogart . '">' . $idUbacenogart . '</a><br>';
    $pokazi .= 'Naziv artikla  : ' . $naziv . '<br>';
    $pokazi .= 'Artikal: <a target="_blank" href="' . DPROOT . '/proizvod/' . $idUbacenogart . '">' . $idUbacenogart . '</a><br>';
    $pokazi .= '<br/>';
    $db->commit();
}


$data = Array('NoviArtikal' => 1);
$db->where('IdCronXml', $vendor);
if ($db->update('cronzaxml', $data)) {
    $pokazi .= '<li>' . $db->count . ' Uradjen update</li>';
} else {
    $pokazi .= '<li> Update failed id : ' . $idUbacenogart . ' => error : ' . $db->getLastError() . '</li>';
}

$pokazi .= '</div>';

?>