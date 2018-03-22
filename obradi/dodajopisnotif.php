<?php

$IdSenNotNotifikacija = $common->clearvariable($_POST[IdSenNotNotifikacija]);
$IdSenNotSenzor = $common->clearvariable($_POST[IdSenNotSenzor]);
$IdSenNotVecaManja = $common->clearvariable($_POST[IdSenNotVecaManja]);
$OpisSenNot = $common->clearvariable($_POST[OpisSenNot]);


if ($IdSenNotNotifikacija) {
    $data = Array(
        'IdSenNotNotifikacija' => $IdSenNotNotifikacija,
        'IdSenNotSenzor' => $IdSenNotSenzor,
        'IdSenNotVecaManja' => $IdSenNotVecaManja,
        'OpisSenNot' => $OpisSenNot

    );

   $db->insert('opissenzornotifikacija', $data);

    } else {
        $error_msg["error"] = 'Greska pri dodavanju notifikacije';
    }


header("Location: " . URLVRATI . "/?e=$error_msg");

?>

