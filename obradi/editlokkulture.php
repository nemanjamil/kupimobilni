<?php
/**
 * Created by PhpStorm.
 * User: Nikola
 * Date: 16.11.2015.
 * Time: 11.24
 */

$IdKulturaLokacija = $common->clearvariable($_POST[IdKulturaLokacija]);

$NazivKulturaLokacija = $common->clearvariable($_POST[naziv]);
$PovKulture = $common->clearvariable($_POST[PovKulture]);
$PovLokSamouprava = $common->clearvariable($_POST[PovLokSamouprava]);



//$insert_query od  KulturaLokacija
$update_query = Array(
    'NazivKulturaLokacija' => $NazivKulturaLokacija,
    'PovKulture' => $PovKulture,
    'PovLokSamouprava' => $PovLokSamouprava
);


if (isset($NazivKulturaLokacija)) {
//  $db->setTrace (true);

    $db->where('IdKulturaLokacija', $IdKulturaLokacija);
    $db->update('kulturalokacija', $update_query);

} else {
    $error_msg["error"] = 'Nije odabrana kultura';
}

echo $error_msg;

header("Location:admin/kulturalokacija");

?>