<?php
/**
 * Created by PhpStorm.
 * User: Nikola
 * Date: 14.11.2015.
 * Time: 15.54
 */

//var_dump($_POST);


$naziv = $common->clearvariable($_POST[naziv]);
$PovKulture = $common->clearvariable($_POST[PovKulture]);
$PovLokSamouprava = $common->clearvariable($_POST[PovLokSamouprava]);

//$insert_query od  KulturaLokacija
$insert_query = Array(
    'NazivKulturaLokacija' => $naziv,
    'PovKulture' => $PovKulture,
    'PovLokSamouprava' => $PovLokSamouprava
);

//var_dump($insert_query);

if (isset($naziv)) {
    $db->insert('kulturalokacija', $insert_query);

} else {
    $error_msg["error"] = 'Nije odabrana kultura';
}

echo $error_msg;

header("Location:$url");
?>