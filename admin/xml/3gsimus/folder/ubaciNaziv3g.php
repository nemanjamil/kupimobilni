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
    'KategorijaArtikalId' => $nedefinisanoRazno,
    'ArtikalBrendId' => $brend_code,
    'ArtikalVPCena' => $cenan,
    'ArtikalMPCena' => $mpCena,
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


$idUbacenogart = $db->insert('artikli', $insert_query);

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

$pokazi .= '</div>';
?>