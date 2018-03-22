<?php
$pokazi .= '<ul style="background-color: #dedede;border: 1px solid #333;">';

$ProductPartnerPrice = $row->getElementsByTagName("ProductPartnerPrice");
$ProductPartnerPrice = $ProductPartnerPrice->item(0)->nodeValue;
$ProductPartnerPrice = trim($ProductPartnerPrice);
$ProductPartnerPrice = (float)$ProductPartnerPrice;
$cenan = $ProductPartnerPrice;
$pokazi .= '<li>ProductPartnerPrice : $cenan  :     ' . $ProductPartnerPrice . '</li>';

$OnPromotion = $row->getElementsByTagName("OnPromotion");
$OnPromotion = $OnPromotion->item(0)->nodeValue;
$OnPromotion = (int)$OnPromotion;
$pokazi .= '<li>$OnPromotion : ' . $OnPromotion . '</li>';


$ProductCode = $row->getElementsByTagName("ProductCode");
$ProductCode = $ProductCode->item(0)->nodeValue;
$pokazi .= '<li>$ProductCode : ' . $ProductCode . '</li>';
$sifra = $ProductCode;


$ProductAvailability = $row->getElementsByTagName("ProductAvailability");
$ProductAvailability = $ProductAvailability->item(0)->nodeValue;
$ProductAvailability = trim($ProductAvailability);
$ProductAvailability = ($ProductAvailability) ? 1 : 0;
if ($ProductAvailability > 0) { $stanje = 1;} else {$stanje = '0';}
$stanje = (int) $stanje;
$pokazi .= '<li>Stanje : '.$stanje.'</li>';
$pokazi .= '<li>$ProductAvailability : ' . $ProductAvailability . '</li>';

$marzaid = (int) $common->cenamarzadin($ProductPartnerPrice);
$kojiProcMarza = $common->kojiMarzaProc($marzaid);
$pokazi .= '<li> Marza id : ' . $marzaid . '</li>';
$pokazi .= '<li> Marza Procenat : ' . $kojiProcMarza . '</li>';

$pokazi .= '</ul>';

$pokazi .= '<ul style="background-color: #dedede;border: 1px solid #333;">';
    require "specKimtecPodaci.php";
$pokazi .= '</ul>';


$pokazi .= '<ul style="background-color: #dedede;border: 1px solid #333;">';
    require "specKimtecSlike.php";
$pokazi .= '</ul>';




?>
