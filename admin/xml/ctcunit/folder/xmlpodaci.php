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
$pokazi .= '<li>Stanje : '.$stanje.'</li>';

$cenanXML = $row->getElementsByTagName("cena");
$cenaFloat = (float) $cenanXML->item(0)->nodeValue;

$rabat = $row->getElementsByTagName("rabat");
$rabat = (int) $rabat->item(0)->nodeValue;

if ($rabat) {
    $rabatVrednost = $rabat/100;
    $cenaRabatOdz = $cenaFloat*$rabatVrednost;
    $cenan = $cenaFloat - $cenaRabatOdz;
    $pokazi .= '<li>Cena Iz XML : '.$cenaFloat.'</li>';
    $pokazi .= '<li>Rabat  : '.$rabat.'</li>';
    $pokazi .= '<li>Rabat Cena : '.$cenaRabatOdz.'</li>';
    $pokazi .= '<li>Cena sa rabatom  : '.$cenan.'</li>';
} else {
    $cenan = $cenaFloat;
    $pokazi .= '<li>Nema Rabat pa je Cena : ' . $cenan . '</li>';
}


$marzaid = $common->cenamarzadin($cenan);
$pokazi .= '<li> Marza id : ' . $marzaid . '</li>';

$ean = $row->getElementsByTagName("ean");
$ean = $ean->item(0)->nodeValue;
$ean = trim($ean);
$pokazi .= '<li>Ean : ' . $ean.'</li>';


$komadaupak = $row->getElementsByTagName("komadaupak");
$komadaupak = $komadaupak->item(0)->nodeValue;
$pokazi .= '<li>$komadaupak : ' . $komadaupak.'</li>';


$dimenzije = $row->getElementsByTagName("dimenzije");
$dimenzije = $dimenzije->item(0)->nodeValue;
$dimenzije  = $common->clearvariable($dimenzije);
$pokazi .= '<li>Opis : ' . $dimenzije.'</li>';

$pokazi .= '</ul>';


?>



