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

$stanje = $row->getElementsByTagName("stanje");
$stanje = $stanje->item(0)->nodeValue;
if ($stanje > 0) { $stanje = 1;} else {$stanje = '0';}

$opis = $row->getElementsByTagName("opis");
$opis = $opis->item(0)->nodeValue;
$pokazi .= '<li>Opis : ' . $opis . '</li>';

$ean = $row->getElementsByTagName("ean");
$ean = $ean->item(0)->nodeValue;
$ean = trim($ean);
$pokazi .= '<li>Ean : ' . $ean . '</li>';

$cenan = $row->getElementsByTagName("cena");
$cenan = $cenan->item(0)->nodeValue;
$pokazi .= '<li>Cena XML : ' . $cenan . '</li>';
$pokazi .= '<li>Cena : ' . $cenan . '</li>';

$marzaid = $common->cenamarzadinObori($cenan);
$pokazi .= '<li> Marza id : ' . $marzaid . '</li>';

$pokazi .= '</ul>';

?>
