<?php

$pokazi .= '<ul style="background-color: #dedede">';


$ID = $row->getElementsByTagName("ID");
$ID = $ID->item(0)->nodeValue;
$pokazi .= '<li>ID : ' . $ID . '</li>';
$sifra = (int) $ID;
$pokazi .= '<li>$sifra : ' . $sifra . '</li>';

$ProductCode = $row->getElementsByTagName("ProductCode");
$ProductCode = $ProductCode->item(0)->nodeValue;



$ProductDescription = $row->getElementsByTagName("ProductDescription");
$ProductDescription = $ProductDescription->item(0)->nodeValue;
$TechnicalDescription = trim($ProductDescription);
$pokazi .= '<li>$TechnicalDescription : ' . $TechnicalDescription . '</li>';

$naziv = $row->getElementsByTagName("Name");
$naziv = $naziv->item(0)->nodeValue;
$naziv = trim($naziv);
$pokazi .= '<li>Naziv : ' . $naziv . '</li>';

$url_artikla = $common->friendly_convert($naziv);
$pokazi .= '<li>Url Artikla : ' . $url_artikla . '</li>';

$stanje = $row->getElementsByTagName("Stock");
$stanje = $stanje->item(0)->nodeValue;
if ($stanje > 0) {
    $stanje = 1;
} else {
    $stanje = '0';
}
$pokazi .= '<li>Stanje : ' . $stanje . '</li>';


$ImageGl = $row->getElementsByTagName("Image");
$ImageGl = $ImageGl->item(0)->nodeValue;
$pokazi .= '<li>$ImageGl : ' . $ImageGl . '</li>';

$cenanXML = $row->getElementsByTagName("Cena");
$cenaFloat = (float)$cenanXML->item(0)->nodeValue;
$cenan = $cenaFloat;
$pokazi .= '<li>Cena sa rabatom  : ' . $cenan . '</li>';

$marzaid = $common->cenamarzadin($cenan);
$pokazi .= '<li> Marza id : ' . $marzaid . '</li>';


$MarketingInfo = $row->getElementsByTagName("MarketingInfo");
if ($MarketingInfo) {
    $m = 0;
    foreach ($MarketingInfo as $mark) {
        $artimArk = $mark->getElementsByTagName("element");
        $linkMarketing = $artimArk->item($m)->nodeValue;
        $MarketingDescription = '<li>' . $linkMarketing . '</li>';
        $pokazi .= '<li> element : ' . $linkMarketing . '</li>';
        $m++;
    }
} else {
    $pokazi .= '<li style="background-color: red"> Ne postoji $MarketingInfo  : ' . $MarketingInfo . '</li>';
}


$xmlUserNames = $row->getElementsByTagName("AttrList");// uhvati sve AttrList
if ($xmlUserNames) {
    foreach ($xmlUserNames as $rowt) {
        $artik = $rowt->getElementsByTagName("element");// uhvati sve elemente
        $j = 0;
        foreach ($artik as $rows) {
            $mile = $artik->item($j)->getAttribute('Name');//  uhvati za svaki element NAME
            $jare = $artik->item($j)->getAttribute('Value');//  uhvati za svaki element NAME

            $lala = "'";
            $mile = str_replace($lala, "", $mile);
            $jare = str_replace($lala, "", $jare);

            $mile = $common->clearvariableTekst($mile);
            $jare = $common->clearvariableTekst($jare);

            $dodaj .= '<tr><th scope="row">' . $mile . '</th><td>' . $jare . '</td></tr> ';

            $j++;
        }
    }  // foreach( $xmlUserNames as $row )

    if ($mile) {
        $crtez = '<table border="1" style="border-collapse:collapse">' . $dodaj . '</table>';
    }

} else {
    $pokazi .= '<li> Ne postoji AttrList  $xmlUserNames : ' . $xmlUserNames . '</li>';
}
unset($miki);
$miki = [];

$slicice = $row->getElementsByTagName("Images");// uhvati sve Images
if ($slicice) {
    foreach ($slicice as $rowt) {
        $sveImages = $rowt->getElementsByTagName("Image"); // uhvati sve Image u okviru Images
        $h = 0;
        foreach ($sveImages as $rowimage) {
            $artimArk = $rowt->getElementsByTagName("Image");
            $linSlk = $artimArk->item($h)->nodeValue;
            $pokazi .= '<li> Slika : ' . $linSlk . '</li>';
            $miki[] = $linSlk;
            $h++;
        }
    }

    if ($ImageGl) {
        array_push($miki, $ImageGl);
    }
} else {
    $pokazi .= '<li> Ne postoji slikice  : ' . $slicice . '</li>';
}


$pokazi .= '</ul>';


?>



