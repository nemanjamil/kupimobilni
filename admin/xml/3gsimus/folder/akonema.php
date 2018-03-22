<?php

$db->where("ArtikalLink", $url_artikla);
$dlima = $db->getOne("artikli");
if ($dlima['ArtikalId']) {
    $url_artikla = $url_artikla . '-' . rand();
}


if (!$sifra) {

    $pokazi .= '<div style="background-color: red;padding: 40px;color: white">';
    $pokazi .= 'Nema sifre';
    $pokazi .= '</div>';

} else {

    $pokazi .= '<div style="background-color: lightgrey;padding: 10px">';

    $db->startTransaction();

    require('ubaciNaziv3g.php');

    /*
     * SLIKE UBACI
     * */
    require 'ubacislike.php';

    $data = Array('NoviArtikal' => 1);
    $db->where('IdCronXml', $vendor);
    if ($db->update('cronzaxml', $data)) {
        $pokazi .= '<li>' . $db->count . ' Uradjen update</li>';
    } else {
        $pokazi .= '<li> Update failed id : ' . $idUbacenogart . ' => error : ' . $db->getLastError() . '</li>';
    }

    $pokazi .= '</div>';
}

?>