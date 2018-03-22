<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 19. 01. 2016.
 * Time: 14:29
 */
$IdRecenzije = $common->clearvariable($_POST['IdRecenzije']);
$NaslovRecenzije = $common->clearvariable($_POST['NaslovRecenzije']);
$KomentarZaRecenzije = $common->clearvariable($_POST['KomentarZaRecenzije']);
$KomentarProtivRecenzije = $common->clearvariable($_POST['KomentarProtivRecenzije']);
$KomentarAktivanRecenzije = $common->clearvariable($_POST['KomentarAktivanRecenzije']);

if (isset($IdRecenzije)) {
    $updaterecenzije = Array(
        "NaslovRecenzije" => "$NaslovRecenzije",
        "KomentarZaRecenzije" => "$KomentarZaRecenzije",
        "KomentarProtivRecenzije" => "$KomentarProtivRecenzije",
        "KomentarAktivanRecenzije" => "$KomentarAktivanRecenzije"
    );

    $db->where("IdRecenzije ", $IdRecenzije);
    $db->update('recenzije', $updaterecenzije);

    header("Location:admin/recenzije");
   // header("Location: " . URLVRATI . "/?e=$error_msg");
} else {
    $error_msg["error"] = 'Greska pri izmeni recenzije';
}


echo $m = json_encode($error_msg);


?>