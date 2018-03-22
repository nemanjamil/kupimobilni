<?php

$pokazi .= '<li>Prvo pobrisemo sve zapise u bazi : artiklislike</li>';

$stjobr = $common->obrisiFolderodId($idArt);
$pokazi .= '<li>$stajeObisano : ' . $stjobr . '</li>';

$stjobrBaza = $common->obrisiSlikeIzBaze($idArt);
$pokazi .= '<li>$stajeObisanoBaza : ' . $stjobrBaza . '</li>';

?>