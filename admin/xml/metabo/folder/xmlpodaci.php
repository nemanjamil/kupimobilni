<?php

$pokazi .= '<ul style="background-color: #dedede">';


$sifra = $row->getElementsByTagName("sifra");
$sifra = $sifra->item(0)->nodeValue;
$sifra = trim($sifra);
$pokazi .= '<li>Sifra : ' . $sifra . '</li>';

$naziv = $row->getElementsByTagName("naziv");
$naziv = $naziv->item(0)->nodeValue;
$naziv = trim($naziv);
$pokazi .= '<li>Naziv : ' . $naziv . '</li>';

$url_artikla = $common->friendly_convert($naziv);
$pokazi .= '<li>Url Artikla : ' . $url_artikla . '</li>';

$cena = $row->getElementsByTagName("cena");
$cena = $cena->item(0)->nodeValue;
$pokazi .= '<li>Cena XML : ' . $cena . '</li>';
//$cena = round($cena*0.77,0);
$pokazi .= '<li>Cena : ' . $cena . '</li>';


$rabat = $row->getElementsByTagName("rabat");
$pokazi .= '<br/><b> rabat :</b>';
$pokazi .= $rabat = $rabat->item(0)->nodeValue;
$pokazi .= '<br/><b> rabat 100  :</b>';
if ($rabat) {
    $pokazi .= $rabat = 1 + ($rabat / 100);
}


$opis = $row->getElementsByTagName("opis");
$opis = $opis->item(0)->nodeValue;
//$opis  = $db->real_escape_string($opis);
$pokazi .= '<li>Opis : ' . $opis . '</li>';

$ean = $row->getElementsByTagName("ean");
$ean = $ean->item(0)->nodeValue;
$ean = trim($ean);
$pokazi .= '<li>Ean : ' . $ean . '</li>';

$minkompor = $row->getElementsByTagName("minkompor");
$minkompor = $minkompor->item(0)->nodeValue;
$pokazi .= '<li>MInimalna kolicina za porudzbinu : ' . $minkompor . '</li>';

$komadaupak = $row->getElementsByTagName("komadaupak");
$komadaupak = $komadaupak->item(0)->nodeValue;
$pokazi .= '<li>Komada u pakovanju : ' . $komadaupak . '</li>';


$stanje = $row->getElementsByTagName("stanje");
$stanje = $stanje->item(0)->nodeValue;
if ($stanje > 0) {
    $stanje = 1;
} else {
    $stanje = '0';
}

$marzaid = $common->cenamarzadinObori($cena);
$pokazi .= '<li> Marza id : ' . $marzaid . '</li>';

$pokazi .= '</ul>'


?>
