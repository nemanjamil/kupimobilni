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

$stanje = $row->getElementsByTagName("kolicina");
$stanje = $stanje->item(0)->nodeValue;
if ($stanje =="G") {$stanje = 1;} else {$stanje = '0';}
$pokazi .= '<li>Stanje : '.$stanje.'</li>';
/*
G - Na stanju
R - Nema
*/

$cenan = $row->getElementsByTagName("cena_rabat");
$cenan = $cenan->item(0)->nodeValue;
$pokazi .= '<li>Cena XML : ' . $cenan . '</li>';
$pokazi .= '<li>Cena : ' . $cenan . '</li>';


$cena_pdv = $row->getElementsByTagName("cena_pdv");
$cena_pdv = (float) $cena_pdv->item(0)->nodeValue;
$cenaZaMP = $cena_pdv * 0.95;
$pokazi .= '<li>$cena_pdv  : ' . $cena_pdv . '</li>';
$pokazi .= '<li>$cenaZaMP  : ' . $cenaZaMP . '</li>';


$cenanXML = $row->getElementsByTagName("cena_rabat");
$cenaFloat = (float) $cenanXML->item(0)->nodeValue;

/*$rabat = $row->getElementsByTagName("rabat");
$rabat = (int) $rabat->item(0)->nodeValue;*/

$rabat = 10; // to smo dobili kada su san bagnuli

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
$kojiProcMarza = $common->kojiMarzaProc($marzaid);
$pokazi .= '<li> Marza id : ' . $marzaid . '</li>';
$pokazi .= '<li> Marza Procenat : ' . $kojiProcMarza . '</li>';


$pokazi .= '<li> Moramo da resetujemo MARZU</li>';
$marzaid = 1;
$cenan = $cenaZaMP / 1.2;
$pokazi .= '<li> Sad nam je cena ova : $cenan :  '.$cenan.'</li>';
$pokazi .= '</ul>';

?>
