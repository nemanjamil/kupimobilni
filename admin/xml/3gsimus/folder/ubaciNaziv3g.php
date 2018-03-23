<?php

if (!$cenan) {
    echo "Nema Vp Cene";
    die;
}

if (!$sifra) {
    echo "Nema sifre $sifra";
    die;
}



$insert_query = Array(
    //'ArtikalNaziv' => $naziv,
    'KategorijaArtikalId' => $nedefinisanoRazno,
    'ArtikalBrendId' => $brend_code,
    'ArtikalVPCena' => $cenan,
    'ArtikalMPCena' => $cenan,
    'ArtikalBarKod' => $barKod,
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


$idUbacenogart = $db->insert('Artikli', $insert_query);

if (!$idUbacenogart) {
    $pokazi .= '<div style="background-color: red;padding: 40px;color: white">';
        $pokazi .= 'Stalo je kod Artikla URL : '.$url_artikla.'<br/>';
        $pokazi .= 'Stalo je kod Artikla : '.var_dump($insert_query);
        $pokazi .= '<br/>';
        $pokazi .= $db->getLastError();
        $pokazi .= '</div>';
        echo $pokazi;
        $log->lwrite('Stalo je kod Artikla URL : '.$url_artikla);
        $log->lwrite($db->getLastError());
        die;
}

$pokazi .= '<div style="border: 1px dashed #000000; padding: 10px;background-color: #d9edf7">';

require($documentrootAdmin.'/xml/centralniXml/ubaciNaziveArtNewVendorXMLInsert.php');

if ($MarketingDescription) {
$idArti0 = $idUbacenogart;
$opis64deco = $opis64 =  $MarketingDescription;
require($documentrootAdmin . '/xml/centralniXml/opisTekstArtikla.php');
}

if ($TechnicalDescription) {
$idArti0 = $idUbacenogart;
$opis64deco = $opis64 =  $TechnicalDescription;
require($documentrootAdmin . '/xml/centralniXml/opisKratakOpisArtikla.php');
}



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
$pokazi .= '</div>';
?>