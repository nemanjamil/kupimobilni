<?php
$artiN = '';
foreach ($_POST['OpisArtikliTekstovi'] as $valN => $kN) {
    $artiN[$valN] = $common->clearvariableTekst($kN);
}