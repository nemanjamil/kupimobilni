<?php
$url_artikla = $common->limit_text_obican($url_artikla, 85);

$db->where("ArtikalLink", $url_artikla);
$dlima = $db->getOne("artikli");

if ($dlima['ArtikalId']) {
    $url_artikla = $url_artikla . '-' . rand();
    $pokazi .= '<div style="background-color: deeppink">IMA VEC URL ISTI - DODAJEMO RAND ' . $url_artikla . '</div>';
} else {
    $pokazi .= '<div style="background-color: deeppink">NEMA URL U BAZI ' . $url_artikla . '</div>';
}


if (!$sifra) {
    echo 'Nema sifre';
    die;
}

$pokazi .= '<div style="background-color: lightgrey">';


$db->startTransaction();

require($documentroot . '/admin/xml/3gsimus/folder/ubaciNaziv3g.php');


$data = Array('NoviArtikal' => 1);
$db->where('IdCronXml', $vendor);
if ($db->update('cronzaxml', $data)) {
    $pokazi .= '<li>' . $db->count . ' Uradjen update</li>';
} else {
    $pokazi .= '<li>update failed id : ' . $idUbacenogart . ' => error : ' . $db->getLastError() . '</li>';
}

if ($idTekstNew) {

    $opis64deco = $opis64 =  $TechnicalDescription;

    $pokazi .= '<div style="background-color: deeppink">'.$opis64deco.'</div>';

    $idArti0 = $idUbacenogart;
    $opis64deco = $opis64 =  $MarketingDescription;
    require($documentrootAdmin . '/xml/centralniXml/opisTekstArtikla.php');

    $idArti0 = $idUbacenogart;
    $opis64deco = $opis64 =  $TechnicalDescription;
    require($documentrootAdmin . '/xml/centralniXml/opisKratakOpisArtikla.php');

    require($documentrootAdmin . '/xml/'.$folder.'/folder/ubaciSlikuKimtec.php');


}
/*echo '<br/>';


$pokazi .= '</div>';


/*
 *
 *
 *
 * */
if (!$dlima['ArtikalId']) {

} else {

    /* $db->where('ArtikalLink', $url_artikla);
    if($db->delete('artikli')) {

         $pokazi .= '<div style="background-color: deepskyblue">Uspesno obrisano '.$url_artikla.'</div>';
     } else {
         $pokazi .= '<div style="background-color: green">Nije uspesno obrisano '.$url_artikla.'</div>';
     }*/
}

?>