<?php

foreach ($_POST['OpisArtikliTekstovi'] as $valN => $kN) {
    $artiVel[$valN] = $common->clearvariableTekst($kN);
}