<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 21. 01. 2016.
 * Time: 16:36
 */

$ProizvodRecenzije = $common->clearvariable($_POST['ProizvodRecenzije']);
$KomitentRecenzije = $common->clearvariable($_POST['KomitentRecenzije']);
$NaslovRecenzije = $common->clearvariable($_POST['NaslovRecenzije']);
$KomentarZaRecenzije = $common->clearvariable($_POST['KomentarZaRecenzije']);
$KomentarProtivRecenzije = $common->clearvariable($_POST['KomentarProtivRecenzije']);
$PoklonRecenzije = $common->clearvariable($_POST['PoklonRecenzije']);
$StarCenaRecenzije = $common->clearvariable($_POST['StarCenaRecenzije']);
$StarKvalitetRecenzije = $common->clearvariable($_POST['StarKvalitetRecenzije']);
$StarLakocaRecenzije = $common->clearvariable($_POST['StarLakocaRecenzije']);
$StarKorisnostRecenzije = $common->clearvariable($_POST['StarKorisnostRecenzije']);
$KolikoDugoRecenzije = $common->clearvariable($_POST['KolikoDugoRecenzije']);


if ($ProizvodRecenzije) {
    $data = Array(
        'ProizvodRecenzije' => $ProizvodRecenzije,
        'KomitentRecenzije' => $KomitentRecenzije,
        'NaslovRecenzije' => $NaslovRecenzije,
        'KomentarZaRecenzije' => $KomentarZaRecenzije,
        'KomentarProtivRecenzije' => $KomentarProtivRecenzije,
        'PoklonRecenzije' => $PoklonRecenzije,
        'StarCenaRecenzije' => $StarCenaRecenzije,
        'StarKvalitetRecenzije' => $StarKvalitetRecenzije,
        'StarLakocaRecenzije' => $StarLakocaRecenzije,
        'StarKorisnostRecenzije' => $StarKorisnostRecenzije,
        'KolikoDugoRecenzije' => $KolikoDugoRecenzije
    );

    $db->insert('recenzije', $data);

} else {
    $error_msg["error"] = 'Greska pri dodavanju senzora';
}


header("Location: ".'/artikal/'. $ProizvodRecenzije);
